@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Winner Bidder</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Winner Bidder List </li>
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
                        Auction Winner Bidder List (Search Date: {{$enddate}})
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif
                    @if(session('esuccess'))
                               
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Error!</strong> {{ session('esuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Bidder_ID </th>
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="min-width: 400px;">Generate Invoice|Mail-sent|Print-invoice|Fax-invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $sl=0;
                            ?>  
                            @foreach($auctionmaxbidderlist as $d)
                            <?php 
                            $sl++;
                            ?>
                                <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $d->usercodeno }}</td>
                                    <td>{{ $d->company_name !=""?$d->company_name:$d->name }}</td>
                                    <td>{{ $d->email1 }}</td>
                                    <td>{{ $d->phone1 }}</td>
                                    <td>
                                        <a href="{{url('auction/bidder_winner_invoice/'.$sl.'/'.$d->id.'/'.$enddate)}}"  class="btn btn-success">Generate Invoice</a>
                                        <?php 
                                        $c=0;
                                        if(count($infoservicelist)>0)
                                        {
                                        ?>
                                            @foreach($infoservicelist as $info)
                                                <?php 
                                                if($info->bidder_id == $d->id)
                                                {
                                                    $c=1;
                                            ?>     
                                                <a href="{{url('infoservice/add_service/1/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                
                                                    <?php 
                                                        if( $info->mail_sent ==1)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80);color: #000;">M</div>
                                                        <?php 
                                                        }
                                                        else if( $info->mail_sent ==0)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">M</div>
                                                        <?php 
                                                        }
                                                    ?>
                                                </a>
                                                <a href="{{url('infoservice/add_service/2/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                
                                                    <?php 
                                                        if( $info->printout ==1)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80);color: #000;">P</div>
                                                        <?php 
                                                        }
                                                        else if( $info->printout ==0)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">P</div>
                                                        <?php 
                                                        }
                                                    ?>
                                                </a>
                                                <a href="{{url('infoservice/add_service/3/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                
                                                    <?php 
                                                        if( $info->fax ==1)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80);color: #000;">F</div>
                                                        <?php 
                                                        }
                                                        else if( $info->fax ==0)
                                                        {
                                                        ?>
                                                        <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">F</div>
                                                        <?php 
                                                        }
                                                    ?>
                                                </a>
                                                <?php 
                                                }
                                                
                                                ?>
                                               
                                            @endforeach

                                            <?php 
                                                    if($c==0)
                                                    {
                                                ?>
                                                <a href="{{url('infoservice/add_owner_service/1/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" class="btn btn-default">
                                                    <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">M</div>
                                                </a>
                                                <a href="{{url('infoservice/add_owner_service/2/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" class="btn btn-default">
                                                    <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">P</div>
                                                </a>
                                                <a href="{{url('infoservice/add_owner_service/3/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" class="btn btn-default">
                                                    <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">F</div> 
                                                </a> 
                                                <?php 
                                                $c=0;
                                                    }
                                                ?>
                                        <?php 
                                        }
                                        else
                                        {
                                        ?>
                                            <a href="{{url('infoservice/add_service/1/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">M</div>
                                            </a>
                                            <a href="{{url('infoservice/add_service/2/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">P</div>
                                            </a>
                                            <a href="{{url('infoservice/add_service/3/'.$auction_id.'/'.$d->id.'/'.$enddate)}}" onclick="return confirm('Are you shure want to update this activity')" class="btn btn-default">
                                                <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff;color: #000;">F</div>
                                            </a>
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $auctionmaxbidderlist->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection


