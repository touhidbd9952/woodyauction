@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product Inquiry</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Inquiry Details</li>
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

<style>
    .inquery table tr td{padding: 15px 0px;vertical-align: top;}
    .pdl{padding-left: 15px;}
    .pdr{padding-right: 15px;}
    .w150{width: 150px;}
    .w50{width: 50px;}
</style>    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Product Inquiry Details
                        <a href="{{route('product.enquiry')}}"  style="float: right;">View</a>
                    </h5>    
                </div>

                <div class="card-body inquery">
                    
                    <table>
                        <tr>
                            <td class="pdr w150">Product Category</td> 
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->product->category->title}}</td>
                        </tr> 
                        <tr>
                            <td class="pdr w150">Product Name</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->product->title}}</td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Product Image</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl"><img src="{{asset($customer_enquiry->product->thumbnail_image)}}" width="300px;" height="auto"></td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Customer Name</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->name}}</td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Customer Company</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->companyname}}</td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Customer Email</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->email}}</td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Customer Phone</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->phone}}</td>
                        </tr>
                        <tr>
                            <td class="pdr w150">Customer Message</td>
                            <td class="pdr w50">:</td>
                            <td class="pdl">{{$customer_enquiry->message}}</td>
                        </tr>   
                    </table>    

                </div>
            </div>

        </div>
    </div>
</div>


  
@endsection


