@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">{{$menuname != ""?$menuname:"Product"}}</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">History</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sold Product List</li>
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
                    Sold Product List
                    {{-- <a href="{{route('auction.view_auction_history')}}"  style="float: right;">Back</a> --}}
                    <a href="javascript:" onclick="history.back(); return false;" style="float: right;">Back</a>
                </div>

                <div class="card-body">



                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    

                    <div class="table-responsive">
                        <table id="example" border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Auction No.</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial</th>
                                    <th>Status</th>
                                    <th>Sold Price (¥)</th>
                                    <th>Sold Date</th>
                                    <th>Winner</th>
                                    <th></th>
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
                                    <td>{{ $b->final_result }}</td>
                                    <td>{{ number_format($b->auction_max_bid_amount) }}</td>
                                    <td>{{ $b->updated_at }}</td>
                                    <td>
                                        <?php 
                                        if($b->auction_max_bidder_id !=0 || $b->auction_max_bidder_id !="")
                                        {
                                        ?>
                                        <a href="{{url('bidder/details_view/'.$b->auction_max_bidder_id.'/'.$b->id)}}" class="">
                                        {{ $b->auction_max_bidder_id !=0? $b->first_bidder->usercodeno:''}}
                                        </a>
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td style="min-width: 400px;">
                                        <a href="{{url('product/details_view/'.$b->id)}}" class="btn btn-success">Details</a>
                                        <?php 
                                        if($b->conditional_report != "")
                                        {
                                        ?>
                                        <a href="{{url('product/view_condition_report/'.$b->id)}}" class="btn btn-success">Report</a>
                                        <?php 
                                        }
                                        ?>
                                        
                                        <a href="{{url('auction/edit_for_invoice/'.$b->id)}}" class="btn btn-success">
                                            Edit
                                        </a>
                                        
                                        <a href="{{url('product/sold_product_return_as_unsold/'.$b->id)}}" class="btn btn-danger">Return As Unsold</a>

                                    </td>
                                    
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
    $(function () {
      
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


@endsection


