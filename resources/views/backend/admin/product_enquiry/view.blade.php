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
                                    <li class="breadcrumb-item active" aria-current="page">Product Inquiry List</li>
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
                    Product Inquiry List
                    
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Equiry Product</th>
                                    <th>Customer Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($customer_enquiry as $b)
                                <tr>
                                    <td>{{ $customer_enquiry->firstitem()+$loop->index }}</td>
                                    <td>{{ $b->product->title}}</td>
                                    <td>{{ $b->name}}</td>
                                    <td>{{ $b->companyname}}</td>
                                    <td>{{ $b->email }}</td>
                                    <td>{{ $b->phone }}</td>
                                    <td>{{ $b->created_at }}</td>
                                    <td>
                                        <a href="{{url('product_enquiry/view_details/'.$b->id)}}" class="btn btn-success">View</a>
                                        <a href="{{url('product_enquiry/delete/'.$b->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $customer_enquiry->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>





@endsection


