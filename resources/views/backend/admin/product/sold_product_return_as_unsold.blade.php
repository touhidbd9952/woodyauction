@extends('layouts.admin_master')

@section('content')

<style>
    .red{color: red;padding-left:10px;}
    .addnew{cursor: pointer;color: blue;text-decoration: underline;}
</style>    
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
                                    <li class="breadcrumb-item active" aria-current="page">Sold Product Return As Unsold Form</li>
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
                    Sold Product Return As Unsold Form
                    <a href="{{route('product.view_sold')}}"  style="float: right;">View Sold Products</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                    </div>    
                    @endif
                    
                      
                    <form action="{{route('product.return_as_unsold')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{$id}}">

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">&nbsp; </label>
                            <div class="col-sm-6">
                                
                                    <img src="{{asset($product->thumbnail_image)}}" id="output" style="width: 300px;height:225px;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label"> Auction No.</label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$product->product_no}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Category </label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$product->category->name_en}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Brand </label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$product->brand->name_en}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Model </label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$product->model_no}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Serial </label>
                            <div class="col-sm-6">
                                <label class="form-control">{{$product->serial_no}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Product Return Reason <span class="red">*</span></label>
                            <div class="col-sm-6">
                                <textarea name="product_return_note" autocomplete="off" class="form-control @error('product_return_note') is-invalid @enderror" ></textarea>
                                @error('product_return_note')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    Return To Unsold Product List
                                </button>
                            </div>
                        </div>

                    </form>

                    

                </div>
            </div>

        </div>
    </div>
</div>











@endsection


