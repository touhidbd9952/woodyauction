@extends('layouts.member_admin_master')

@section('content')

<style>
    .red{color: red;padding-left:10px;}
</style>    
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Conditional Report</li>
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
                    Product Conditional Report
                    <a href="javascript:" onclick="history.back(); return false;" style="float: right;margin:0 15px;">Back</a>
                </div>

                <div class="card-body">
                    
                    <?php 
                    if($conditional_report !="")
                    {
                    ?>
                    <iframe
                        src="{{url($conditional_report)}}#toolbar=0&navpanes=0&scrollbar=0"
                        frameBorder="0"
                        scrolling="auto"
                        height="100%"
                        width="100%"
                    style="min-height: 600px;"></iframe>
                    <?php 
                    }
                    ?>    
                
                </div>
            </div>

        </div>
    </div>
</div>





@endsection


