@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Category</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category List </li>
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
                        Category List
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
                                    <th>Name </th>
                                    <th>Name JP</th>
                                    <th>Status</th>
                                    <th>Index</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $sl=1;
                            ?>
                            @foreach($categories as $cat)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $cat->name_en }}</td>
                                    <td>{{ $cat->name_jp }}</td>
                                    <td>{{ $cat->status }}</td>
                                    <td>{{ $cat->sl }}</td>
                                    <td>{{ $cat->created_at }}</td>
                                    <td>
                                        <a href="{{url('category/edit/'.$cat->id)}}" class="btn btn-success">Edit</a>
                                        <a href="{{url('category/delete/'.$cat->id)}}" class="btn btn-danger" onclick="return confirm('Are you shure want to delete')">Delete</a>

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


