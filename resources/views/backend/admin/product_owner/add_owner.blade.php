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
                                    <li class="breadcrumb-item active" aria-current="page">Owner Add Form</li>
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
                        Owner Add Form
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


                    <form action="{{route('owner.store')}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">User ID</label>
                            <div class="col-sm-6">
                                <input type="text"  name="username" class="form-control @error('username') is-invalid @enderror" value="{{$userID}}" readonly>
                                @error('username')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Password (5-6 degit)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="password" class="form-control @error('password') is-invalid @enderror" value="{{$userPass}}">
                                @error('password')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Company Name (en)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="company_name_en" class="form-control @error('company_name_en') is-invalid @enderror" value="{{old('company_name_en')}}">
                                @error('company_name_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Company Name (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="company_name_jp" class="form-control @error('company_name_jp') is-invalid @enderror" value="{{old('company_name_jp')}}">
                                @error('company_name_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Owner Name (en)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{old('name_en')}}">
                                @error('name_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Owner Name (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_jp" class="form-control @error('name_jp') is-invalid @enderror" value="{{old('name_jp')}}">
                                @error('name_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Person Incharge (en)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="person_incharge_en" class="form-control @error('person_incharge_en') is-invalid @enderror" value="{{old('person_incharge_en')}}">
                                @error('person_incharge_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Person Incharge (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="person_incharge_jp" class="form-control @error('person_incharge_jp') is-invalid @enderror" value="{{old('person_incharge_jp')}}">
                                @error('person_incharge_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">address</label>
                            <div class="col-sm-6">
                                <textarea  name="address" autocomplete="off" class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Product owner address">{{old('address')}}</textarea>
                                @error('address')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Post code</label>
                            <div class="col-sm-6">
                                <input type="text"  name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{old('postcode')}}">
                                @error('postcode')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Country</label>
                            <div class="col-sm-6">
                                <input type="text"  name="country" class="form-control @error('country') is-invalid @enderror" value="{{old('country')}}">
                                @error('country')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Email 1</label>
                            <div class="col-sm-6">
                                <input type="email"  name="email1" class="form-control @error('email1') is-invalid @enderror" value="{{old('email1')}}">
                                @error('email1')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Email 2(optional)</label>
                            <div class="col-sm-6">
                                <input type="email"  name="email2" class="form-control @error('email2') is-invalid @enderror" value="{{old('email2')}}">
                                @error('email2')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Phone 1</label>
                            <div class="col-sm-6">
                                <input type="number"  name="phone1" class="form-control @error('phone1') is-invalid @enderror" value="{{old('phone1')}}">
                                @error('phone1')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone2"
                                class="col-sm-3 text-end control-label col-form-label">Phone 2(optional)</label>
                            <div class="col-sm-6">
                                <input type="number"  name="phone2" class="form-control @error('phone2') is-invalid @enderror" value="{{old('phone2')}}">
                                @error('phone2')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fax"
                                class="col-sm-3 text-end control-label col-form-label">Fax</label>
                            <div class="col-sm-6">
                                <input type="number"  name="fax" class="form-control @error('fax') is-invalid @enderror" value="{{old('fax')}}">
                                @error('fax')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        
                       
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Save</button>
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


