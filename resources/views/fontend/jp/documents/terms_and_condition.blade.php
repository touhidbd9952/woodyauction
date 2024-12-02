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

<script> 
function showmenu(menudiv)
{ 
    
    document.getElementById("menudiv1").style.display = "none";  
    document.getElementById("menudiv2").style.display = "none"; 
    document.getElementById("menudiv3").style.display = "none"; 
    document.getElementById("menudiv4").style.display = "none"; 

    document.getElementById(""+menudiv).style.display = "block";
    
}
</script>    

<section class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
      <div class="container">
        <div class="row"> 
            <div class="col-md-12"> 
                <div style="width: 100%;min-height:50px;">
                    <div class="col-md-3">
                        <a href="{{route('woody.terms_and_condition')}}" class="menudiv" >Terms and Condition</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('woody.security_deposit')}}" class="menudiv" >Security Deposit</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('woody.winner_bidding_to_payment')}}" class="menudiv" >Winner Bidding to Payment</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('bid_document.carry_out_of_equipment')}}" class="menudiv" >Carry-Out of Equipment</a>
                    </div>
                </div>    
            </div>  

            <!---======== start =========---->
            <div id="menudiv1" class="col-md-12"> 
            <h4>Terms and Condition for Bidding</h4>
            <br><br>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV1')" class="headertitle">Qualification </a>
                <div id="menudiv1myDIV1" style="display:none">
                   
                   <p> 
                       WOODY Auction is only for WOODY’s network members. After registration, a member can be bid on WOODY auction items.
                   </p>
                   <p>
                    To become an Applicant, required to send Security Deposit (*) as well as company information to WOODY (If Applicant has no experience as auction bidder, please consult with WOODY.)
                   </p>  
                   <p>
                    <b>Security Deposit</b><br>
                    <ol>
                        <li>a. Security Deposit Amount: Needs to pay 10% or over that depends on planned purchase amount (minimum JPY500,000)</li>
                        <li>b. An Applicant will not get interest for the Security Deposit.</li>
                        <li>c. The Security Deposit Amount will consider as guarantee debt. Member may owe WOODY Auction.</li>
                        <li>d. Security Deposit will be returned if membership is canceled.</li>
                        <li>e. If the outstanding debt balance of the withdrawing member is larger than the amount of the Security Deposit, the member is solely responsible for clearing up the debt within seven working days.</li>
                        <li>f. WOODY will be exempted from returning the Security Deposit when no application for return has been made within three years from the date of Membership Cancellation.</li>
                    </ol>
                   </p>          

                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV2')" class="headertitle">User ID and Password</a>
                <div id="menudiv1myDIV2" style="display:none">
                    <p>
                        <ol>
                            <li>• User ID and Password for each Auction Member will issue by WOODY.</li>
                            <li>• Auction Member must not share their User ID or Password to another person. </li>
                            <li>• Auction Member will be responsible for their actions through WOODY Auction Service using ID/Password and any result deriving from it.</li>
                            <li>• If Auction Member forgot his/her User ID or Password, Please contact to WOODY immediately.</li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV3')" class="headertitle">Elimination system of Antisocial Member</a>
                <div id="menudiv1myDIV3" style="display:none">
                    <p>
                        <b>Following people or group of people cannot participate in WOODY Auction.</b> 
                        <ol>
                            <li>• Gangster organization, gangsters, quasi-gangsters, gangster-related enterprises</li>
                            <li>• Fixers of stockholders' meetings, racketeers in disguise with propaganda or social welfare activities, swindler groups (such as in remittance fraud cases)</li>
                            <li>• Others corresponding to the items enumerated above</li>
                        </ol>
                        <br>

                        <b>Executing acts indicated below by Auction Member himself/herself or with the help of the Third Party is prohibited.</b>
                        <ol>
                            <li>• Violent demanding acts</li>
                            <li>• Unreasonable demanding acts</li>
                            <li>• Threatening words and deeds or act of violence regarding the deal</li>
                            <li>• Frauds, acts of damaging WOODY’s reputation by influence or acts of disturbing WOODY’s businesses</li>
                            <li>• Others corresponding to the items enumerated above</li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV4')" class="headertitle">Warranty</a>
                <div id="menudiv1myDIV4" style="display:none">
                    <p>
                        <b>Every item is sold "AS IS/WHERE IS."</b>
                        <ol>
                            <li>• The Condition Report shows the results of the assessment of the equipment made according to our standard rules. Please note that the contents of the report do not guarantee the condition including the hours of operation. If you have any questions, be sure to ask us prior to Bidding.</li>
                            <li>• Equipment photos have been prepared to show the conditions of the equipment as clearly as possible. If you are concerned about any specific part of equipment, please be sure to contact us before bidding.</li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV5')" class="headertitle">Cancellation of Bidding</a>
                <div id="menudiv1myDIV5" style="display:none">
                    <p>
                        <ol>
                            <li>• Once a Bidder has successfully bid on an item in the Auction, the Bidder cannot call off his/her purchase.
                                Withdrawing the successful bidding is handled as CANCELLATION of contract.</li>
                            
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV6')" class="headertitle">Right to Cancel Contract and Treatment of Complaints</a>
                <div id="menudiv1myDIV6" style="display:none">
                    <p>
                        <b>WOODY has the right to notify any Auction Member ineffectiveness of his/her bidding and to cancel any contract at any time, when problems including but not limited to the following take place:
                            <br>-Example-
                            </b>
                        <ol>
                            <li>• Delayed or unreceived bidding due to communication conditions on either side of Bidder and WOODY</li>
                            <li>• Discovering erroneous data of the entry equipment</li>
                            <li>• Inability of the equipment delivery due to the inability of the ownership transfer of the purchased item</li>
                        </ol>
                    </p>
                    <p>
                        <b>Treatment of Complaints</b>
                        <ol>
                            <li>• WOODY will discuss with the Consignor when necessary, the inappropriateness of the Condition Report or defects found on the purchased equipment after the Auction, however, Bidder is requested to agree to WOODY’s final decision.</li>
                            
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV7')" class="headertitle">Contract</a>
                <div id="menudiv1myDIV7" style="display:none">
                    <p>
                        <ol>
                            <li>• WOODY notifies Bidder, after the Auction close, of his/her Successful Bid by E-mail and sends the Invoice by Fax. At this point the sales contract is concluded.</li>
                            
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV8')" class="headertitle">Terms of Payment</a>
                <div id="menudiv1myDIV8" style="display:none">
                    <p>
                        <ol>
                            <li>• <b>Within One Week after the Auction</b>
                                <br>
                                The Successful Bidder will complete the payment including the equipment price, Contract Fee, Carryout Charge, etc. within one week from the date that he/she received the notice of the successful bid by e-mail.</li>
                            <li>• <b>Cash by T.T(Telegraphic Transfer)</b>
                                <br>
                                Only Cash by T.T(Telegraphic Transfer) is acceptable for the payment. Payment other than cash such as L/C will not be accepted.
                                Bank transfer charges must be covered by the Successful Bidder.
                                </li>
                            <li>• <b>Consumption Tax</b>
                                <br>
                                Consumption Tax is chargeable on prices and fees of all goods and services for Successful Bidders residing in Japan.
                            </li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV9')" class="headertitle">Delayed Payment and Cancellation</a>
                <div id="menudiv1myDIV9" style="display:none">
                    <p>
                        <ol>
                            <li>• <b>Annual Interest Rate of 7.3%</b>
                                <br>
                                If the payment of the price is not made by the deadline, the Successful Bidder will be required to pay the Late Fee that would be calculated as an annual interest of 7.3% of the purchased product's price corresponding to the number of the delayed days.</li>
                            <li>• WOODY has the right to cancel a deal with overdue payment regardless of the reason. In this case all expenses and loss incurred for the resale, the late payment charge, the storage fee shall be borne by the Successful Bidder.</li>
                            <li>• <b>Cancellation</b><br>When the Successful Bidder intends to cancel the purchase, he/she will pay as follows despite whatever reason:
                                <br>
                                <b>Cancellation</b>
                                <br>
                                <ol>
                                    <li>• Within One Hour from the Auction Close<br>
                                        Penalty fee 10 % of the bid price (minimum JPY100,000)
(Money collected as Penalty will be transferred to the machine owner.)

                                    </li>
                                    <li>• After One Hour or Later from the Auction Close<br>
                                        The higher amount between JPY500,000 minimum deposit and 10% of the bid price of the subject equipment in addition to the Late Fee described in (1) above.
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV10')" class="headertitle">Other Fees and Charges</a>
                <div id="menudiv1myDIV10" style="display:none">
                    <p>
                        <ol>
                            <li>• <b>Contract Fee</b>
                                <br>
                                Contract Fee of JPY10,000 / item is chargeable on every purchased equipment."
                            </li>
                            <li>• <b>Carryout Charge</b>
                                <br>
                                "Every item is chargeable with Carryout Charge, when the Delivery Yard is OTHER than “NORI Yard.” The Carryout Charge is indicated at the “Feature” on the Entry Items List."
                                <br>
                                (Note: When the purchased item is directly exported from the Delivery Yard at the port, Carryout Charge is not required.)

                            </li>
                            <li>• <b>Handling Charge</b>
                                <br>
                                When some works are necessary to release a purchased item out of the Delivery Yard, Handling Charge is charged on the Successful Bidder. The Handling Charge is indicated at the “Feature” on the Entry Items List.
                            </li>
                            <li>• <b>Storage Fee</b>
                                <br>
                                Storage is free basically for the period of three weeks after the Auction, and when the Carry-Out of the item is done after that despite whatever reason, Storage Fee of JPY200—JPY800 is required daily per item (except for special and large-sized equipment with other specific amount of charge).
                                <br>
                                <table>
                                    <tr>
                                        <td style="width: 350px;">Parts/ Attachment</td><td>JPY300/Day</td>
                                    </tr>
                                    <tr>
                                        <td>Box type Equipment (large size is removed)</td><td>JPY/400/Day</td>
                                    </tr>
                                    <tr>
                                        <td>Operating weight 5t less</td><td>JPY400/Day</td>
                                    </tr>
                                    <tr>
                                        <td>Operating weight 5t up to 20t less</td><td>JPY500/Day</td>
                                    </tr>
                                    <tr>
                                        <td>Operating weight 20t or over</td><td>JPY600/Day ~</td>
                                    </tr>
                                </table>
                                
                            </li>
                            <li>• <b>Inland Trucking Charge</b>
                                <br>
                                When Successful Bidder is an Overseas Auction Member, please note that there are cases that purchased item must be transported from the Machine Owner’s Yard or WOODY-designated-Non-Port Delivery Yard to Forwarder’s Yard for exportation. In such case the Successful Bidder must pay the cost of such Inland Trucking.
                            </li>
                            <li>• <b>Repair Work</b>
                                <br>
                                "WOODY handles repair works for the purchased items as follows: Repair Work in place of the Successful Bidder (at WOODY’s Designated Repair Facility): 
                                <br>
                                JPY6,000 / per hour per one mechanic + other actual expenses"
                            </li>
                            <li>• <b>Carry-Out without Prior Notice</b>
                                <br>
                                When Successful Bidder needs to carry out his/her purchased Equipment inevitably, although he/she failed to notify WOODY about the Carry-Out by the previous day, he/she may do Carry-Out but with the payment of an Extra Work Charge of JPY5,000.
                            </li>
                            
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV11')" class="headertitle">Carry-Out from the Delivery Yard</a>
                <div id="menudiv1myDIV11" style="display:none">
                    <p>
                        We may be forced to decline the Carry-Out by the Successful Bidder, if he/she comes with a non-law-abiding vehicle, unsafe truck, or trailer.
                        <br>
                        <ol>
                            <li>• In case that the Equipment has already ARRIVED at the Delivery Yard by the time of Auction Entry:
                                <br>
                                The Successful Bidder is requested to make payment within one week and to carry out the purchased Equipment within two weeks from the Auction Day. If Carry-Out is not executed by the above deadline, the Storage Fee (See 10-(4)) is chargeable on the Successful Bidder.
                            </li>
                            <li>• In case that the Equipment is will COMMING the Delivery Yard at the time of Auction Entry:
                                <br>
                                The Equipment purchased by the Successful Bidder will arrive in WOODY's Designated Delivery Yard within One Week. The Successful Bidder is requested to carry out his/her equipment within three weeks from the Auction Day including the period necessary for its transport into the Delivery Yard. If Carry-Out is not executed by the above deadline, the Storage Fee. (See 9-(d)) is chargeable on the Successful Bidder.
                            </li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV12')" class="headertitle">Carry-Out Rules on each Delivery Yard</a>
                <div id="menudiv1myDIV12" style="display:none">
                    <p>
                        <ol>
                            <li>• In Case of Carry-Out from Consignor's Yard
                                <br>
                                <ol>
                                    <li>• 	[When Successful Bidder is an Overseas Auction Member]</li>
                                </ol>    
                            </li>
                            <li>• 	After the Successful Bidding the purchased Equipment is transported to one of WOODY-Designated Forwarders’ Yards. The Successful Bidder will be billed for Inland Trucking Charge specified in the invoice.
                                <br>
                                [When Successful Bidder is a Domestic Auction Member]
                                <br>
                                The successful Bidder is required to follow WOODY's instructions. The Successful Bidder CANNOT contact the Consignor directly to carry out his/her equipment. Carry-Out is done in terms of Freight on Board. If Carry-Out is not executed within two weeks after the Auction Close, WOODY will transfer the equipment to WOODY's Designated Delivery Yard. The Successful Bidder is responsible for all the cost incurred from such operation.
                                <br>
                                After three weeks from the Auction Day we shall not be responsible for safe storage of Equipment.
                            </li>
                            <li>• In Case of Carry-Out from NOT Consignor's Yard
                                <br>
                                The Successful Bidder is required to be in charge of the loading work for Carry-Out.
                                <br>
                                See "Selection of Auction Entry Yard and Notes" Page. 
                            </li>
                            <li>• Carry-Out Notice
                                <br>
                                The Successful Bidder is required to give WOODY an advance notice, by the previous day of the Carry-Out, about the date/time, and transport company name of the purchased item. When there is NO such advance notice or permission, the purchased equipment CANNOT be carried out.
                            </li>
                            <li>• The Successful Bidder shall be responsible for all the accidents and/or troubles taking place at the time of and after the Carry-Out. WOODY shall be exempted from such responsibility.</li>
                            <li>• Delayed Carry-Out
                                <br>
                                <ol>
                                    <li>(a) The Storage Fee. (See 10)</li>
                                    <li>
                                        (b) The Successful Bidder shall be responsible for all damages or losses (e.g. oil leakage, sticking, rust, damage to electric system) incurred after the Auction, caused fy any reasons including lapse of time, weather, etc.
                                    </li>
                                </ol>
                            </li>
                            <li>• Inland Trucking Charge
                                <br>
                                (a) Bidders are advised to contact WOODY about estimates for transporting equipment from any other yard to a yard of Bidder designation. (In case that the Successful Bidder arranges the Inland Trucking himself/herself, he/she is required to observe the Carry-Out deadline.)
                                (b) In case that the Successful Bidder chooses the forwarder, which is other than WOODY's Designated ones, the Successful Bidder needs to be aware that separate Releasing Charge and Trucking Charge are payable.
                            </li>
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV13')" class="headertitle">Governing Law and Revision</a>
                <div id="menudiv1myDIV13" style="display:none">
                    <p>
                        <ol>
                            <li>• No part of rights and duties of WOODY Auction Membership shall be transferred or sublet to any third party.</li>
                            <li>• WOODY reserves the right to refuse the entry of equipment by such auction member as obstruct or may obstruct the fair　operation of the auction or can terminate his/her WOODY Auction Membership without prior notice.</li>
                            <li>• WOODY reserves the right to revise these rules, if need be, without prior notice.</li>
                            <li>• When issues and problems that are not stipulated by these rules take place or some uncertainty regarding the interpretation of rules arise, WOODY and Consignor shall seek for mutually acceptable solution through consultation with each other.</li>
                            <li>• These Terms and Conditions shall be governed by the Japanese laws and all disputes shall be submitted to Tokyo District Court as the Court of First Instance.</li>
                            
                        </ol>
                    </p>
                </div>
            </div>

            <div class="section-div"> 
                <a href="javascript:" onclick="myFunction('menudiv1myDIV14')" class="headertitle">Indemnity in WOODY Auction Service</a>
                <div id="menudiv1myDIV14" style="display:none">
                    <p>
                        <ol>
                            <li><i class="fas fa-circle"></i> The content of WOODY Auction Service is limited to what WOODY can offer at any point of time, and WOODY shall not be responsible for the completeness, correctness, applicability nor usefulness of the data, etc. kept by a third party.</li>
                            <li><i class="fas fa-circle"></i> WOODY shall not be responsible for the loss or falsification by a third party of the data, etc. which Auction Member has kept in his/her digital terminal for the use in WOODY Auction.</li>
                            <li><i class="fas fa-circle"></i> WOODY shall not be responsible nor have an obligation to compensate for the loss suffered by Auction Member through the use of WOODY Auction Service (including the loss suffered through the trouble between Auction Member and a third party). WOODY shall neither be responsible nor have an obligation to compensate for the loss suffered by Auction Member or a third party because of not being able to use the WOODY Auction Service.</li>
                            <li><i class="fas fa-circle"></i> WOODY shall not be responsible for the loss suffered in any of the following cases.
                                <br>
                                <ol>
                                    <li>(a) The loss suffered due to the malfunction of the hardware and/or software of the computers owned by WOODY and WOODY’s associated organizations</li>
                                    <li>(b) The loss suffered due to communication failure (including failure due to Auction Member’s equipment)</li>
                                    <li>(c) The loss suffered due to natural disasters such as flood and storm damages, lightning, fires, abnormal current and other uncontrollable situations which made WOODY unable to operate normally or provide WOODY Auction Service (including the safekeeping of the Equipment) </li>
                                    <li>(d) The loss suffered because the ID/Password of Auction Member were stolen, irrespective of reason, by a third party.</li>
                                    <li>(e) The loss suffered due to the failure by Auction Member in operating his/her equipment.</li>
                                    <li>(f)  Other kinds of losses due to reasons for which it is impossible for WOODY to be responsible.</li>
                                    
                                </ol>
                            </li>
                            
                        </ol>
                    </p>
                </div>
            </div>


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