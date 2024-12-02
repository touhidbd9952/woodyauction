@extends('layouts.admin_master')

@section('content')
 




   <style>
       .table tr th, .table tr td,.borderdiv {border: black solid !important;}
       .table td, .table th {padding: 0.2rem !important;}
       hr {
            margin: 0 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 1;
            }
        .footer{display: none;} 
        @media print {
        #printDiv{color:#000 !important;}    
        .no-print{
                display : none !important;
                }
                #no-print-eye{display : none !important;}
                /* #printDiv{margin-left:-250px;margin-top:80px !important;margin-bootom:0px !important;width:700px;} */
                #printDiv{margin-left:-200px;margin-top:80px !important;margin-bootom:0px !important;width:920px;} 
                table{border:1 pax solid #ccc;}
                table tr{height: 25px;}
                table tr th,table tr td{height: 25px;font-size:12px;padding:5px !important;color:#000 !important;}
                /* .w60{width: 50%;}
                .w33{width: 32%;}
                .w0{width: 0%;float: none;} */
                p,p span{font-size: 13px !important;margin-bottom: 10px !important;}
                #singing{margin-top: 50px !important;}
                @page {size: auto;   margin: 0mm auto;}
                h1{font-size: 42px !important;}
                h3{font-size: 18px !important;}

       }   
   </style>    
   <script>
       function printInvoice()
        {
            printDiv = "#printDiv"; // id of the div you want to print
            $("*").addClass("no-print");
            $(printDiv+" *").removeClass("no-print");
            $(printDiv).removeClass("no-print");
            var gtotal = document.getElementById('gtotal').value;
            const numberFormatter = Intl.NumberFormat('en-US');
            
            gtotal = numberFormatter.format(gtotal);
            document.getElementById('grandtotal').innerHTML = '¥'+gtotal;
            parent =  $(printDiv).parent();
            while($(parent).length)
            {
                $(parent).removeClass("no-print");
                parent =  $(parent).parent();
            }
            window.print();

        }
   </script>    

<?php 
$grandTotalPrice = 0;
?>
<section  class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
          
        <input type="button" onclick="printInvoice();" value="Print">
        <a href="{{url('bid/bid_winner_mail/'.$bidder_id.'/'.$enddate)}}"  class="btn btn-success" style="float: right;">Send Winner Mail To Bidder</a>
        
        <?php 
        if(session('mail_success'))
        {
        ?>
        <span style="display: block;color:rgb(4, 249, 66);font-size: 22px;text-align: center;">Mail Sent..</span>
        <?php 
        }
        ?>    

      <div class="container" id="printDiv" style="margin-top: 100px;margin-bottom: 100px;" >
        
        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-3 w60" style="display:block;"> 
                {{$auctionmaxbidderinfo->company_name}} <br>
                {{$auctionmaxbidderinfo->name}}様  <br>
                落札社 ID. {{$auctionmaxbidderinfo->usercodeno}}<br>
                FAX No. {{$auctionmaxbidderinfo->fax}}
            </div>
            <div  class="col-md-4" style="display:block;text-align:center;padding-left:0px;"> 
                (WOODY AUCTION  <?php  echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日 終了分';?>)  <br><br><br>
                <h1 style="margin-bottom: 0px;">
                    請<span style="padding: 0 80px">求</span>書
                    <center>
                        <div class="borderdiv" style="width: 280px;height: 8px;border-left-color:#fff !important;border-right-color:#fff !important;">&nbsp;</div>
                        
                    </center> 
                </h1>

            </div>
            <div  class="col-md-5 w60" style="display:block;text-align:right;"> 
                <div style="float: right;text-align: left;">
                    <span style="font-size: 20px;font-weight:bold;">有限会社ウッディー </span>  <br>
                    〒146-0094 東京都大田区東矢口1-4-4 <br>
                    成田ヤード: 〒286-0212 &nbsp; 千葉県富里市十倉40 <br>
                    TEL:03-5700-4622 &nbsp;&nbsp;FAX:03-5700-4625  <br>
                    Email:info@woodyltd.com  <br>
                    </div>
            </div>
            
        </div>
        

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-4 w33" style="display:block;"> 
                
                下記の通りご請求申し上げます
                
                <div class="borderdiv" style="background:#ccc;display: block;width: 250px;height: 25.4667px;text-align: center;">
                    ご請求金額
                </div>
            
                <div class="borderdiv" style="display: block;text-align: center;height: 37px;width: 250px;border-top-color:#fff !important;">
                    <span id="grandtotal" style="font-size: 24px;font-weight: bold;"></span>
                </div>
            </div>
            <div  class="col-md-8 w33" style="display:block;"> 
                <div style="display: block;text-align: right;width:150px;float: right;padding-top: 50px;">
                <?php echo  $auctionYear.'年'.$auctionMonth.'月'. $auctionDay.'日';?>
                </div>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-4 w33">&nbsp;</div>
            <div  class="col-md-4 w33">&nbsp;</div>
            <div  class="col-md-4 w33"> 
                <div style="display: block;text-align: right;width:300px;float: right;">
                    請求書番号:&nbsp;{{$invoiceno}}
                </div>
            </div>
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block"> 
                
                <div class="table-responsive">
                    <table border="1" id="example2" class="table  ">
                        <thead>
                            <tr >
                                <th style="text-align: center !important">LOT No.</th>
                                <th style="text-align: center !important">MODEL</th>
                                <th style="text-align: center !important">SERIAL</th>
                                <th style="text-align: center !important">金額</th>
                                <th style="text-align: center !important">落札料</th>
                                <th style="text-align: center !important">出庫料</th>
                                <th style="text-align: center !important">搬出作業料</th>
                                <th style="text-align: center !important">その他費用</th>
                                <th style="text-align: center">受渡場所</th>
                                <th style="width: 100px;text-align: center !important">備考</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                $total_auction_max_bid_amount = 0;    
                                $total_auction_charge = 0;
                                $total_yard_charge = 0;
                                $total_extra_charge = 0;
                                $total_releasing_charge = 0;  
                                $end_date ="";

                                $count = 0;
                            ?>
                        @foreach($products as $p)
                           <?php    
                            //total before tax calculation
                                $total_auction_max_bid_amount += $p->auction_max_bid_amount !=""?(int)$p->auction_max_bid_amount:0;
                                $total_auction_charge += $p->auction_charge !=""?(int)$p->auction_charge:0;
                                $total_yard_charge += $p->yard_charge !=""?(int)$p->yard_charge:0;
                                $total_extra_charge += $p->extra_charge !=""?(int)$p->extra_charge:0;
                                $total_releasing_charge += $p->releasing_charge !=""?(int)$p->releasing_charge:0 ;
                                $deliveryplace = "";
                                foreach($deliveryplaces as $d)
                                {
                                    if($d->id == $p->delivery_place_id)
                                    { 
                                        $deliveryplace = $d->name_jp !=""? $d->name_jp:$d->name_en;
                                    }
                                }
                                
                           ?>
                           <!----Product data show ---->
                            <tr <?php if($count == (count($products)-1)){?> style="border-bottom: 3px solid #000; width: 100%;"<?php }?> >
                                <td>{{ $p->product_no }}</td>
                                <td>
                                    {{ $p->model_no}} 
                                    <a href="{{url('product/details_view_for_customerinvoice/'.$p->id.'/'.$bidder_id.'/'.$enddate)}}" id="no-print-eye" target="_blank" style="float: right;">
                                        <i id="no-print-eye" class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>{{ $p->serial_no !=""?$p->serial_no:"" }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->auction_max_bid_amount) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->auction_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->releasing_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->yard_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->extra_charge) }}</td>
                                <td style="text-align: center;">{{ $deliveryplace}}</td>
                                <td></td>
                            </tr>
                            <?php $count++;?>
                        @endforeach

                        {{-- blank 5 row --}}
                        <?php 
                        if(count($products)<5)
                        {
                            $loopcount =4;
                            if(count($products)==1){$loopcount =4;}
                            if(count($products)==2){$loopcount =3;}
                            if(count($products)==3){$loopcount =2;}
                            if(count($products)==4){$loopcount =1;}
                            for($i=0;$i<$loopcount;$i++)
                            {
                        ?>
                        <tr style="border-bottom: 1px solid #000; width: 100%;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php 
                            }
                        }
                        ?>


                        <!----Total before tax ---->
                        <tr style="border-bottom: 1px solid #000; width: 100%;">
                            <td colspan="2" style="border-left-color: #fff !important;border-bottom-color: #fff !important;font-size: 12px !important;">
                                <b>【支払口座】</b>
                            </td>
                            <td style="text-align: right;">小計</td>
                            
                            <td style="text-align: right">¥{{number_format($total_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($total_auction_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_releasing_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_yard_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_extra_charge)}}</td>
                            
                            <td colspan="2" style="border-right-color: #fff !important;border-bottom-color: #fff !important;"></td>
                            
                        </tr>

                        <?php 
                                // tax 10% calculation
                                $total_auction_max_bid_amount_tax = ($total_auction_max_bid_amount*10)/100;
                                $total_auction_charge_tax = ($total_auction_charge*10)/100;
                                $total_yard_charge_tax = ($total_yard_charge*10)/100;
                                $total_extra_charge_tax = ($total_extra_charge*10)/100;
                                $total_releasing_charge_tax = ($total_releasing_charge*10)/100;
                        ?>
                        <!----tax amount---->
                        <tr style="border-bottom: 3px solid #000; width: 100%;">
                            <td colspan="2" style="border-left-color: #fff !important;border-bottom-color: #fff !important;font-size: 12px !important;">
                                三菱UFJ銀行蒲田支店
                            </td>
                            <td style="text-align: right;">消費税計</td>
                            
                            <td style="text-align: right">¥{{number_format($total_auction_max_bid_amount_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_auction_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_releasing_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_yard_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_extra_charge_tax)}}</td>
                            
                            <td colspan="2" style="border-right-color: #fff !important;border-bottom-color: #fff !important;"></td>
                            
                        </tr>
                        <!----Total after tax---->
                        <?php 
                                //total after tax calculation
                                $grandtotal_auction_max_bid_amount = $total_auction_max_bid_amount + $total_auction_max_bid_amount_tax;
                                $grandtotal_auction_charge = $total_auction_charge + $total_auction_charge_tax;
                                $grandtotal_yard_charge = $total_yard_charge + $total_yard_charge_tax;
                                $grandtotal_extra_charge = $total_extra_charge + $total_extra_charge_tax;
                                $grandtotal_releasing_charge = $total_releasing_charge + $total_releasing_charge_tax;

                                $grandTotalPrice = $grandtotal_auction_max_bid_amount + $grandtotal_auction_charge + $grandtotal_yard_charge + $grandtotal_extra_charge + $grandtotal_releasing_charge; 
                           
                           ?>
                        <tr>
                            <td colspan="2" style="border-left-color: #fff !important;border-bottom-color: #fff !important;font-size: 12px !important;">
                                普通2365000
                            </td>
                            <td style="text-align: right;">合計</td>
                            
                            <td style="text-align: right">¥{{number_format($grandtotal_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_auction_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_releasing_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_yard_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_extra_charge)}}</td>
                            
                            <td colspan="2" style="border-right-color: #fff !important;border-bottom-color: #fff !important;"></td>
                            
                        </tr>
                            
                        </tbody>
                        
                    </table>
                    
                    <input type="hidden" id="gtotal" value="{{$grandTotalPrice}}" onchange="setValue({{$grandTotalPrice}})">

                    <p>
                        <div style="display: inline-block;width:280px;height: 60px;vertical-align: text-top;float: left;font-size: 12px !important;margin-top: -20px;padding-left: 7px;">
                            有限会社ウッディー <br>
                            振込手数料は貴社にてご負担ください。 
                        </div> 
                        <div style="display: inline-block;width:300px;height: 60px;">
                        <?php 
                        $mod_date = strtotime($enddate."+ 7 days");
                        $payment_year = date("Y",$mod_date);
                        $payment_month = date("m",$mod_date);
                        $payment_day = date("d",$mod_date);
                        $paymentdate = $payment_year.'年'.$payment_month.'月'.$payment_day.'日';
                        
                        $mod_date = strtotime($enddate."+ 14 days");
                        $delivery_year = date("Y",$mod_date);
                        $delivery_month = date("m",$mod_date);
                        $delivery_day = date("d",$mod_date);
                        $deliverydate = $delivery_year.'年'.$delivery_month.'月'.$delivery_day.'日';
                        ?>
                            <table style="width: 100%;">
                                <tr>
                                    <th style="text-align: center;width: 150px;" class="borderdiv">支払期日</th>
                                    <th style="text-align: center;width: 150px;" class="borderdiv">搬出期限</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center" class="borderdiv">{{$paymentdate}}</td>
                                    <td style="text-align: center" class="borderdiv">{{$deliverydate}}</td>
                                </tr>
                            </table>
                        </div> 
                    </p>
                    
                    
                    
                    <p style="font-size: 12px !important;">
                        ★受取場所からの機械引取りについて   <br>
                        ※搬出時には必ず前日までに搬出日、回送業者を弊社にご連絡ください。当日連絡は搬出不可もしくは、10,000円の【追加料金】がかかります。<br>
                        ※未搬入の場合、入庫状況を弊社までお問い合わせください。遠隔地の場合、1～２週間お時間を頂くことがあります。<br>
                        ※オークション終了後14日以内の引取を厳守してください。オークション終了後１５日目から【保管料】がかかります。<br> 
                        <span style="display: block;padding-left: 620px;font-size: 14px !important;">☆次回もご参加お待ちしております☆</span>
                    </p>
                   
                </div>


            </div>

            

        </div>
      </div>
      </section>
      </section>
  </div>
  </div>
</section>

<script>
    function setValue(gvalue)
    {
       // alert(gvalue);
        //document.getElementById('totalinvoicecharge').innerHTML = gvalue;
    }
</script> 
<script>
    //document.getElementById('gtotal').value;
    
    var myObject = new Vue({
      el: '#app',
      data: {totalinvoicecharge: '123'}
    })
    </script>   





  @endsection