@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Slider</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Fabricator Slider Add Form</li>
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
                    Fabricator Slider Add Form
                    <a href="{{route('slider.view')}}"  style="float: right;">View Slider</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Slider Title</label>
                            <div class="col-sm-6">
                                <input type="text"  name="title" autocomplete="off" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Slider Title (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="title_jp" autocomplete="off" class="form-control @error('title_jp') is-invalid @enderror">
                                @error('title_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Slider Sub-title</label>
                            <div class="col-sm-6">
                                <input type="text"  name="subtitle" autocomplete="off" class="form-control @error('subtitle') is-invalid @enderror">
                                @error('subtitle')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Slider Sub-title (JP)</label>
                            <div class="col-sm-6">
                                <input type="text"  name="subtitle_jp" autocomplete="off" class="form-control @error('subtitle_jp') is-invalid @enderror">
                                @error('subtitle_jp')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Slider Image</label>
                            <div class="col-sm-6">
                                <input type="file"  name="slider_image" id="imgInp"  class="form-control @error('slider_image') is-invalid @enderror" 
                                onchange="loadFile(event)">
                                    <img src="{{asset('fontend/images/slider-image-size.jpg')}}" id="output" style="width: 300px;height:auto;margin-top:10px;border:1px solid #ccc;">
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="fname"
                                class="col-sm-3 text-end control-label col-form-label">Publish status</label>
                            <div class="col-sm-6">
                                <select name="publish_status" class="form-control @error('publish_status') is-invalid @enderror">
                                    <option value="publish">Publish</option>
                                    <option value="unpublish">Unpublish</option>
                                </select>
                                @error('publish_status')
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


