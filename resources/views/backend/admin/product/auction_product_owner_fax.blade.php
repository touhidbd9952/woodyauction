@extends('layouts.admin_master')

@section('content')
 




   <style>
       .table tr th, .table tr td,.borderdiv {border: black solid !important;}
       .table td, .table th{padding: 5px !important;}
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
                #no-print-eye{
                    display: none;
                    color : #fff !important;
                    background: #fff;
                }
                #printDiv{margin-left:-250px;margin-top:80px !important;margin-bootom:0px !important;width:700px;}
                table{border:1 pax solid #ccc;}
                table tr{height: 25px;}
                table tr th,table tr td{height: 25px;font-size:12px;padding:5px !important;color:#000 !important;}
                .table-bordered > :not(caption) > * > * {
                border-width: 0 0px;
                    border-left-width: 0px;
                }
                .w60{width: 50%;}
                .w33{width: 32%;}
                .w0{width: 0%;float: none;}
                p,p span{font-size: 13px !important;margin-bottom: 10px !important;}
                #singing{margin-top: 50px !important;}
                @page {size: auto;   margin: 0mm auto;}
                h1{font-size: 32px !important;}
                h3{font-size: 16px !important;}

       }   
   </style>    
   <script>
       function printInvoice()
        {
            var totalOwnerAmountFromProductSale = document.getElementById('totalOwnerAmountFromProductSale').value;
            document.getElementById('totalownergetamount').innerHTML = '¥' + totalOwnerAmountFromProductSale;
            printDiv = "#printDiv"; // id of the div you want to print
            $("*").addClass("no-print");
            $(printDiv+" *").removeClass("no-print");
            $(printDiv).removeClass("no-print");
            //var gtotal = document.getElementById('gtotal').value;
            //const numberFormatter = Intl.NumberFormat('en-US');
            
            //gtotal = numberFormatter.format(gtotal);
            //document.getElementById('grandtotal').innerHTML = '¥'+gtotal;
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
<section id="app" class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
        <input type="button" onclick="printInvoice();" value="Print">
        <a href="{{url('auction/product_Owner_mail/'.$woner_id.'/'.$enddate)}}"  class="btn btn-success" style="float: right;">Send Product Sold Mail To Owner</a>

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
            <div  class="col-md-6 w60" style="display:block"> 
                支払書番号:&nbsp;{{$invoiceno}}
            </div>
            <div  class="col-md-6 w60" style="display:block;text-align:right;"> 
                  
                <?php echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日'?>
            </div>
            
        </div>
        <div class="row" style="margin-bottom: 35px;"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block;text-align:center;"> 
                <h3 style="margin-bottom: 0px;text-decoration:underline;">AUCTION委託機械支払明細書</h3>
                <h6>(WOODY AUCTION  <?php echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日 終了分'?>)</h6>
            </div>
            
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <?php 
            $ownername ="";
            if($auctionproductownerinfo->name_jp !="")
            {
                $ownername = $auctionproductownerinfo->name_jp;
            }
            else if($auctionproductownerinfo->name_en !="")
            {
                $ownername = $auctionproductownerinfo->name_en;
            }
            ?>

            <?php 
            $companyname = "";
            $productownername = "";
            if($auctionproductownerinfo->company_name_jp !="")
            {
                $companyname = $auctionproductownerinfo->company_name_jp;
            }
            else if($auctionproductownerinfo->company_name_en !="")
            {
                $companyname = $auctionproductownerinfo->company_name_en;
            }

            if($auctionproductownerinfo->name_jp !="")
            {
                $productownername = $auctionproductownerinfo->name_jp;
            }
            else if($auctionproductownerinfo->name_en !="")
            {
                $productownername = $auctionproductownerinfo->name_en;
            }
            ?>
            <div  class="col-md-7 w33" style="display:block;min-width: 400px;"> 
                
                <?php 
                if($companyname !="")
                {
                ?>
                <span style="min-width: 170px;margin-bottom: 0;padding-bottom: 2px;display: inline-block;">{{$companyname}}</span>
                <div style="width: 200px;height: 5px;border-bottom: 2px solid #000; "></div>
                <?php 
                }
                else
                {
                ?>
                <span style="min-width: 170px;margin-bottom: 0;padding-bottom: 2px;display: inline-block;">{{$productownername}} </span>&nbsp;御中
                <div style="width: 200px;height: 5px;border-bottom: 2px solid #000; "></div>
                <?php 
                }
                
                ?>
                
                <span style="padding-top: 0px;display:block;">出展社 ID. {{$auctionproductownerinfo->usercodeno}}</span> 
                FAX No. {{$auctionproductownerinfo->fax}}
                <br>
                <br>
                下記の金額をお支払い致します 
               &nbsp;
            </div>
            
            <div  class="col-md-5 w33" style="min-width: 300px;display:block;float: right;"> 
                <div style="text-align: left;float: right;width: 265px;">
                <span style="font-size: 20px;font-weight: bold;">有限会社ウッディー</span><br>
                〒146-0094 東京都大田区東矢口1-4-4 <br>
                TEL:03-5700-4622 &nbsp;&nbsp;FAX:03-5700-4625<br>
                Email:info@woodyltd.com<br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 w33" style="height: 30px;width:300px;">
                <span style="width: 80px;height: 26px;border: 2px solid #000;float: left;line-height: 23px;">お支払金額</span>
                <span style="width: 150px;height: 26px;border: 2px solid #000;float: left;padding-left: 5px;line-height: 23px;font-size: 18px;font-weight: bold;" id="totalownergetamount"></span>
            </div>
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block"> 
                
                <div>
                    <div class="table-responsive" style="margin-bottom: 10px;">
                    <table  id="example2" class="table" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th colspan="3" style="border-left-color: #fff !important;border-top-color: #fff !important;">&nbsp;</th>
                                <th style="border-bottom-color: #fff !important;"><div style="position: absolute;"><span style="font-size: 18px;">①</span>成約価格</div></th>
                                <th colspan="4" style="text-align: center;border-left:1px solid #ccc;"><span style="font-size: 18px;">②</span>経費</th>
                            </tr>
                            <tr >
                                <th>LOT No.</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th style="border-top-color: #fff !important;">&nbsp;</th>
                                <th>販売手数料</th>
                                <th>出展料</th>
                                <th>点検費用</th>
                                <th>その他費用</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total_auction_max_bid_amount = 0;    
                                $total_commission = 0;
                                $total_entry_fees = 0;
                                $total_inspection_fees = 0;
                                $total_others_fees = 0;  

                                $count = 0;
                            ?>
                        @foreach($products as $p)
                           <?php 
                            //total before tax calculation
                                $total_auction_max_bid_amount += (int)$p->auction_max_bid_amount !=""?(int)$p->auction_max_bid_amount:0;

                                if((int)$p->auction_max_bid_amount >= 400000 && (int)$p->auction_max_bid_amount <= 4000000)
                                {
                                    $commissionpercent = 5; //5 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else if((int)$p->auction_max_bid_amount > 4000000 && (int)$p->auction_max_bid_amount <= 10000000)
                                {
                                    $commissionpercent = 4; //4 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else if((int)$p->auction_max_bid_amount > 10000000)
                                {
                                    $commissionpercent = 3; //3 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else 
                                {
                                    $total_commission += 20000;
                                }
                                //$total_commission += $p->auction_max_bid_amount !=""?((int)$p->auction_max_bid_amount*$commissionpercent)/100:0;
                                $total_entry_fees += $p->entry_fee !=""?(int)$p->entry_fee:0;
                                $total_inspection_fees += $p->inspection_fee !=""?(int)$p->inspection_fee:0;
                                $total_others_fees += $p->other_fee !=""?(int)$p->other_fee:0 ;
                           ?>
                           <!----Product data show ---->
                            <tr <?php if($count == count($products)-1){?> style="border-bottom: 3px solid #000; width: 100%;"<?php }?> >
                                <td>{{ $p->product_no }}</td>
                                <td>
                                    {{ $p->model_no}} 
                                    <a href="{{url('product/details_view_forinvoice/'.$p->id.'/'.$woner_id.'/'.$enddate)}}" id="no-print-eye" target="_blank" style="float: right;">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ $p->serial_no !=""?$p->serial_no:"" }}
                                </td>
                                
                                <td style="text-align: right;border-left:1px solid #ccc;">¥{{ number_format((int)$p->auction_max_bid_amount) }}</td>
                                <td style="text-align: right">
                                    <?php 
                                    if((int)$p->auction_max_bid_amount !="" || (int)$p->auction_max_bid_amount !=0)
                                    {
                                        if((int)$p->auction_max_bid_amount >= 400000 && (int)$p->auction_max_bid_amount <= 4000000)
                                        {
                                            $commissionpercent = 5;
                                            echo '¥';
                                            echo number_format(((int)$p->auction_max_bid_amount*$commissionpercent)/100);
                                        }
                                        else if((int)$p->auction_max_bid_amount > 4000000 && (int)$p->auction_max_bid_amount <= 10000000)
                                        {
                                            $commissionpercent = 4; //4 percent
                                            echo '¥';
                                            echo number_format(((int)$p->auction_max_bid_amount*$commissionpercent)/100);
                                        }
                                        else if((int)$p->auction_max_bid_amount > 10000000)
                                        {
                                            $commissionpercent = 3; //3 percent
                                            echo '¥';
                                            echo number_format(((int)$p->auction_max_bid_amount*$commissionpercent)/100);
                                        }
                                        else 
                                        {
                                            echo "¥20,000";
                                        }
                                    }
                                    else {
                                        echo '¥0';
                                    }
                                    ?>
                                    
                                </td>
                                <td style="text-align: right">¥{{ number_format($p->entry_fee !=""?(int)$p->entry_fee:0) }}</td>
                                <td style="text-align: right">¥{{ number_format($p->inspection_fee !=""?(int)$p->inspection_fee:0) }}</td>
                                <td style="text-align: right">¥{{ number_format($p->other_fee !=""?(int)$p->other_fee:0) }}</td>
                                
                            </tr>
                            <?php $count++;?>
                        @endforeach

                        <!----Total before tax ---->
                        <tr style="border-bottom: 1px solid #000; width: 100%;">
                            <td colspan="3" style="text-align: center;">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;計</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($total_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($total_commission)}}</td>
                            <td style="text-align: right">¥{{number_format($total_entry_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($total_inspection_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($total_others_fees)}}</td>
                            
                        </tr>

                        <?php 
                                // tax calculation
                                $total_auction_max_bid_amount_tax = ($total_auction_max_bid_amount*10)/100;
                                $total_commission_tax = ($total_commission*10)/100;
                                $total_entry_fees_tax = ($total_entry_fees*10)/100;
                                $total_inspection_fees_tax = ($total_inspection_fees*10)/100;
                                $total_others_fees_tax = ($total_others_fees*10)/100;
                        ?>
                        <!----tax amount---->
                        <tr style="border-bottom: 3px solid #000; width: 100%;">
                            <td colspan="3" style="text-align: center;">消&nbsp;&nbsp;費&nbsp;&nbsp;税</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($total_auction_max_bid_amount_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_commission_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_entry_fees_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_inspection_fees_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_others_fees_tax)}}</td>
                            
                        </tr>
                        <!----Total after tax---->
                        <?php 
                                //total after tax calculation
                                $grandtotal_auction_max_bid_amount = $total_auction_max_bid_amount + $total_auction_max_bid_amount_tax;

                                $grandtotal_commission_fees = $total_commission + $total_commission_tax;
                                $grandtotal_entry_fees = $total_entry_fees + $total_entry_fees_tax;
                                $grandtotal_inspection_fees = $total_inspection_fees + $total_inspection_fees_tax;
                                $grandtotal_others_fees = $total_others_fees + $total_others_fees_tax;

                                $grandTotalCharge = $grandtotal_commission_fees + $grandtotal_entry_fees + $grandtotal_inspection_fees + $grandtotal_others_fees; 
                                $totalOwnerAmountFromProductSale = $grandtotal_auction_max_bid_amount - $grandTotalCharge;
                           ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">合 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 計</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($grandtotal_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_commission_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_entry_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_inspection_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_others_fees)}}</td>
                            
                        </tr>
                        <tr>
                            <td colspan="6" style="border-left-color: #fff !important;border-bottom-color: #fff !important;"></td>
                            <th style="text-align: center">経費計</th>
                            <td style="text-align: right">¥{{number_format($grandTotalCharge)}}</td>
                        </tr>
                            
                        </tbody>
                        
                    </table>
                    </div>

                    <input type="hidden" id="gtotal" value="{{$grandTotalPrice}}" onchange="setValue({{$grandTotalPrice}})">

                    
                    
                    <div style="float: right;text-align:center;margin-top:10px;margin-bttom:10px;border-bottom: 3px solid #000;">
                        <div style="float: left;">
                            <div style="float: right; width: 45px;text-align:center;height: 40px;">
                                <span style="font-size: 32px;height: 10px;display: block;margin-top: -15px;margin-bottom: 12px;">-</span>
                                <span style="font-size: 32px;height: 10px;display: block;">-</span>
                            </div>
                            <div class="borderdiv" style="width: 180px;float: right;border-top:none !important;border-color: #fff !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #fff !important;border-top:none !important;border-left:none !important;border-right:none !important;">
                                    <span style="font-size: 18px;">①</span>成約価格
                                </div>
                            
                                ¥{{number_format($grandtotal_auction_max_bid_amount)}}
                            </div>
                            
                        </div>		
                        <div style="float: left;">
                            <div class="borderdiv" style="width: 180px;float: left;border-top:none !important; border-color: #fff !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #fff !important;border-top:none !important;border-left:none !important;border-right:none !important;"><span style="font-size: 18px;">②</span>経費</div>
                                ¥{{number_format($grandTotalCharge)}}
                            </div>
                        </div>	

                        <div style="float: left;">
                            <div style="float: left; width: 25px;text-align:center;height: 40px;margin-right:10px;">
                                <span style="font-size: 32px;height: 10px;display: block;margin-top: -15px;margin-bottom: 12px;">=</span>
                                <span style="font-size: 32px;height: 10px;display: block;">=</span>
                            </div>
                            <div class="borderdiv" style="width: 180px;float: left;border-top:none !important;border-color: #fff !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #fff !important;border-top:none !important;border-left:none !important;border-right:none !important;">お支払金額</div>
                                ¥{{number_format($totalOwnerAmountFromProductSale)}}
                                <input type="hidden" id="totalOwnerAmountFromProductSale" value="{{number_format($totalOwnerAmountFromProductSale)}}">
                            </div>
                        </div>
                    </div>

                <div style="display: block;width: 100%;float: right;margin-top:30px;">
                    <p>
                        ※書類（車検証、譲渡証、委任状）等のある機械については、弊社が書類受領後のお支払となります。 <br>
                        ※本書を御社よりの請求書と致します。 <br>
                        ※上記機械につき、盗難品・遺失物でない事、及び第三者に対する残債務、譲渡担保・質権等の <br>
                        担保設定がないことをご確認の上、下記に会社名、住所等をご記入・捺印後FAXにてご返送ください <br>
                        ※成約機械の搬入について：必ず搬入前日までに弊社までに搬入予定日、運送会社をご連絡ください <br>
                        <div style="width: 300px; display:inline-block;"> 
                            <span style="margin-right: 220px;">御社名</span><br>
                            <span style="width: 220px;height: 30px;"></span> 
                        </div>
                        <div style="width: 300px; display:inline-block;">  
                            <span style="padding-left: 25px;">住所</span> <br><br>
                            <span><span style="font-size: 18px;">㊞</span> &nbsp;&nbsp;  </span> 
                        </div>
                         <div style="width: 100%;border-bottom: 3px solid #000;margin-bottom: 30px;"></div>       
                              
                    </p>
                    <p>
                        振込先 <br>
                        <div style="width: 300px; display:inline-block;">
                            <span style="width: 220px;">金融機関名</span> 
                        </div>
                        <div style="width: 300px; display:inline-block;">
                            <span style="padding-left: 10px;">支店</span>
                        </div>
                        <div style="width: 100%;border-bottom: 3px solid #000"></div>
                    </p>
                </div>
                <div style="width: 370px;float: right;margin-top:30px;">
                    当座・普通　No： <br>
                    <div style="width: 100%;border-bottom: 3px solid #000"></div>
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