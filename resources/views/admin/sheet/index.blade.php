@extends('admin.layout.master')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
    
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>STRIPED TABLE</header>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                </div>
                            </div>
                            <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-hover">
                                    <thead>
                                        <tr>
                                            <th> Company</th>
                                            <th>Descrition</th>
                                            <th>Profit</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">VectorLab</a>
                                            </td>
                                            <td >Lorem Ipsum dorolo imit</td>
                                            <td>693030.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-info label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> Admin Lab </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>10003.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-warning label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> Metro Lab </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>23400.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 76%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="76" role="progressbar" class="progress-bar progress-bar-info"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-success label-mini">Paid</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> Flat Lab </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>36342.50$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-danger label-mini">Paid</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#">Slick Lab</a>
                                            </td>
                                            <td >Lorem Ipsum dorolo imit</td>
                                            <td>4022.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-primary label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> TroCode </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>526456.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-warning label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                           <td><a href="#">Vector Ltd</a>
                                            </td>
                                            <td >Lorem Ipsum dorolo imit</td>
                                            <td>12120.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 43%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar progress-bar-info"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-success label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> Dashboard </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>56456.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-warning label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#">Vector Ltd</a>
                                            </td>
                                            <td >Lorem Ipsum dorolo imit</td>
                                            <td>12120.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 88%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="88" role="progressbar" class="progress-bar progress-bar-info"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-info label-mini">Due</span>
                                            </td>
                                            <td >
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
                                        <tr>
                                            <td><a href="#"> Modern </a>
                                            </td>
                                            <td >Lorem Ipsum dorolo</td>
                                            <td>56456.00$</td>
                                            <td>
                                                <div class="progress progress-striped progress-xs">
                                                    <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info"></div>
                                                </div>
                                            </td>
                                            <td><span class="label label-warning label-mini">Due</span>
                                            </td>
                                            <td >
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