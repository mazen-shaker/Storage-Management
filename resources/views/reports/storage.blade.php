@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <!-- إضافة مكتبة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/828895ed57.js" crossorigin="anonymous"></script>
@stop

@section('css')
    <!-- إضافة مكتبة jQuery UI للتاريخ -->
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <!-- تنسيقات مخصصة -->
    <style>
        .card-header {
            background-color: #f8f9fa;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #333;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            color: #333;
            border-color: #ced4da;
        }
        .date-fields {
            margin-top: 20px;
        }
    </style>
@stop

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-2">
                    <h3 class="card-title">Search operation</h3>
                </div>
                <div class="card-body">
                    <form id="searchForm" method="post" role="search" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input checked name="rdio" type="radio" value="1" id="type_div">
                                    <span>Search with operation date</span>
                                </label>
                            </div>
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                <label class="rdiobox">
                                    <input name="rdio" value="2" type="radio">
                                    <span>Search with product code</span>
                                </label>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="code">
                                <p class="mg-b-10">Search with product code</p>
                                <input type="text" class="form-control" id="code" name="code">
                            </div>
                        </div>
                        <div class="row date-fields">
                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">From date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" value="{{ date('Y-m-d') }}" name="start_at"  type="date">
                                </div>
                            </div>
                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">To date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="end_at" value="{{ date('Y-m-d') }}"  type="date">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="results">
                            @foreach ($index as $show )
                         <tr id="defult">
                            <td>{{$show->product}}</td>
                            <td>{{$show->code}}</td>
                            <td>{{$show->amount}}</td>
                            <td>{{$show->created_at->format('Y-m-d')}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $index->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#code').hide();

            // Show/hide fields based on radio button selection
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#code').hide();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#code').show();
                    $('#start_at').hide();
                    $('#end_at').hide();

                }
            });

            $('#searchForm input').on('input', function() {
    $.ajax({
        url: "{{ route('stor.reports.search') }}",
        type: "POST",
        data: $('#searchForm').serialize(),
        success: function(response) {
            let results = '';

            if (response.length === 0) {
                @foreach ($index as $show )
                    results += `
                        <tr id="defult">
                            <td>{{ $show->product }}</td>
                            <td>{{ $show->code }}</td>
                            <td>{{ $show->amount }}</td>
                            <td>{{ $show->created_at->format('Y-m-d') }}</td>
                        </tr>
                    `;
                @endforeach
            } else {
                response.forEach(function(operation) {
                    results += `
                        <tr id="result_tr">
                            <td>${operation.product}</td>
                            <td>${operation.code}</td>
                            <td>${operation.amount}</td>
                            <td>${new Date(operation.created_at).toISOString().split('T')[0]}</td>
                        </tr>
                    `;
                });
            }
            $('#results').html(results);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

        });
    </script>
@stop