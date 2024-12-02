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
                    Invoice Search 
                    <a href="{{ route('auction.view_auction_history') }}" style="float: right;">Auction History</a>
                </div>

                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif
                    
                    <form action="{{route('auction.invoice_search')}}" method="post">
                        @csrf

                        
                        <table>
                            <tr>
                                <td id="datepicker2" data-target-input="nearest">
                                  Invoice Type<br>
                                  <select name="invoicetype" id="invoicetype" autocomplete="off" class="form-control @error('invoicetype') is-invalid @enderror" >
                                    <option></option>
                                    <option value="WDY">WDY</option>
                                    <option value="O-WDY">O-WDY</option>
                                </select>
                                </td>
                                <td id="datepicker2" data-target-input="nearest">
                                    Invoice No<br>
                                      <input type="text" name="invoiceno"  class="form-control"  required>
                                      
                                  </td>
                                <td>
                                    <br>
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
        
</div>






@endsection


