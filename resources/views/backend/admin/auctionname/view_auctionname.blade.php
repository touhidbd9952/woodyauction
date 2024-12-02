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
                                    <li class="breadcrumb-item active" aria-current="page">Auction List </li>
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
                    <h5 class="card-title">
                        Auction List
                        <a href="{{route('auctionname.addform')}}"  style="float: right;">Add New</a>
                    </h5>    
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
                                    <th>Auction Name </th>
                                    <th>Auction Start</th>
                                    <th>Auction End </th>
                                    <th>Active</th>
                                    <th>Created_at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($auctions as $d)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->start_time_of_auction }}</td>
                                    <td>{{ $d->end_time_of_auction }}</td>
                                    <td>
                                        <a href="{{url('auctionname/active_auctionname/'.$d->id)}}" class="btn btn-default">
                                            
                                            <?php 
                                                if( $d->status ==1)
                                                {
                                                ?>
                                                <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80)"></div>
                                                <?php 
                                                }
                                                else 
                                                {
                                                ?>
                                                <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff"></div>
                                                <?php 
                                                }
                                            ?>
                                        </a>
                                    </td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>
                                        <a href="{{url('auctionname/edit/'.$d->id)}}" class="btn btn-success">Edit</a>

                                        <a href="{{url('auctionname/delete/'.$d->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a>
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
@endsection


