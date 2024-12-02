@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Category</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category Edit Form</li>
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
                        Category Edit Form
                        <a href="{{route('category.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <form action="{{url('category/update/'.$categories->id)}}" enctype="multipart/form-data"  method="POST" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="old_img" value="{{$categories->image}}">
                        
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_en" value="{{$categories->name_en}}" class="form-control @error('name_en') is-invalid @enderror">
                                @error('name_en')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Name (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="name_jp" value="{{$categories->name_jp}}" class="form-control @error('name_jp') is-invalid @enderror">
                                @error('name_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Indexing</label>
                            <div class="col-sm-6">
                                <input type="number"  name="sl" value="{{$categories->sl}}" min="0" max="50" class="form-control @error('sl') is-invalid @enderror">
                                @error('sl')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{$categories->publish_status=='active'?'selected':''}}>Active</option>
                                    <option value="inactive" {{$categories->publish_status=='inactive'?'selected':''}}>Inactive</option>
                                </select>
                                @error('publish_status')
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


