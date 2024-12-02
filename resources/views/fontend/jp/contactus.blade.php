@extends('layouts.fontend_master2')

@section('content')


<!-- Breadcrumbs-->
 

<?php 
$base_url = Session::get('base_url');
?>
<section class="breadcrumbs-custom bg-image" style="background-image: url({{$base_url}}/fontend/images/bg-image-6.jpg);">
    <div class="shell">
      <h2 class="breadcrumbs-custom__title">Contacts</h2>
      <ul class="breadcrumbs-custom__path">
        <li><a href="index.html">Home</a></li>
        <li class="active">Contacts</li>
      </ul>
    </div>
  </section>

  <!-- Get in Touch-->
  <section class="section section-lg bg-white">
    <div class="shell">
      <div class="layout-bordered">
        <div class="layout-bordered__main text-center">
          <div class="layout-bordered__main-inner">
            <h3>Get in Touch</h3>
            <p>We are available 24/7 by fax, e-mail or by phone. You can also use our quick contact form to ask a question about our services and projects.</p>
            <!-- RD Mailform-->
            <form action="{{route('general_contactus')}}" method="POST" onsubmit="return checkform()">

              @csrf

              

              <div class="range range-sm-bottom"> 
                <div class="form-group cell-sm-6"> 
                  <label style="width: 100%;text-align: left;">Name <span id="ename" style="color: red"></span></label>
                  <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control form-control-lg" autocomplete="off"     placeholder="Enter name" style="height: 54px;">
                </div>

                <div class="form-group cell-sm-6">
                  <label style="width: 100%;text-align: left;">Phone <span id="ephone" style="color: red"></span></label>
                  <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-control form-control-lg"  placeholder="Enter phone" style="height: 54px;" autocomplete="off">
                </div>

                <div class="form-group cell-xs-12">
                  <label style="width: 100%;text-align: left;">Message <span id="emessage" style="color: red"></span></label>
                  <textarea   name="message" id="message"  class="form-control form-control-lg"    placeholder="Enter message" style="min-height: 100px;" autocomplete="off">{{old('message')}}</textarea>
                </div>

                <div class="form-group cell-sm-6">
                  <label style="width: 100%;text-align: left;">Email address <span id="eemail" style="color: red"></span></label>
                  <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control form-control-lg"    placeholder="Enter email" style="height: 54px;" autocomplete="off">
                </div>

                <!--------------->

                
                <div class="form-group cell-sm-6"> 
                  <label style="width: 100%;text-align: left;">Capcha <span id="ecaptcha" style="color: red"></span></label>
                  <?php 
                    $a = rand(1,9);
                    $b = rand(1,9);
                    $c = $a+$b;
                  ?>
                  <input type="hidden"  name="captcha_result" id="captcha_result" value="<?php echo $c;?>">
                  <div style="height: 54px;line-height: 54px;background:#f4f3f3">
                  <div style="float: left;width:30;font-size: 18px;">&nbsp;<?php echo $a;?>&nbsp;</div>
                  <div style="float: left;width:30;font-size: 18px;">&nbsp;+&nbsp;</div>
                  <div style="float: left;width:30;font-size: 18px;">&nbsp;<?php echo $b;?>&nbsp;</div>
                  <div style="float: left;width:30;font-size: 18px;">&nbsp;=&nbsp;</div>
                  <div style="float: left;width:30;font-size: 18px;">&nbsp;
                    <select  name="captcha" id="captcha" style="width: 80px;" autocomplete="off"> 
                      <option value="0">???</option>
                      <?php
                      for($i=1;$i<100;$i++)
                      { 
                      ?>
                      <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php 
                      }
                      ?>
                    </select>  
                  </div>
                  </div>
                  
                  
                </div>
                

                <div class="cell-sm-6">
                  <button class="button button-block button-primary" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="layout-bordered__aside">
          <div class="layout-bordered__aside-item">
            <p class="heading-8">Get social </p>
            <ul class="list-inline-xs">
              <li><a class="icon icon-sm icon-default fa fa-facebook" href="#"></a></li>
              <li><a class="icon icon-sm icon-default fa fa-twitter" href="#"></a></li>
              <li><a class="icon icon-sm icon-default fa fa-google" href="#"></a></li>
              <li><a class="icon icon-sm icon-default fa fa-youtube" href="#"></a></li>
            </ul>
          </div>
          <div class="layout-bordered__aside-item">
            <p class="heading-8">Phone</p>
            <div class="unit unit-horizontal unit-spacing-xxs">
              <div class="unit__left"><span class="icon icon-sm icon-primary material-icons-local_phone"></span></div>
              <div class="unit__body"><a href="callto:#">+81-(0)3-5700-4622</a></div>
            </div>
          </div>
          <div class="layout-bordered__aside-item">
            <p class="heading-8">E-mail</p>
            <div class="unit unit-horizontal unit-spacing-xxs">
              <div class="unit__left"><span class="icon icon-sm icon-primary mdi mdi-email-outline"></span></div>
              <div class="unit__body"><a href="mailto:#">info@woodyltd.com</a></div>
            </div>
          </div>
          <div class="layout-bordered__aside-item">
            <p class="heading-8">Address</p>
            <div class="unit unit-horizontal unit-spacing-xxs">
              <div class="unit__left"><span class="icon icon-sm icon-primary material-icons-location_on"></span></div>
              <div class="unit__body">
                <a href="#">Tokyo Office: 1-4-4 Higashi Yaguchi Ota-Ku Tokyo, Japan 146-0094</a> <br><br>
                <a href="#">Narita Factory: 185-943 Tokura <br> Tomisato-Shi, Chiba 286-0212</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- google map-start -->
  <div class="map-section" id="googlemap">
    <style>
      #map {
      height: 400px;
      width: 100%;
      }
    </style>		
      
                <iframe id="map"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1022.1498453863778!2d140.3328498292304!3d35.689316087997106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDQxJzIxLjUiTiAxNDDCsDIwJzAwLjIiRQ!5e1!3m2!1sen!2sjp!4v1632961074836!5m2!1sen!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    
  </div>
<!-- google map-ends -->

  <script>
    function checkform()
    {
      var name = document.getElementById('name').value;
      var phone = document.getElementById('phone').value; 
      var message = document.getElementById('message').value; 
      var email = document.getElementById('email').value; 
      var captcha = document.getElementById('captcha').value;   
      var captcha_result = document.getElementById('captcha_result').value;  
      
    
      document.getElementById('ename').innerHTML ="";
      document.getElementById('ephone').innerHTML ="";
      document.getElementById('emessage').innerHTML ="";
      document.getElementById('eemail').innerHTML ="";
      document.getElementById('ecaptcha').innerHTML ="";
      //alert(name);
      var err=0;
      
      if(name == "")
      {
        err++;
        document.getElementById('ename').innerHTML ="required";
      }
      else if(name.length > 255)
      {
        err++;
        document.getElementById('ename').innerHTML ="length exceed";
      }
      //phone
      if(phone == "")
      {
        err++;
        document.getElementById('ephone').innerHTML ="required";
      }
      else if(phone.length > 255)
      {
        err++;
        document.getElementById('ephone').innerHTML ="length exceed";
      }
      //message
      if(message == "")
      {
        err++;
        document.getElementById('emessage').innerHTML ="required";
      }
      
      //email
      if(email == "")
      {
        err++;
        document.getElementById('eemail').innerHTML ="required";
      }
      else if(email.length > 255)
      {
        err++;
        document.getElementById('eemail').innerHTML ="length exceed";
      }

      //captcha 
      if(captcha == "" || captcha == "0")
      {
        err++;
        document.getElementById('ecaptcha').innerHTML ="required";
      }
      else if(captcha != captcha_result)
      {
        err++;
        document.getElementById('ecaptcha').innerHTML ="invalid";
      }
    
    
      if(err==0)
      {
        return true;
      }
      return false;
    }
    </script> 


  @endsection
