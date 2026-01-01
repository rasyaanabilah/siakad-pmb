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
@endsection


@section('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "5000"
    };

    let prodiChart, genderChart, angkatanChart;

    function loadDashboard() {
        axios.get('/admin/dashboard-data')
            .then(res => {
                renderCharts(res.data);
                updateStats(res.data);
            });
    }

    function renderCharts(data) {

        if (prodiChart) prodiChart.destroy();
        if (genderChart) genderChart.destroy();
        if (angkatanChart) angkatanChart.destroy();

        prodiChart = new Chart(document.getElementById('prodiChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(data.prodi),
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: Object.values(data.prodi),
                    backgroundColor: 'rgba(54,162,235,.6)'
                }]
            }
        });

        genderChart = new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(data.gender),
                datasets: [{
                    data: Object.values(data.gender),
                    backgroundColor: ['#60a5fa','#f87171']
                }]
            }
        });

        angkatanChart = new Chart(document.getElementById('angkatanChart'), {
            type: 'line',
            data: {
                labels: Object.keys(data.angkatan),
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: Object.values(data.angkatan),
                    borderColor: '#34d399'
                }]
            }
        });
    }

    function updateStats(data) {
        document.getElementById('total-pendaftar').innerText =
            Object.values(data.prodi).reduce((a,b)=>a + parseInt(b), 0);
    }

    // Load awal
    loadDashboard();

    // Pusher realtime
    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    const channel = pusher.subscribe('dashboard');

    channel.bind('pendaftar-baru', function (data) {
        toastr.success(
            'Mahasiswa baru mendaftar: <b>' + data.pendaftar.nama + '</b>',
            'Realtime Update'
        );
        loadDashboard();
    });

});
</script>
@endsection
