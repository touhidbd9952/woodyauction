@extends('layouts.admin_master')

@section('content')

<style>
    .bootstrap-datetimepicker-widget{min-width: 284px !important;}
    .requireddata{color: rgb(253, 1, 1);}
    .fa-clock::before {content: "\f017";text-align: center;position: relative;left: 130px;}
</style> 
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Name</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Auction Name Add Form</li>
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
        <div class="col-md-6" style="min-height: 650px;">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Auction Name Add Form
                        <a href="{{route('auctionname.view')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                               
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                                </div>
                    @endif


                    <form action="{{route('auctionname.store')}}"  method="POST"  class="form-horizontal">

                        @csrf

                    <div class="card-body">
                        

                        <div class="form-group row">
                            <label for="title"
                                class="col-sm-3 text-end control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="text-danger"> {{$message}}  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction Start:<span class="requireddata">*</span></label>
                              <div class="col-sm-9 dateinputgroup date" id="datetimepicker1" data-target-input="nearest">
                                  <input type="text" name="start_time_of_action" value="{{old('start_time_of_action')}}"  class="form-control datetimepicker-input" data-target="#datetimepicker1" required>
                                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="startdate" class="col-sm-3 text-end control-label col-form-label">Auction End:<span class="requireddata">*</span></label>
                              <div class="col-sm-9 dateinputgroup date" id="datetimepicker2" data-target-input="nearest">
                                  <input type="text" name="end_time_of_action" value="{{old('end_time_of_action')}}" class="form-control datetimepicker-input" data-target="#datetimepicker2" required>
                                  <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>

                        
                        
                       
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div style="max-height: 400px;overflow-y: auto">
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


