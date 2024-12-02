@extends('layouts.member_admin_master')

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
                                    <li class="breadcrumb-item"><a href="{{url('/member_dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Thumbnail Edit Form</li>
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
                    Product Thumbnail Edit Form
                    <a href="{{url('member_product/imageview/'.$product_id)}}"  return false;"  style="float: right;">Back</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form name="myform" action="{{url('member_product/change_thumbnail/'.$product->id)}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="old_thumnail" value="{{$product->thumbnail_image}}">
                       
                       
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Thumbnail Image</label>
                            <div class="col-sm-9">
                                <input type="file"  name="thumbnail_image" id="imgInp"  class="form-control @error('thumbnail_image') is-invalid @enderror"
                                onchange="loadFile(event)">
                                    <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:auto;margin-top:10px;">
                            </div>
                           
                        </div>
                       
                       
                       
                    
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Change Thumbnail</button>
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


