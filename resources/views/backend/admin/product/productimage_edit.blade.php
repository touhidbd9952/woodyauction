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
                                    <li class="breadcrumb-item active" aria-current="page">Product Image Edit Form</li>
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
                    Product Image Edit Form
                    <a href="{{url('product/imageview/'.$product_id)}}"  return false;"  style="float: right;">Back</a>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <form name="myform" action="{{url('productimage/update/'.$productimagedata->id)}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="oldproductimage_L" value="{{$productimagedata->image_L}}">
                        <input type="hidden" name="oldproductimage_ms" value="{{$productimagedata->image_ms}}">
                        <input type="hidden" name="oldproductimage_sm" value="{{$productimagedata->image_sm}}">

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Image</label>
                            <div class="col-sm-9">
                                <input type="file"  name="productimage" id="imgInp"  class="form-control @error('productimage') is-invalid @enderror"
                                onchange="loadFile(event)">
                                @error('productimage')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label"></label>
                            <div class="col-sm-9">
                                <img src="{{asset($productimagedata->image_L)}}" id="output" style="height:auto;width:300px">
                                
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


