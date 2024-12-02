@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction History</h4>
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
                    Auction List
                    <a href="{{ route('customer.searchpage') }}" style="float: right;">Customer Invoice</a>
                    <a href="{{ route('owner.searchpage') }}" style="float: right;margin-right:15px;">Owner Invoice</a>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="example" border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th style="min-width: 150px">Auction Name</th>
                                    <th style="min-width: 150px">Start Date</th>
                                    <th style="min-width: 150px">End Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $sl=1;
                            ?>
                            @foreach($auctions as $b)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $b->name}}</td>
                                    <td>{{ $b->start_time_of_auction}}</td>
                                    <td>{{ $b->end_time_of_auction}}</td>
                                    
                                    <td style="min-width: 500px;">
                                        <a href="{{url('auction/history/'.$b->id)}}" class="btn btn-success">Show Sold Data</a>
                                        <a href="{{url('auction/history_unsold/'.$b->id)}}" class="btn btn-success">Show Unsold Data</a>
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


