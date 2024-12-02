@extends('layouts.admin_master')

@section('content')

<style>
    .page{background: #fbfafa;}
    
    @font-face {
      font-family: 'password';
      font-style: normal;
      font-weight: 400;
      src: url('../fontend/fonts/password.ttf');
    }
    input.myclass{font-family: 'password';}
    </style>

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Account</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Form</li>
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
                    Add Form
                    <a href="{{route('admin.view')}}"  style="float: right;">View Account</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('admin.store')}}" method="post" >
                       
                        @csrf

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name" value="{{old('name')}}"  autocomplete="off" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email"  name="email" value="{{old('email')}}" autocomplete="off" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="search"  name="password" autocomplete="off" class="form-control myclass @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Confirm Password</label>
                            <div class="col-sm-6">
                                <input type="search"  name="password_confirmation" autocomplete="off" class="form-control myclass @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>



@endsection


