@extends('layouts.fontend_master2')

@section('content')
 <!-- Swiper -->
 <!-- Breadcrumbs-->

<!--=============================  ======================================-->
<style>
    #myDIV {
      width: 100%;
      padding: 50px 0;
      text-align: center;
      background-color: lightblue;
      margin-top: 20px;
    }
    .section-div{margin-bottom: 15px;}
    .headertitle{display: block;text-align:center;font-weight:bold;font-size: 16px;color:#F5A641;background: #f4f3f3;}
    .menudiv{background: #F5A641;color:#f4f3f3;display:block;text-align:center;font-weight:bold;margin-bottom:5px;}
    .menudiv:hover, .menudiv:focus {background: #f3d3aa;color:#f4f3f3;text-decoration: none;outline: none;}
    .section-div p{margin-top: 10px;font-size:14px;}
    .section-div p, ul li, ol li{color: #000 !important;}
    .section-div p b{font-size: 16px;color: #000 !important;}
    p b{font-size: 16px;color: #000 !important;}
    p{color: #000 !important;}
    .section-div b{font-size: 16px;color: #000 !important;}
    .fa-circle{padding-right: 10px;color: #F5A641;}
    .txtl{text-align: left;}
    .fontsize-13{font-size:13px;}
    .datatable th, .datatable td{padding: 0 5px;color: #000;}
    .fbold{font-weight: bold;}
    #datadiv, #datadiv b{color:#000;}
    #datadiv h4{color:#F5A63F}
</style>
<script>
    function myFunction(myDIV) {
      var x = document.getElementById(""+myDIV);
      if (x.style.display === "none") 
      {
        x.style.display = "block";
      } 
      else 
      {
        x.style.display = "none";
      }
    }
</script>



<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row"> 
            
            <!---======== start =========---->
            <div id="datadiv" class="col-md-12" > 
                <h4>Information on FOB charge & Basic Washing</h4>
                <br>
                <b>Yokohama (Shipping & Inland Trucking)</b>
                <p>
                <table class="datatable" cellspacing="0" cellpadding="0" border="1">
                    <tbody><tr class="sb"> 
                    <th rowspan="8" class="fbold">Excavator</th>
                    <td rowspan="2" class="model fbold" style="vertical-align: middle;" width="115">Model</td>
                    <td colspan="2" class="fbold">FOB charge Yokohama</td>
                    <td rowspan="2" class="fbold" 　width="100" style="vertical-align: middle;">Washing Fee</td>
                    </tr>
                    
                    <tr class="sb"> 
                    <td width="100" class="fbold">From Yokohama</td>
                    <td width="100" class="fbold">From Narita</td>
                    </tr>
                    
                    <tr> 
                    <td class="txtl">Less than 5t class</td>
                    <td>50,000</td>
                    <td>85,000</td>
                    <td>45,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">5t up 10t class</td>
                    <td>60,000</td>
                    <td>90,000</td>
                    <td>55,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">10t up 20t class</td>
                    <td>70,000</td>
                    <td>105,000∼</td>
                    <td>70,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">20t up 30t class</td>
                    <td>80,000</td>
                    <td>135,000</td>
                    <td>85,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">30t up 40t class</td>
                    <td>90,000</td>
                    <td>150,000</td>
                    <td>115,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">40t or more class</td>
                    <td>110,000</td>
                    <td>165,000</td>
                    <td>ASK</td></tr>
                    
                    <tr class="sb"> 
                    <th rowspan="7">Wheel Loader</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">less than<br>WA100/910 class</span></td>
                    <td>50,000</td>
                    <td>85,000</td>
                    <td>50,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">WA100 / 910 class</span></td>
                    <td>60,000</td>
                    <td>110,000</td>
                    <td>75,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">WA200 / 920 class</span></td>
                    <td>70,000</td>
                    <td>125,000</td>
                    <td>85,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">WA300 / 930 class</span></td>
                    <td>80,000</td>
                    <td>135,000</td>
                    <td>ASK</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">WA400 / 950 class</span></td>
                    <td>80,000</td>
                    <td>135,000</td>
                    <td>ASK</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">WA500 / 980 class</span></td>
                    <td>90,000</td>
                    <td>ASK</td>
                    <td>ASK</td></tr>
                    
                    
                    <tr class="sb"> 
                    <th rowspan="7">Bulldozer</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td></tr>
                    
                    <tr> 
                    <td class="txtl">D20 / BD2 class</td>
                    <td>50,000</td>
                    <td>85,000</td>
                    <td>45,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">D30 / D3 &nbsp;&nbsp;class</td>
                    <td>60,000</td>
                    <td>95,000</td>
                    <td>50,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">D40 / D4H class</td>
                    <td>70,000</td>
                    <td>110,000</td>
                    <td>60,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">D50 / D5H class</td>
                    <td>80,000</td>
                    <td>120,000</td>
                    <td>70,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">D60 / D6H class</td>
                    <td>90,000</td>
                    <td>140,000</td>
                    <td>75,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">D80 / D7H class</td>
                    <td>ASK</td>
                    <td>ASK</td>
                    <td>ASK</td>
                    </tr>
            
                    <tr class="sb"> 
                    <th rowspan="5">Grader</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td></tr>
                    
                    <tr> 
                    <td class="txtl">GD405 / MG200</td>
                    <td>70,000</td>
                    <td>110,000</td>
                    <td>75,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">GD505 / MG300</td>
                    <td>80,000</td>
                    <td>125,000</td>
                    <td>85,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">GD605 / MG400</td>
                    <td>80,000</td>
                    <td>135,000</td>
                    <td>105,000</td></tr>
                    
                    <tr> 
                    <td class="txtl">GD705 / MG500</td>
                    <td>90,000</td>
                    <td>140,000</td>
                    <td>125,000</td></tr>
                    
                    <tr class="sb"> 
                    <th rowspan="6">Crane</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">NK70/TR70 class</span></td>
                    <td>65,000</td>
                    <td>100,000</td>
                    <td>80,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">TL200/TR200 class</span></td>
                    <td>90,000</td>
                    <td>150,000</td>
                    <td>110,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">TL250/TR250 class</span></td>
                    <td>90,000</td>
                    <td>160,000</td>
                    <td>130,000</td></tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">TL350/TR350 class</span></td>
                    <td>95,000</td>
                    <td>170,000</td>
                    <td>ASK</td>
                    </tr>
                    
                    <tr> 
                    <td class="txtl"><span class="fontsize-13">TL350/TR350 class</span></td>
                    <td>ASK</td>
                    <td>185,000</td>
                    <td>ASK</td>
                    </tr>
                    </tbody>
                </table>
                </p>
                <p>
                    Container shipping charge<br>
                    20 feet: JPY90,000<br>
                    40 feet: JPY110,000<br><br>

	                If the shipment is delayed for your own reason, extra fees such as trams and storage 
                    for taking to yard and moving to forwarder's yard will be changed.<br><br>

	                An extra washing fee will be charged in an extreme case and if inspection is required. 
                    If you request for washing, extra inland trucking fee to the washing yard is charged. Ask us for details. 
                    <br><br>
	                If disassembly of a machine is required, additional charges will be added. 
	                Ask our authorized person about ocean freight, marine insurance, container shipment, THC & disassembly charge, if needed. 
                </p>




                
            </div>
            <!---======== end =========---->

            

        </div>
      </div>
      </section>
      </section>
  </div>
  </div>
</section>





  @endsection