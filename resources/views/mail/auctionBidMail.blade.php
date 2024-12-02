<html>
  <head>

    <meta http-equiv="content-type" content="text/html; ">
  </head>
  <body>
    <br>
      <br>
      <br>
      {{$auctiondata['companyname']}}<br>　
      {{$auctiondata['person_incharge']}} &nbsp;様 <br>　
      入札者番号：{{$auctiondata['biddercode']}}<br>
      <br>
      Woodyオークションに参加いただきありがとうございます。<br>
      お客様の入札された内容は下記のとおりです。ご確認下さい。<br>
      貴社の入札額が逆転された際にメールはお送りしておりませんので、現在価格を随時オークションにてご確認ください。<br>
      <br>
      /_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/<br>
      <br>
      【LOT No.】&nbsp;: &nbsp;{{$auctiondata['auctionno']}}<br>
      【モデル】 &nbsp;: &nbsp;{{$auctiondata['modelno']}}<br>
      【シリアル】&nbsp;: &nbsp;{{$auctiondata['serialno']}}<br>
      【入札金額】&nbsp;: &nbsp;￥&nbsp;{{number_format($auctiondata['bid_price'])}} ({{$auctiondata['bid_system']}}) <br>
      /_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/<br>
      <br>
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