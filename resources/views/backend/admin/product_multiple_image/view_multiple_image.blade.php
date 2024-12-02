@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View multiple image</li>
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
                    Product: {{$selectedproduct->product_name}} 
                    <a href="{{route('product.view_unsold')}}"  style="float: right;">View Unsold Product</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <div class="row">
                                                                        
                        <div class="col-md-3">
                                <div class="p-20">
                                    <h5>Thumbnail Image </h5>
                                    <img src="{{ asset($selectedproduct->thumbnail_image) }}" style="height:200px;widht:180px;">

                                    <a href="{{url('productthumbnailimage/edit/'.$selectedproduct->id)}}" class="btn btn-success" style="float:left;">Edit</a>
                                        
                                </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <a href="{{url('productimage/delete_all_productimage/'.$selectedproduct->id)}}" onclick="return confirm('Are you shure want to delete all multiple image')" class="btn btn-danger" style="float: right;">Delete All Multiple Image</a>
                            <a href="{{url('productimage/addmore/'.$selectedproduct->id)}}" class="btn btn-primary" style="float: right;">Add More Multiple Image</a>
                            
                        </div>
                    </div>    

                    <div class="row">
                   
                    @foreach($productmultipleimages as $pimage)
                        <div class="col-md-3">
                            <div class="p-20">
                                <a href="{{url('productimage/edit/'.$pimage->id.'/'.$selectedproduct->id)}}" class="btn btn-success" style="float:left;">Edit</a>
                                <img src="{{ asset($pimage->image_ms) }}" style="float:left;height:auto;widht:200px;">
                                <a href="{{url('productimage/delete/'.$pimage->id)}}" onclick="return confirm('Are you Shure want to delete?')" class="btn btn-danger" style="float:left;">Delete</a>

                            </div>
                            
                        </div>
                    @endforeach
                    
                    </div>



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


