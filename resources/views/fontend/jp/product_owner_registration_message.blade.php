@extends('layouts.fontend_master2')

@section('content')
 <!-- Swiper -->
 <!-- Breadcrumbs-->

<!--=============================  ======================================-->
<style>
    .messagearea{
            min-height: 300px;
            width: 100%;
        }
    @media(max-width:767px)
    {
        .messagearea{
            min-height: 300px;
            width: 100%;
        }
    }
</style>

<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
        <div class="container">
            <div class="row">
                <div  style="width: 95%;">
                    
                    <div class="card">
                        <div class="card-body messagearea">
                            
                            <h4 style="text-align: center;">Thank you for your registration. <br><br>Please wait, we will contact you soon</h4>
                            
        
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