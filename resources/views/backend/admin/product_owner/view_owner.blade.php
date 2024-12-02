@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product Woner</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Woner List </li>
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
                        Woner List
                        <a href="{{route('category.add_form')}}"  style="float: right;">Add New</a>
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
                                    <th>Company </th>
                                    {{-- <th>Company (JP)</th> --}}
                                    <th>Owner Name </th>
                                    {{-- <th>Owner Name (JP)</th> --}}
                                    <th>Person Incharge </th>
                                    {{-- <th>Person Incharge (JP)</th> --}}
                                    <th>Email </th>
                                    <th>Status</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=1;
                                ?>
                            @foreach($woners as $d)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    
                                    {{-- <td style="min-width: 200px;">{{ $d->company_name_en }}</td> --}}
                                    <td style="min-width: 150px;">{{ $d->company_name_jp }}</td>
                                    {{-- <td style="min-width: 200px;">{{ $d->name_en }}</td> --}}
                                    <td style="min-width: 150px;">{{ $d->name_jp }}</td>
                                    {{-- <td style="min-width: 200px;">{{ $d->person_incharge_en }}</td> --}}
                                    <td style="min-width: 150px;">{{ $d->person_incharge_jp }}</td>
                                    <td style="min-width: 150px;">{{ $d->email1 }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td style="min-width: 300px;">
                                        <a href="{{url('owner/edit/'.$d->id)}}" class="btn btn-success">View</a>
                                        {{-- <a href="{{url('owner/edit_credential/'.$d->id)}}" class="btn btn-success">Edit Credential</a>
                                        <a href="{{url('owner/delete/'.$d->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a> --}}

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


