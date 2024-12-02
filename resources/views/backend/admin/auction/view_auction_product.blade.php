@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction List</li>
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
                    <?php 
                    if($start_time_of_auction !="")
                    {
                    ?>
                        Auction List ({{$start_time_of_auction}} - {{$end_time_of_auction}})
                    <?php 
                    }
                    else 
                    {
                    ?>  
                      Auction List
                    <?php    
                    }
                    ?>
                    <a href="{{route('product.view_unsold')}}"  style="float: right;">Add New Auction</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    {{-- <th>Name</th> --}}
                                    <th>Auction No.</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial</th>
                                    
                                    <th>Bids</th>
                                    <th>Bidders</th>
                                    
                                    <?php 
                                    if($final_result =='unsold')
                                    {
                                    ?>
                                    <th>Action</th>
                                    <?php 
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($products as $b)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><img src="{{asset($b->thumbnail_sm_image)}}"  style="width: 60px;height:auto;"></td>
                                    
                                    <td>{{ $b->product_no}}</td>
                                    <td>{{ $b->category->name_en}}</td>
                                    <td>{{ $b->brand_id !=""?$b->brand->name_en:""}}</td>
                                    <td>{{ $b->model_no}}</td>
                                    <td>{{ $b->serial_no}}</td>

                                    <td>{{ $b->total_bids }}</td>
                                    <td>
                                        <a href="{{url('auction/biddersview/'.$b->id)}}">
                                            <i id="no-print-eye" class="fa fa-eye" aria-hidden="true"> View</i>
                                        </a>
                                    
                                    </td>
                                    
                                    <?php 
                                    if($final_result =='unsold')
                                    {
                                    ?>
                                    <td style="min-width: 480px;">
                                        <a href="{{url('product/imageview/'.$b->id)}}" class="btn btn-success">Image</a>
                                        <a href="{{url('product/videoview/'.$b->id)}}" class="btn btn-success">Video</a>
                                        <?php 
                                        if($b->conditional_report != "")
                                        {
                                        ?>
                                        <a onclick="windopen({{$b->id}});" href="javascript:" class="btn btn-success">Report</a>
                                        <?php 
                                        }
                                        ?>
                                        <a href="{{url('auction/edit/'.$b->id)}}" class="btn btn-success">Edit</a>
                                        <a href="{{url('auction/remove/'.$b->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to remove from auction')">Delete From Auction</a>
                                    </td>
                                    <?php 
                                    }
                                    ?>
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    function windopen(pid)
      {
      
          var w_size=1050;
          var h_size=750;
      
          var l_position=Number((window.screen.width-w_size)/2);
          var t_position=Number((window.screen.height-h_size)/2);
      
          window.open('/product/conditional_report?id='+pid,'newWindow2','toolbar=no,statusbar=no,status=no,scroll=yes,scrollbars=yes,location=no,directories=no,menubar=no,resizable=yes,width='+ w_size +',height='+h_size+',left='+l_position+',top='+t_position);
      }
</script>


@endsection


