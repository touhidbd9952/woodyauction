@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php 
            $loginuser = Illuminate\Support\Facades\Auth::user()->name;
            ?>

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard &nbsp;: &nbsp;{{$loginuser}}</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/member_dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        

        <?php 
        $categories = App\Models\Category::latest()->take(10)->get();  
        $products = App\Models\Product::latest()->with('category')->take(10)->get();  
        ?>

        <!----======= last 10  Categories  ==========---->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Categories <span style="float: right;font-size:10px;">last 10</span></h3>
                  
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>created_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $c)
                          
                    <tr>
                      <td>
                        <img src="{{asset($c->image)}}" alt="Product 1" class="img-circle img-size-32 mr-2" style="height: 50px; width:auto;">
                      </td>
                      <td>{{$c->title}}</td>
                      <td>
                        {{$c->publish_status}}
                      </td>
                      <td>
                        {{$c->created_at}}
                      </td>
                    </tr>

                    @endforeach
                    
                    </tbody>
                  </table>
                </div>
              </div>

        </div>

        <!----======= last 10  Products  ==========---->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Products <span style="float: right;font-size:10px;">last 10</span></h3>
                  
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Category</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>created_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $p)
                          
                    <tr>
                      <td>
                        <img src="{{asset($p->thumbnail_image)}}" alt="Product 1" class="img-circle img-size-32 mr-2" style="height: 50px; width:auto;">
                        {{$p->category->title}}
                      </td>
                      <td>{{$p->title}}</td>
                      <td>
                        {{$p->publish_status}}
                      </td>
                      <td>
                        {{$p->created_at}}
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
@endsection
