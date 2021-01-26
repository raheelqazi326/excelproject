@extends('admin.layout.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Main/css/editor.dataTables.min.css') }}">
@endpush
@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
           
        <div class="row">
            
              @if(Session::has('message'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ Session::get('message') }}.
                </div>
                @endif
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-green">
                            <div class="card-head">
                                <header>HISTORY</header>
                            </div>
                            <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-hover" id="data-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Id</th>
                                            <th>Request Id</th>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Ward</th>
                                            <th>Request Grade</th>
                                            <th>Candidate</th>
                                            <th>National Insurance</th>
                                            <th>Comment From Colette</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-table">
                                        
                                    </tbody>
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
@section('script')
    <script src="{{ asset('datatable/Main/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/dataTables.editor.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            editor = new $.fn.dataTable.Editor({
                ajax: {
                    url:"{{ route('history.delete') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                table: "#data-table",
                idSrc: "id",
                fields: []
            });
            let DataTable = $("#data-table").DataTable({
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100,"All"]],
                // "iDisplayLength": -1,
                dom: "Brtip",
                processing: true,
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>',
                    selectAll: "Select all",
                    selectNone: "Select none"
                }, 
                orderCellsTop: true,
                fixedHeader: true,         
                ajax: "{{ route('history.data') }}",
                // order: [[ 1, 'asc' ]],
                columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
                } ],
                columns: [
                    {
                        data: null,
                        defaultContent: '',
                        orderable: false,
                        render: function ( data, type, row ) {
                            return ;
                        }
                    },
                    {
                        data: "id",
                        visible:false,
                    },
                    {
                        data: "request_id",
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
                        data: "status.name"
                    },
                    {
                        data: "comment_from_colette"
                    }
                    
                ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                buttons: [
                    'selectAll',
                    'selectNone',
                    // {
                    //     text: "Delete",
                    //     action: function ( e, dt, node, config ) {
                    //         console.log(DataTable.rows( { selected: true } ).data());
                    //     },
                    //     enabled:false
                    // },
                    { extend: "remove", editor: editor }
                    /*
                    { extend: "create", editor: editor },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                    */
                ]
            });
            DataTable.on( 'select deselect', function () {
                var selectedRows = DataTable.rows( { selected: true } );
                DataTable.button( 2 ).enable( selectedRows > 0 );
            } );
            
        });


        
    </script>
@endsection