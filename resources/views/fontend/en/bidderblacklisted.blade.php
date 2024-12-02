@extends('layouts.fontend_master2')

@section('content')
 
 
 <!-- Swiper -->
 <!-- Breadcrumbs-->
 

<!--=============================  ======================================-->
<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
    
    <style>
      .headercolor{
    background: #FBE8D0;
    color: #776161;
    border-color: #FBE8D0;
}
    
      @media(max-width:767px)
      {
          .pmr{padding-right: 15px;}
      }
  </style>    
  
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row">  





        <div>
         <div style="min-height:100px;border:1px solid #ccc;padding:10px;">  
            
            <div id="contents-wrapper">
                <?php 
                //echo $auction_date;exit;
                ?>
                <h4>Black-Listed Member</h4>
                <br>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <thead  class="thead-dark">
                            <tr class="table-secondary">
                                <th class="headercolor" style="width:30%">Name</th>
                                <th class="headercolor" style="width:20%">Company</th>
                                <th class="headercolor" style="width:20%">Country</th>
                                <th class="headercolor" style="width:20%">Reason</th>
                            </tr>
                        </thead>
                    </thead>

                 <tbody>
                    @foreach($bidderdata as $b)   
                   <tr>
                    <td>{{$b->name}}</td>
                    <td>{{$b->company_name}}</td>
                    <td>{{$b->country}}</td>
                    <td style=" max-width: 250px;overflow-x: hidden;">{{$b->reasonofblacklist}}</td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
                
            </div>
     
         </div>
        </div>
       </div>
      
      </div>
      </section>
      
      
      </section>
  </div>
    
    
  </div>
</section>





  @endsection