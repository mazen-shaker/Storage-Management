@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>
<style>
    #med {
        width: 60px;
        padding-bottom: 30px;
        height: 30px;
        border-color: green;
        color: green;
    }

    #med:hover {
        border-color: green;
        background-color: green;
        color: rgb(197, 207, 197);
    }

    .card-container {
        border: 2px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .chart-container {
        border: 2px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .small-box {
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .row {
        margin-bottom: 20px;
    }
</style>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
@stop

@section('content')
<div class="card-container">
    <div class="row">
        <!-- Tile 1: مخزن -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Storage::count() }}</h3>
                    <p>Inventory</p>
                </div>
                <div class="icon">
                    <i class="fas fa-warehouse"></i>  <!-- أيقونة مخزن -->
                </div>
                @if(Auth::user()->prev_id === 1)
                <a href="{{route('stor.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
                <a href="#modaldemo9" data-toggle="modal" data-effect="effect-scale" class="modal-effect small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <!-- Tile 2: تصدير -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{\App\Models\Export::count()}}</h3>
                    <p>Issued </p>
                </div>
                <div class="icon">
                    <i class="fas fa-share-alt"></i>  <!-- أيقونة تصدير -->
                </div>
                <a href="{{route('exp.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Tile 3: Total of Products -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\Export::count() + \App\Models\Storage::count() }}</h3>
                    <p>Total of Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cogs"></i>  <!-- أيقونة تناسب "Total of Products" -->
                </div>
                <a href="{{route('stor.reports.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Tile 4: المستخدمين -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success"> <!-- رجعت اللون الأخضر -->
                <div class="inner">
                    <h3>{{  \App\Models\User::count() }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>  <!-- أيقونة المستخدمين -->
                </div>
                @if(Auth::user()->prev_id === 1)
               <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
               <a href="#modaldemo9" data-toggle="modal" data-effect="effect-scale" class="modal-effect small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>



<!-- Charts Row -->
<div class="chart-container">
    <div class="row">
        <!-- Bar Chart -->
        <div class="col-lg-6 col-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">monthly Expenses</h4>
                </div>
                <div class="box-body">
                    <canvas id="barChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-6 col-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Issued  & storage</h4>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">warning</h6><button aria-label="Close" class="close" data-dismiss="modal"
                 type="button"><span aria-hidden="true">&times;</span></button>
            </div>
                <div class="modal-body">
                    <p>this option is only for admins</p><br>
                </div>                                                            
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ok</button>
                </div>
           </div>
    </div>
</div>
@stop

@section('js')
<script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Bar Chart
    var barChartCanvas = document.getElementById('barChart').getContext('2d');
    var barChartData = {
        labels: @json($months),  // البيانات الخاصة بالشهور
        datasets: [{
            label: 'Monthly Issued ',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: @json($orderCounts),  // بيانات عدد الطلبيات شهريًا
        }]
    };

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
    };

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    // Pie Chart
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
    var pieChartData = {
        labels: @json(array_keys($sourceData)),  // أسماء الفئات (Direct, Referral, Social)
        datasets: [{
            data: @json(array_values($sourceData)),  // القيم (العدد أو النسبة)
            backgroundColor: ['#ff5733', '#33c4ff'],
        }]
    };

    var pieChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
    };

    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieChartData,
        options: pieChartOptions
    });
</script>
@stop
