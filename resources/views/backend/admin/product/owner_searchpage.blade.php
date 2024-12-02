@extends('layouts.admin_master')

@section('content')

<style>
    .dateinputgroup{position: relative;display: flex;flex-wrap: wrap;align-items: stretch;}
    .bootstrap-datetimepicker-widget{min-width: 284px !important;margin-top:65px;}
    .requireddata{color: rgb(253, 1, 1);}
    .fa-clock::before {content: "\f017";text-align: center;position: relative;left: 130px;}
</style>    
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Product Owner</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Owner Search Form</li>
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

<div class="container-fluid" style="min-height: 600px;">
    <div class="row">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header">
                    Owner Search Form
                    <a href="{{ route('auction.view_auction_history') }}" style="float: right;">Auction History</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('auction.get_sold_product_owner_list')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        
                        <table>
                            <tr>
                            
                                <td id="datepicker2" data-target-input="nearest">
                                  Auction End Date<br>
                                    <input type="text" name="end_time_of_action"  class="form-control datetimepicker-input" data-target="#datepicker2" required>
                                    <div class="input-group-append" data-target="#datepicker2" data-toggle="datetimepicker" style="float: left;">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </td>
                                <td>
                                  <button type="submit" class="btn btn-primary" style="float: right;margin-top: -5px;margin-left: 5px;">
                                      Search
                                  </button>
                              </td>
                            </tr>

                        </table>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div style="max-height: 300px;overflow-y: auto">
            <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Auction Name </th>
                        <th>End Date </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1;?>
                @foreach($auctionlist as $d)
                
                    <tr>
                        <td><?php echo $sl++?></td>
                        <td>{{ $d->name}}</td>
                        <td>{{ $d->end_time_of_auction}}</td>
                    </tr>
                @endforeach
                    
                </tbody>
                
            </table>
        </div>

    </div>
</div>






@endsection


