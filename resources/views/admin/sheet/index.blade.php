@extends('admin.layout.master')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Basic Tables</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="#">Data Tables</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Basic Tables</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <button class="btn btn-primary excel-import p-3">
                                Import
                            </button>
                            <input type="file" id="excel_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>Requests</header>
                                <div class="tools">
                                    {{-- <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a> --}}
                                    {{-- <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a> --}}
                                    {{-- <a class="t-close btn-color fa fa-times" href="javascript:;"></a> --}}
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Date</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Name</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#">VectorLab</a>
                                                </td>
                                                <td>Lorem Ipsum dorolo imit</td>
                                                <td>Lorem Ipsum dorolo imit</td>
                                                <td>Lorem Ipsum dorolo imit</td>
                                                <td>693030.00$</td>
                                                <td>
                                                    <div class="progress progress-striped progress-xs">
                                                        <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="label label-info label-mini">Due</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-xs">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-primary btn-xs">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash-o "></i>
                                                    </button>
                                                </td>
                                            </tr>
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
@push('scripts')
    <script src="{{ asset('assets/js/pages/excel-import/jszip.js') }}"></script>
    <script src="{{ asset('assets/js/pages/excel-import/xlsx.js') }}"></script>
    <script>
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