@extends('layouts.member_admin_master')

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
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product List in Current Auction</li>
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
                    Product List (Current Auction)
                    
                    <a href="{{route('member.product.add_form')}}"  style="float: right;">Add New</a>
                    
                    <a href="javascript:" onclick="history.back(); return false;" style="float: right;margin:0 15px;">Back</a>
                </div>

                <div class="card-body">



                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float:right;"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    @if(isset($emsg))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> {{$emsg}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float:right;"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif

                    

                    <div class="table-responsive">
                        <table id="example" border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    {{-- <th>Name</th> --}}
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial</th>
                                    <th>Status</th>
                                    <th>Price (¥)</th>
                                    <th>Created at</th>
                                    <th>Action</th>
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
                                    {{-- <td>{{ $b->name_en}}</td> --}}
                                    <td>{{ $b->category->name_en}}</td>
                                    <td>{{ $b->brand_id !=""?$b->brand->name_en:""}}</td>
                                    <td>{{ $b->model_no}}</td>
                                    <td>{{ $b->serial_no}}</td>
                                    <td>{{ $b->status }}</td>
                                    <td>{{ number_format($b->bid_start_price) }}</td>
                                    <td>{{ $b->created_at }}</td>
                                    <td style="min-width: 480px;">
                                        <a href="{{url('member_product/imageview/'.$b->id)}}" class="btn btn-success">Image</a>
                                        <?php 
                                        if($b->conditional_report != "")
                                        {
                                        ?>
                                        <a href="{{url('member_product/view_condition_report/'.$b->id)}}" class="btn btn-success">Report</a>
                                        <?php 
                                        }
                                        ?>

                                        <a href="{{url('member_product/viewbyid/'.$b->id)}}" class="btn btn-success">View Deatils</a>
                                        {{-- <a href="javascript:" onclick="request_for_approve({{$b->id}})" class="btn btn-success">Request For Approve</a> --}}
                                        {{-- <a href="{{url('member_product/delete/'.$b->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a> --}}
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
    function request_for_approve(id)
    {
        $.ajax({
            type:'GET',
            url: '/member_product/request_for_approve/'+id,
            dataType:'json',
            success:function(data){
                if(data == 'success')
                {
                    location.reload();
                }
            }
        })
    }
</script>

@endsection


