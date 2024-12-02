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
                        Auction Result Show
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
                                    <th>Result Publish</th>
                                    <th>Auction Name </th>
                                    <th>Auction Start</th>
                                    <th>Auction End </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($auctions as $d)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>
                                        <a href="{{url('auction/result_publish/'.$d->id)}}" class="btn btn-success">
                                            <input type="radio" {{$d->result_show ==1?'checked':''}}>
                                        </a>
                                    </td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->start_time_of_auction }}</td>
                                    <td>{{ $d->end_time_of_auction }}</td>
                                    
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


