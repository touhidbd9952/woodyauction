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
                                    <li class="breadcrumb-item active" aria-current="page">Product Video List</li>
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
                    Product Video List 
                    <a href="{{url('productvideo/addmore/' . $product->id)}}"  style="float: right;">Add New</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    
                    <div>
                        
                        <form action="{{url('product/youtube_video_update',$product->id)}}" method="post" >
                           
                            @csrf
    
                            <div class="form-group row">
                                <label for="fname"
                                    class="col-sm-3 text-end control-label col-form-label">Youtube Share Link</label>
                                <div class="col-sm-6">
                                    <input type="text"  name="videourl" id="youtubevideolink"   value="{{$product->videourl !=""?$product->videourl:old('youtubevideolink')}}"   autocomplete="off" class="form-control @error('youtubevideolink') is-invalid @enderror" style="max-width:250px;display:inline;">
                                    @error('youtubevideolink')
                                        <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                
                                    <button type="submit" class="btn btn-primary" >
                                        Save
                                    </button>
                                    <span onclick="loadvideo();" style="width: 100px;margin-left:20px;cursor:pointer;color:blue;padding:5px;border:1px solid #ccc;">Show Video</span>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="fname"
                                    class="col-sm-3 text-end control-label col-form-label">&nbsp;</label>
                                <div class="col-sm-6">
                                    
                                    <iframe width="300" height="225" id="videourl" src="{{$product->videourl}}">
                                    </iframe>
                                </div>
                            </div>
                            
    
                            
                            
                        </form>    
    
                        </div>

                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Auction No.</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($productvideos as $pv)
                                <tr>
                                    <td>{{ $productvideos->firstitem()+$loop->index }}</td>
                                    <td>{{ $pv->product->product_no}}</td>
                                    <td>{{ $pv->product->category->name_en}}</td>
                                    <td>{{ $pv->publish_status }}</td>
                                    <td>{{ $pv->created_at }}</td>
                                    <td>
                                        <a href="{{url('productvideo/edit/'.$pv->id)}}" class="btn btn-success">Edit</a>
                                        <a href="{{url('productvideo/delete/'.$pv->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $productvideos->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var videoplayer = document.getElementById('videourl');
    videoplayer.style.display="none";
    function loadvideo()
    {
        //alert('paisi');
        var youtubevideolink = document.getElementById('youtubevideolink').value;  //alert(youtubevideolink);
        if(youtubevideolink != "")
        {
            youtubevideolink = youtubevideolink.replace("https://youtu.be/", "https://www.youtube.com/embed/");  //alert(youtubevideolink);
            videoplayer.style.display="block";
            //var videoplayer = document.getElementById('videourl');
            videoplayer.src = youtubevideolink;
            videoplayer.play();
        }
    }
</script>



@endsection


