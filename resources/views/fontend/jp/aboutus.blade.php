@extends('layouts.fontend_master2')

@section('content')


<!-- Breadcrumbs-->
<?php 
$base_url = Session::get('base_url');
?>
<section class="breadcrumbs-custom bg-image" style="background-image: url({{$base_url}}/fontend/images/bg-image-4.jpg)">
    <div class="shell">
      <h2 class="breadcrumbs-custom__title">About Us</h2>
      <ul class="breadcrumbs-custom__path">
        <li><a href="index.html">Home</a></li>
        <li class="active">About Us</li>
      </ul>
    </div>
  </section>

  <!-- Experience since 1999-->
  <section class="section section-md bg-white">
    <div class="shell">
      <div class="range range-70 range-sm-center range-lg-justify">
        <div class="cell-sm-10 cell-md-6 cell-lg-5">
          <h4>Experience since 1991</h4>
          <p>
            Woody Co., Ltd. was established December of 1991 with a capital of JPY 30,000,000. 
            Since then the company has been moving forward. Through the years, Woody Co., Ltd. 
            has established good business relationship based on trust and Prompt Services with 
            our Customers all over the globe.
          </p>
          <p>
            We specializes in heavy equipments. Our Qualified Engineers perfom the Inspection of the acquisitions that we make. 
            Inspection by a Certified Inspection Company is also performed as per customer request.
          </p>
          <h4>Our Mission</h4>
          <p>We provide the highest-quality end products to our customers, while striving to make them the leaders in their respective industries.</p>
        </div>


        <div class="cell-sm-10 cell-md-6">
          <div class="row grid-2">
            <div class="col-xs-6">
              <img src="{{ asset('fontend') }}/images/amphibious_excavator.jpg" alt="" style="width: 273px;height: 214px;"/>
              <img src="{{ asset('fontend') }}/images/manathee.jpg" alt="" style="width: 273px;height: 214px;"/>
            </div>
            <div class="col-xs-6">
              <img src="{{ asset('fontend') }}/images/container_house.jpg" alt="" style="width: 273px;height: 214px;"/>
              <img src="{{ asset('fontend') }}/images/pontoon_boat.jpg" alt="" style="width: 273px;height: 214px;"/>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  




  @endsection
