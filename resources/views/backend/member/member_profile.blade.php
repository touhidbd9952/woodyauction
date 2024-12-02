@extends('layouts.member_admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Account</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/member_dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                    Member Profile
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="zero_config" >
                            
                                @foreach($userdata as $b)
                                <tr>
                                    <th style="width: 150px;">Name</th> 
                                    <th style="text-align: center;">:</th> 
                                    <td>{{$b->name_en}}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->name_jp}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <th>Address</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->address}}</td>
                                </tr>
                                <tr>
                                    <th>Post code</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->postcode}}</td>
                                </tr>
                                <tr>
                                    <th>Company </th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->company_name_en}}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->company_name_jp}}</td>
                                </tr>
                                <tr>
                                    <th>Person_incharge</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->person_incharge_en}}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->person_incharge_jp}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->country}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Email</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->email1}}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->email2}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->phone1}}</td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->phone2}}</td>
                                </tr>
                                <tr>
                                    <th>Fax</th> 
                                    <th>:&nbsp;</th> 
                                    <td>{{$b->fax}}</td>
                                </tr>

                                
                                @endforeach
                            
                        </table>

                        

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>





@endsection


