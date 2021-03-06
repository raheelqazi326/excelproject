@extends('admin.layout.master')
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('datatable/Main/css/jquery.dataTables.min.css') }}"> --}}
    @livewireStyles
    @livewireScripts
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/editor.dataTables.min.css') }}">
    <style type="text/css">
        th 
        {
            background: #eaeef3;
            font-size: 1.10vw !important;
            /*max-width: 1047px;
            min-width: 192px;*/
        }
        table#spreadsheet-table,
        table#spreadsheet-table-out {
            font-size: 13px;
            line-height: 7.1px;
            width: 120% !important;
        }
        .table td, .table th, .card .table td, .card .table th, .card .dataTable td, .card .dataTable th {
            padding: 9px 5px !important;
            vertical-align: middle;
        }
        table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
             padding-right: 15px;
        }
        .dt-buttons{
            float:none !important;
        }
        .sorting:after, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:after 
        {
            opacity: 0 !important;
        }
        .sorting:before, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_desc_disabled:before {
            right: 1em;
            content: "↑";
            opacity: 0;
        }
        table.dataTable {
            width: 100%;
            margin: unset !important;
            clear: both;
            border-collapse: separate;
            border-spacing: 0;
        }
        #spreadsheet-table tbody tr td:nth-child(10)
        {
            text-transform: capitalize
        }
        .table-responsive {
            margin-top: -7px;
        }
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: .5em;
            display: inline-block;
            width: auto;
            height: 27px;
        }
        .label {
            padding: 4px 6px !important;
        }
        th {
            background: #06830659;
            font-size: 1.0vw !important;
            border: 1px solid #06830673 !important;
            color: black !important;
        }
        td
        {
            border: 0.1px solid #0683062b !important
        }
        table.dataTable>tbody>tr:hover>td {
            background: #cff3cf47!important;
        }
        .label-info {
            background-color: #e40e3f !important;
        }
        div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_filter label,div.dataTables_wrapper div.dataTables_length label {
            color: #088309;
        }
        div.dataTables_wrapper div.dataTables_filter input {
            border: 1px solid #078307;
        }
        div#spreadsheet-table_processing {
            height: 40rem;
            top: 10%;
            width: 98%;
            left: 8.5%;
            /* z-index: -999999; */
            /* background: gray; */
            opacity: 0.44;
            /*background: gray;*/
            /*opacity: 0.3;*/
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3b6738 !important;
            background-color: #fff;
            border: 1px solid #dee2e6 ;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #fff !important;
            background-color: #3b6738 !important;
            border-color: #3b6738 !important;
        }
        .navbar-nav>li>a {
            padding: 20px 10px 20px 15px;
            line-height: 20px;
            color: #0b850b;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #3b6738 !important;
            border-color: #3b6738 !important;
        }
        .table-responsive{
            height: 37.6rem;
        }
        input.Request {
            width: 114px;
        }
        input.Date1, input.Amount2, input.Category3 {
            width: 100%;
        }
        @media(max-width: 992px){
            table#spreadsheet-table {
                line-height: 17.1px;
                width: 185% !important;
            }
        }
    </style>
@endpush
@section('content')
<!-- page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{-- <div class="col-md-12">
                        <div class="float-right">
                            @if (auth()->user()->role_id == 2)
                                <button class="btn btn-primary excel-import p-3">
                                    Import SpreadSheet
                                </button>
                                <input type="file" id="excel_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none">
                            @endif
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="table-responsive1">
                            <table id="spreadsheet-table" class="table custom-table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th style="width:10%">Date</th>
                                        <th style="width:10%">Amount</th>
                                        <th style="width:10%">Category</th>
                                        <th style="width:10%">Description</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive1">
                            <table id="spreadsheet-table-out" class="table custom-table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th style="width:10%">Date</th>
                                        <th style="width:10%">Amount</th>
                                        <th style="width:10%">Category</th>
                                        <th style="width:10%">Description</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->
@endsection
@push('scripts')
    {{-- DataTable Scripts --}}
    <script src="{{ asset('datatable/Main/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.editor.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/jszip.min.js') }}"></script>
    {{-- Pusher Scripts --}}
    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script> --}}
    {{-- Custom Scripts --}}
    @include('admin.sheet.datatablejs-in')
    <script>
        function getBalanceAmount(){
            let inAmount = $(".balance #in-amount").val();
            let outAmount = $(".balance #out-amount").val();
            // console.log(inAmount, outAmount);
            let balance = inAmount-outAmount;
            $(".balance th span").text((balance > 0?"+":"")+balance);
        }
        $(document).ready(function(){
            $("#excelUpload").change(function(){
                $(this).parents('form').submit();
            });
            getBalanceAmount();
            $(".balance input").change(function(){
                getBalanceAmount();
            });
        })
    </script>
    {{-- DataTable Scripts --}}
@endpush
