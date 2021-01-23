@extends('admin.layout.master')
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('datatable/Main/css/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/editor.dataTables.min.css') }}">
@endpush
<style type="text/css">
    th 
    {
        background: #eaeef3;
        font-size: 1.10vw !important;
        max-width: 1047px;
        min-width: 192px;
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
</style>
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            {{-- <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Spread Sheet</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Spread Sheet</li>
                </ol>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            @if (auth()->user()->role_id == 2)
                                <button class="btn btn-primary excel-import p-3">
                                    Import SpreadSheet
                                </button>
                                <input type="file" id="excel_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>Spread Sheet</header>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color spreadsheet-refresh" href="javascript:;"></a>
                                    {{-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> --}}
                                    {{-- <a class="t-close btn-color fa fa-times" href="javascript:;"></a> --}}
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive1">
                                    <table id="spreadsheet-table" class="table custom-table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Ward</th>
                                                <th>Request Grade</th>
                                                <th>Candidate</th>
                                                <th>National Insurance</th>
                                                <th>Comment From Colette</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Ward</th>
                                                <th>Request Grade</th>
                                                <th>Candidate</th>
                                                <th>National Insurance</th>
                                                <th>Comment From Colette</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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
    <script src="{{ asset('assets/js/pages/excel-import/jszip.js') }}"></script>
    <script src="{{ asset('assets/js/pages/excel-import/xlsx.js') }}"></script>
    {{-- DataTable Scripts --}}
    <script src="{{ asset('datatable/Main/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.editor.min.js') }}"></script>
    {{-- DataTable Scripts --}}
    <script>
        $(document).ready(function(){
            let DataTable;
            var is_colette = {{ auth()->user()->role_id == 2?1:0 }};
            var editor; // use a global for the submit and return data rendering in the examples
            $(document).ready(function(){
                $(".spreadsheet-refresh").click(function(e){
                    e.preventDefault();
                    DataTable.ajax.reload();
                });
                let fields = [];
                if(is_colette){
                    fields = [{
                            label: "Comment From Colette:",
                            name: "comment_from_colette"
                        },
                        {
                            label: "Status:",
                            name: "status"
                        }
                    ];
                }
                else{
                    fields = [{
                            label: "Candidate:",
                            name: "candidate"
                        },
                        {
                            label: "National Insurance:",
                            name: "national_insurance"
                        }
                    ];
                }
                editor = new $.fn.dataTable.Editor({
                    ajax: {
                        url:"{{ route('sheet.edit') }}",
                        type: "POST",
                        data:{
                            'role_id':{{ auth()->user()->role_id }}
                        }
                    },
                    table: "#spreadsheet-table",
                    idSrc: "id",
                    fields: fields
                });
                $("body").tooltip({ selector: '[data-toggle=tooltip]' });
                console.log(editor);
                $("#spreadsheet-table").on( 'click', 'tbody td', function (e){
                    try {
                        let i = $(this).index();
                        // console.log(is_colette);
                        if (!is_colette && (i == 6 || i == 7)){
                            editor.inline( this );
                        }
                        else if (is_colette && (i == 8)){
                            editor.inline( this );
                        }
                    } catch (error) {
                        console.log(error);                    
                    }
                });
                let domTemplate = '<"row"<"col-3"l><"col-5 text-center"B><"col-4"f>><"table-responsive"rt><"row"<"col"i><"col"p>>';
                DataTable = $("#spreadsheet-table").DataTable({
                    dom: domTemplate,
                    ajax: "{{ route('sheet.datatable') }}",
                    // order: [[ 1, 'asc' ]],
                    columns: [
                        {
                            data: "request_id"
                        },
                        {
                            data: "date",
                            type: "date"
                        },
                        {
                            data: "start",
                            type: "datetime"
                        },
                        {
                            data: "end",
                            type: "datetime"
                        },
                        {
                            data: "ward"
                        },
                        {
                            data: "request_grade"
                        },
                        {
                            data: "candidate"
                        },
                        {
                            data: "national_insurance"
                        },
                        {
                            data: "comment_from_colette"
                        },
                        {
                            data: "status.name"
                        },
                        {
                            data: null,
                            defaultContent: '',
                            orderable: false,
                            render: function ( data, type, row ) {
                                // Combine the first and last names into a single table field
                                let actionWrapper = $("<div/>");
                                if(is_colette && data.status_id == 2){
                                    $("<span></span>").attr({
                                        "data-toggle":"tooltip",
                                        "title":"Approve Request",
                                        "class": "label label-success mr-1 mb-1 change-request-status",
                                        "data-id": data.id,
                                        "data-status": 3,
                                        "style": "cursor:pointer"
                                    }).append($('<i class="fa fa-check"></i>')).appendTo(actionWrapper);
                                    $("<span></span>").attr({
                                        "data-toggle":"tooltip",
                                        "title":"Reject Request",
                                        "class": "label label-danger change-request-status",
                                        "data-id": data.id,
                                        "data-status": 4,
                                        "style": "cursor:pointer"
                                    }).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                                }
                                else if(!is_colette && (data.status_id == 3 || data.status_id == 4)){
                                    $("<span></span>").attr({
                                        "data-toggle":"tooltip",
                                        "title":"Cancel Request",
                                        "class": "label label-info change-request-status",
                                        "data-id": data.id,
                                        "data-status": 1,
                                        "style": "cursor:pointer"
                                    }).append($('<i class="fa fa-times"></i>')).appendTo(actionWrapper);
                                }
                                return actionWrapper.html();
                            }
                        }
                    ],
                    select: false,
                    buttons: [
                        /*
                        { extend: "create", editor: editor },
                        { extend: "edit",   editor: editor },
                        { extend: "remove", editor: editor }
                        {
                            extend: "selectedSingle",
                            text: "Approve",
                            action: function ( e, dt, node, config ) {
                                // Immediately add `250` to the value of the salary and submit
                                editor
                                    .edit( DataTable.row( { selected: true } ).index(), false )
                                    .set( 'status', 3 )
                                    .submit();
                            }
                        },
                        {
                            extend: "selectedSingle",
                            text: "Reject",
                            action: function ( e, dt, node, config ) {
                                // Immediately add `250` to the value of the salary and submit
                                editor
                                    .edit( DataTable.row( { selected: true } ).index(), false )
                                    .set( 'status', 4 )
                                    .submit();
                            }
                        },
                        */
                    ]
                });
                $("#spreadsheet-table").on('click', "span.change-request-status", function(){
                    console.log($(this))
                    let ele = $(this);
                    $.ajax({
                        url: "{{ route('sheet.update.status') }}",
                        type: "post",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            id: ele.data('id'),
                            status_id: ele.data('status')
                        },
                        success: function(result){
                            console.log(result);
                            DataTable.ajax.reload();
                        },
                        error: function(result){
                            // console.log(error);
                        }
                    });
                })
            });
        });
        $(".excel-import").click(function(){
            $(this).siblings("input#excel_import").click();
        })
        $(document).on('change', 'input#excel_import', function(){
            var name = $(this).data("name");
            let file = $(this)[0].files[0];
            let client_id = $(this).data("id");
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });

                workbook.SheetNames.forEach(function(sheetName) {
                    // Here is your object
                    var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                    $('#preloader').css('display','block');
                    send_rows(XL_row_object, 0, client_id,name);
                    // var json_object = JSON.stringify(XL_row_object);
                    // console.log(json_object);
                })
            };

            reader.onerror = function(ex) {
                console.log(ex);
            };

            reader.readAsBinaryString(file);
        });
        function send_rows1(rows, index, client_id,name){
            send_rows(rows, index, client_id,name);
        }
        function send_rows(rows, index, client_id,name){
            console.log(client_id);
            let  send_rows = [];
            let add = 199;
            for(i = index; i <= index+add; i++){
                send_rows.push(rows[i]);
            }
            $.ajax({
                url: "{{ route('sheet.upload') }}",
                method: "post",
                datatype: "json",
                data: {
                    client_id: client_id,
                    rows: send_rows,
                    name:name,
                    "_token":"{{csrf_token()}}",
                    
                },
                error: function(err){
                    console.log(err);
                },
                success: function(result){
                    // result = JSON.(result);
                    index += add;
                    console.log(index);
                    if(result.status){
                        if(rows.length > index){
                            send_rows1(rows, (index+1), client_id,name);
                            return;
                        }
                    }
                    window.location.reload();
                }
            })
        }
    </script>
@endpush
