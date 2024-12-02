@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Member Crediential</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Member Edit Crediential</li>
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
                        Member Edit Crediential Form
                        <a href="{{route('bidder.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <form action="{{route('bidder.update_crediential',[$bidder->id])}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="usercodeno" value="{{$bidder->usercodeno}}">

                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="name_jp"
                                class="col-sm-3 text-end control-label col-form-label">Username</label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$bidder->username}}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-sm-3 text-end control-label col-form-label">Password &nbsp;<span style="color:rgb(252, 4, 4)">*</span></label>
                            <div class="col-sm-6">
                                <input type="password"  name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="enter password for acount">
                                @error('password')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password"
                                class="col-sm-3 text-end control-label col-form-label">Confirm Password &nbsp;<span style="color:rgb(252, 4, 4)">*</span></label>
                            <div class="col-sm-6">
                                <input type="password"  name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"  autocomplete="off">
                                @error('confirm_password')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>


  
@endsection


