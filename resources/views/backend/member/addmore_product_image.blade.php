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
                                    <li class="breadcrumb-item active" aria-current="page">Product Image Add More Form</li>
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
                    Product Image Add More Form
                    <a href="{{url('member_product/imageview/'.$product_id)}}"  return false;"  style="float: right;">Back</a>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <form name="myform" action="{{url('member_productimage/addmoreupload')}}"  method="POST" enctype="multipart/form-data" class="form-horizontal">

                        @csrf

                        <input type="hidden" name="product_id" value="{{$product_id}}">

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Image</label>
                            <div class="col-sm-9">
                                <input type="file"  name="image[]" id="productmultipleimage"  class="form-control @error('image') is-invalid @enderror"
                                     multiple>
                                    
                                    <div id="myImg"></div>
                            </div>
                        </div>

                        


                        
                        
                       
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    //multiple seleted image show    
    $(function() {
      $("#productmultipleimage").change(function() {
        if (this.files && this.files[0]) {
          for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[i]);
          }
        }
      });
    });
    
    function imageIsLoaded(e) {
      $('#myImg').append('<img src=' + e.target.result + ' style="width:200px;height:200px">');
    };
</script>



@endsection


