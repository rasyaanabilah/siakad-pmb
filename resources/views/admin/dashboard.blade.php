@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h3 class="text-2xl font-bold text-gray-800">Halo, Admin 👋</h3>
        <p class="text-gray-500">Kelola data pendaftar, dosen, dan program studi</p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Total Pendaftar</p>
            <h4 id="total-pendaftar" class="text-2xl font-bold text-gray-800">
                {{ \App\Models\Pendaftar::count() }}
            </h4>
        </div>

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Diterima</p>
            <h4 class="text-2xl font-bold text-green-600">
                {{ \App\Models\Pendaftar::where('status','diterima')->count() }}
            </h4>
        </div>

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Pending</p>
            <h4 class="text-2xl font-bold text-yellow-600">
                {{ \App\Models\Pendaftar::where('status','pending')->count() }}
            </h4>
        </div>

    </div>

    {{-- CHART --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <canvas id="prodiChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <canvas id="genderChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <canvas id="angkatanChart"></canvas>
        </div>
    </div>
    
</div>

{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
$(document).ready(function () {

    /* ===========================
       TOASTR CONFIG
    =========================== */
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "5000"
    };

    /* ===========================
       DATA AWAL
    =========================== */
    let prodiData = {};
    let genderData = {};
    let angkatanData = {};

    /* ===========================
       FETCH DATA AWAL
    =========================== */
    axios.get('/admin/dashboard-data')
        .then(res => {
            prodiData = res.data.prodi;
            genderData = res.data.gender;
            angkatanData = res.data.angkatan;
            initCharts();
        });

    /* ===========================
       INIT CHART
    =========================== */
    function initCharts() {

        window.prodiChart = new Chart(document.getElementById('prodiChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(prodiData),
                datasets: [{
                    label: 'Jumlah',
                    data: Object.values(prodiData),
                    backgroundColor: 'rgba(54,162,235,.6)'
                }]
            }
        });

        window.genderChart = new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(genderData),
                datasets: [{
                    data: Object.values(genderData),
                    backgroundColor: ['#60a5fa ','#f87171']
                }]
            }
        });

        window.angkatanChart = new Chart(document.getElementById('angkatanChart'), {
            type: 'line',
            data: {
                labels: Object.keys(angkatanData),
                datasets: [{
                    label: 'Jumlah',
                    data: Object.values(angkatanData),
                    borderColor: '#34d399'
                }]
            }
        });
    }

    /* ===========================
       UPDATE
    =========================== */
    function updateStats(data) {
        document.getElementById('total-pendaftar').innerText =
            Object.values(data.prodi).reduce((a,b)=>a+parseInt(b),0);
    }

    function updateCharts(data) {
        prodiChart.data.labels = Object.keys(data.prodi);
        prodiChart.data.datasets[0].data = Object.values(data.prodi);
        prodiChart.update();

        genderChart.data.labels = Object.keys(data.gender);
        genderChart.data.datasets[0].data = Object.values(data.gender);
        genderChart.update();

        angkatanChart.data.labels = Object.keys(data.angkatan);
        angkatanChart.data.datasets[0].data = Object.values(data.angkatan);
        angkatanChart.update();
    }

    /* ===========================
       PUSHER (HANYA SEKALI)
    =========================== */
    Pusher.logToConsole = true;

    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    const channel = pusher.subscribe('dashboard');

    channel.bind('pendaftar-baru', function (data) {

        console.log('TOAST DATA:', data);

        toastr.success(
            'Mahasiswa baru mendaftar: <b>' + data.pendaftar.nama + '</b>',
            'Notifikasi'
        );

        // update realtime
        axios.get('/admin/dashboard-data')
            .then(res => {
                updateStats(res.data);
                updateCharts(res.data);
            });
    });

    /* ===========================
       POLLING (TETAP ADA)
    =========================== */
    setInterval(() => {
        axios.get('/admin/dashboard-data')
            .then(res => {
                updateStats(res.data);
                updateCharts(res.data);
            });
    }, 5000);

});
</script>

@endsection
