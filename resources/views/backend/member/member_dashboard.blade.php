@extends('layouts.member_admin_master')

@section('content')

<style>
  .page{background: #fbfafa;}
  
  @font-face {
    font-family: 'password';
    font-style: normal;
    font-weight: 400;
    src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
  }
  input.myclass{font-family: 'password';width: 250px;border: 1px solid #ccc;}
  </style>
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php 
            $loginuser = Session::get('loggermembername');
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
        $memberid = Session::get('loggermemberid') ; 
        $products = App\Models\Product::latest()->with('category','brand')->where('final_result','unsold')->where('woner_id',$memberid)->take(10)->get();  
        ?>

        

        <!----======= last 10  Products  ==========---->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">Products <span style="float: right;font-size:10px;">last 10</span></h3>
                  
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Model</th>
                      <th>Serial</th>
                      <th>Year</th>
                      <th>Hour</th>
                      <th>Status</th>
                      <th>created_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $p)
                          
                    <tr>
                      <td>
                        <img src="{{asset($p->thumbnail_image)}}" alt="Product 1" class="img-circle img-size-32 mr-2" style="height: 50px; width:66px;">
                      </td>
                      <td>{{$p->category->name_en}}</td>
                      <td>{{$p->brand->name_en}}</td>
                      <td>{{$p->model_no}}</td>
                      <td>{{$p->serial_no}}</td>
                      <td>{{$p->model_year}}</td>
                      <td>{{$p->used_hour}}</td>
                      <td>
                        {{$p->status}}
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
