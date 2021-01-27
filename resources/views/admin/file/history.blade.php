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
    <script src="{{ asset('datatable/Main/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatable/Main/js/jszip.min.js') }}"></script>
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
                        data: "comment_from_colette"

                    },
                    {
                        data: "status.name"
                    }
                    
                ],
                select: {
                    style:    'os',
                    selector: 'td:first-child'
                },
                buttons: [
                    'selectAll',
                    'selectNone',

                    {
                        text: "Delete",
                        action:  function ( e, dt, node, config ) {
                            let selectedRows = DataTable.rows( { selected: true } ).data();
                            
                            // let ids_keys = Object.keys(selectedRows);
                            const arrr = []
                            const ids_keys = selectedRows.map(row=>{arrr.push(row.id)});
                           console.log(arrr)
                        //    const response =  fetch("/user/history/delete", {
                        //         method: 'POST', // *GET, POST, PUT, DELETE, etc.
                        //         mode: 'cors', // no-cors, *cors, same-origin
                        //         cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                        //         body:JSON.stringify(arrr),
                        //         headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        //     },
                                
                        //     });
                        //     postData('/user/history/delete')
                        //         .then(data => {
                        //             console.log(data); // JSON data parsed by `data.json()` call
                        //         });
                        
                         
                        //    alert(ids_keys);
                            $.ajax({           
                                url:"{{ route('history.delete') }}",
                                type:"POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'content-type':"application/json"
                                },
                                data:JSON.stringify({ data: arrr }),
                                success:function(result){
                                    console.log('ids_keys',result);
                                    if(result == 1){
                                        location.reload();
                                    }
                                }
                            });
                        },
                        enabled:false
                    },
                    // { extend: "remove", editor: editor },
                    /*
                    { extend: "create", editor: editor },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                    */
                    {
                    extend: 'excel',
                    text: "Export Spreadsheet",
                    filename: 'Spreadsheet-{{ date("Y-m-d", time()) }}',
                    exportOptions:
                    {
                        columns: [ 2, 3, 4, 5, 6, 7, 9, 10, 11 ]
                    }
                },
                ]
            });
            DataTable.on( 'select deselect', function () {
                var selectedRows = DataTable.rows( { selected: true } );
                DataTable.button( 2 ).enable( selectedRows.length > 0 );
            } );
            
        });


        
    </script>
@endsection