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
                                    <li class="breadcrumb-item active" aria-current="page">Video Upload Form</li>
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
                    Video Upload Form
                    <a href="{{route('product.view_unsold')}}"  style="float: right;">View Unsold Product</a>
                </div>
                
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                    </div>
                    @endif

                    <form action="{{ url('productvideo/addmoreupload/' . $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="videofile" class="col-md-3 col-form-label text-md-right">Select video to upload</label>

                            <div class="col-md-6">
                                <input  type="file" name="videofile" id="videofile" class="form-control @error('videofile') is-invalid @enderror"  value="{{ old('videofile') }}" required  autofocus>

                                @error('videofile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Upload
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


