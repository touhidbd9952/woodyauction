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
                                    <li class="breadcrumb-item active" aria-current="page">Owner Edit Form</li>
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
                        Owner Edit Form
                        <a href="{{route('owner.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif

                                    
                    <form action="{{route('owner.change_password',[$woner->id])}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                    <div class="card-body">
                        

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">User ID</label>
                            <div class="col-sm-6">
                                <input type="text"  name="username" class="form-control" value="{{$woner->username}}" readonly>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="text"  name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Confirm Password</label>
                            <div class="col-sm-6">
                                <input type="text"  name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror">
                                @error('confirmpassword')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                       
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>


  
@endsection


