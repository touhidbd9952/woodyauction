@extends('layouts.admin_master')

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
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Admin List</li>
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
                    Admin List
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
                                    <th>name</th>
                                    <th>email</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $b)
                                <tr>
                                    <td>{{ $users->firstitem()+$loop->index }}</td>
                                    <td>{{ $b->name}}</td>
                                    <td>{{ $b->email}}</td>
                                    <td>{{ $b->publish_status }}</td>
                                    <td>{{ $b->created_at }}</td>
                                    <td>
                                        <?php 
                                            if($b->role_id !=3)
                                            {
                                        ?>
                                        
                                        <a href="{{url('admin/edit/'.$b->id)}}" class="btn btn-success">Edit Password</a>
                                        
                                        <a href="{{url('admin/delete/'.$b->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a>
                                        
                                        <?php 
                                            }
                                            else 
                                            { 
                                        ?>
                                        <a href="{{url('admin/edit/'.$b->id)}}" class="btn btn-success">Edit Password</a>
                                        <a href="{{url('admin/edit_token/'.$b->id)}}" class="btn btn-success">Edit Token</a>
                                        
                                        <?php    
                                            }
                                        ?>
                                    </td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                            
                        </table>

                        {{ $users->links() }}

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>





@endsection


