@extends('layouts.admin_master')

@section('content')

<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Auction Page Theme</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Theme Preference</li>
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
                

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" style="float:right;">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td style="width: 25px;padding-right:15px;">
                                    <a href="{{ url('auction/selecttheme/1') }}">
                                    
                                    <?php 
                                    if(isset($selectedtheme) && $selectedtheme == 1)
                                    {
                                    ?>
                                    <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80)"></div>
                                    <?php 
                                    }
                                    else 
                                    {
                                    ?>
                                    <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff"></div>
                                    <?php 
                                    }
                                    ?>
                                    </a>
                                </td>
                                <td>
                                    <img src="{{ asset('fontend') }}/images/theme2.jpg" style="width: 500px;height:auto;margin-bottom: 10px;">
                                </td>    
                            </tr> 
                            <tr>
                                <td style="width: 25px;padding-right:15px;">
                                    <a href="{{ url('auction/selecttheme/2') }}">
                                        <?php 
                                        if(isset($selectedtheme) && $selectedtheme == 2)
                                        {
                                        ?>
                                        <div style="width: 25px;height:25px;border:1px solid #rgb(1, 250, 80);border-radius: 5px; background: rgb(1, 250, 80)"></div>
                                        <?php 
                                        }
                                        else 
                                        {
                                        ?>
                                        <div style="width: 25px;height:25px;border:1px solid #ccc;border-radius: 5px; background: #fff"></div>
                                        <?php 
                                        }
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    
                                    <img src="{{ asset('fontend') }}/images/theme1.jpg" style="width: 500px;height:auto;">
                                    
                                </td>    
                            </tr>   
                        </table>    
                </div>
            </div>

        </div>
    </div>
</div>





@endsection


