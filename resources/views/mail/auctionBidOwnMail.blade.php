<html>
  <head>

    <meta http-equiv="content-type" content="text/html; ">
  </head>
  <body>
    <br>
      <br>
      <br>
      {{$auctiondata['companyname']}}<br>    
      {{$auctiondata['person_incharge']}} &nbsp;様<br>
      ID：{{$auctiondata['biddercode']}}<br>
      <br>
      本日は　Woodyオークションにご参加いただきありがとうございます。<br>
      お客様の落札された内容は下記のとおりです。ご確認下さい。<br>
      <br><br>

      /_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/<br>
      <br>
      【LOT No.】&nbsp;: &nbsp;{{$auctiondata['auctionno']}}<br>
      【モデル_シリアル】&nbsp;:&nbsp; {{$auctiondata['modelno']}}{{$auctiondata['serial_no'] !=""? "_".$auctiondata['serial_no']:""}}<br>
      【落札金額】&nbsp;:&nbsp;￥&nbsp;{{number_format($auctiondata['bid_max_price'])}} <br>
      【引渡場所】&nbsp;:&nbsp; {{$auctiondata['deliveryplace']}}<br>
      /_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/<br>
      <br><br>


      *請求書は明日ＦＡＸにて送信させていただきます。<br>
      ★受取場所からの機械引取りについて<br>
      ※搬出時には必ず前日までに搬出日、回送業者を弊社にご連絡ください。当日連絡は搬出不可もしくは、10,000円の【追加料金】がかかります<br>
      ※未搬入の場合、入庫状況を弊社までお問い合わせください。遠隔地の場合、1～２週間お時間を頂くことがあります。<br>
      ※オークション終了後14日以内の引取を厳守してください。オークション終了後１５日目から【保管料】がかかります。<br>
      
      <br><br>


      ご不明な点は下記にお問い合わせください。<br>
      <br>
      =====================================================<br>
      有限会社ウッディー<br>
      電話番号: 03-5700-4622<br>
      FAX番号 :  03-5700-4625<br>
      URL : <a class="moz-txt-link-freetext" href="https://auction.woodyengineering.com/">https://auction.woodyengineering.com/</a><br>
      E-Mail: <a class="moz-txt-link-abbreviated" href="mailto:info@woodyengineering.com">info@woodyengineering.com</a><br>
      =====================================================<br>
    
  </body>
</html>