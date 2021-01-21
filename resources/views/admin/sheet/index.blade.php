@extends('admin.layout.master')
@push('styles')
    
@endpush
<style type="text/css">
    th 
    {
        background: #eaeef3;
        font-size: 1.10vw !important;
    max-width: 1047px;
    min-width: 192px;
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
</style>
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Spread Sheet</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Spread Sheet</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <button class="btn btn-primary excel-import p-3">
                                Import SpreadSheet
                            </button>
                            <input type="file" id="excel_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>Spread Sheet</header>
                                <div class="tools">
                                    {{-- <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a> --}}
                                    {{-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> --}}
                                    {{-- <a class="t-close btn-color fa fa-times" href="javascript:;"></a> --}}
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table id="spreadsheet-table" class="table custom-table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Ward</th>
                                                <th>Request Grade</th>
                                                <th>Cadidate</th>
                                                <th>National Insurance</th>
                                                <th>Comment From Colette</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
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
            var editor; // use a global for the submit and return data rendering in the examples
            $(document).ready(function(){
                editor = new $.fn.dataTable.Editor({
                    ajax: "{{ route('sheet.edit') }}",
                    table: "#spreadsheet-table",
                    idSrc: "id",
                    fields: [
                        {
                            label: "Candidate:",
                            name: "candidate"
                        },
                        {
                            label: "National Insurance:",
                            name: "national_insurance"
                    }]
                });
                $("#spreadsheet-table").on( 'click', 'tbody td:not(:first-child)', function (e){
                    try {
                        editor.inline( this );
                    } catch (error) {
                        console.log(error);                    
                    }
                });
                $("#spreadsheet-table").DataTable({
                    dom: "Bfrtip",
                    ajax: "{{ route('sheet.datatable') }}",
                    order: [[ 1, 'asc' ]],
                    columns: [
                        {
                            data: "request_id"
                        },
                        {
                            data: "date"
                        },
                        {
                            data: "start"
                        },
                        {
                            data: "end"
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
                            data: "status_id"
                    }],
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                    buttons: [
                        // { extend: "create", editor: editor },
                        // { extend: "edit",   editor: editor },
                        // { extend: "remove", editor: editor }
                    ]
                });
            });
        });
        $(".excel-import").click(function(){
            $(this).siblings("input#excel_import").click();
        })
        $(document).on('change', 'input#excel_import', function(){
            var name=$(this).data("name");
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
