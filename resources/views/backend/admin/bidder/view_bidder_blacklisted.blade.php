@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Member</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Member List </li>
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
                        Member Listed Bidders
                        
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
                                    <th>Code </th>
                                    <th>Name </th>
                                    <th>Status</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($bidders as $d)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $d->usercodeno }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>
                                        <a href="{{url('bidder/edit_profile/'.$d->id)}}" class="btn btn-success">Edit Profile</a>
                                        <a href="{{url('bidder/edit_credential/'.$d->id)}}" class="btn btn-success">Edit credential</a>
                                        <?php 
                                        if($d->status =="active")
                                        {
                                        ?>
                                        <span class="btn btn-primary">Active</span>
                                        <?php 
                                        }
                                        else 
                                        {
                                        ?>  
                                         <span class="btn btn-danger" >Inactive</span> 
                                        <?php    
                                        }
                                        ?>
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


