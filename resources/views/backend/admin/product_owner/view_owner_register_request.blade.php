@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product Owner</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">New Request List </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        New Request List
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company </th>
                                    <th>Name </th>
                                    <th>Person Inchage </th>
                                    <th>Email </th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($productownerrequests as $d)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $d->company_name_jp !=""? $d->company_name_jp : $d->company_name_en}}</td>
                                    <td>{{ $d->name_jp !=""? $d->name_jp : $d->name_en}}</td>
                                    <td>{{ $d->person_incharge_jp !=""? $d->person_incharge_jp : $d->person_incharge_en}}</td>
                                    <td>{{ $d->email1 }}</td>
                                    <td>{{ $d->phone1 }}</td>
                                    <td>{{ $d->country }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td style="min-width: 130px;">
                                        <a href="{{url('productowner/view_request_details/'.$d->id)}}" class="btn btn-success">View</a>
                                        <a href="{{url('productowner/delete_request/'.$d->id)}}" class="btn btn-success">Delete</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection


