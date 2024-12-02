<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Product Video</title>
</head>


<body>
    

    <?php 
        //echo $_GET['id'];
        $data = App\Models\Product::where('id',$_GET['id'])->get();
        //dd($data[0]->conditional_report);
    ?>
    <?php 
    if($data[0]->videourl !="")
    {
        $videourl = $data[0]->videourl;
        $search = 'https://youtu.be/' ;
        $videourl = str_replace($search, '', $videourl) ;
    ?>

<style>
    .ytp-title-text{display: none !important;}
    .html5-video-player a{display: none !important;}
</style>
          
        <iframe id="myiFrame" width="100%" height="500" src="https://www.youtube.com/embed/{{$videourl}}?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        
            
        </iframe> 

        <br>
        
        <div style="margin-top: 10px;">{{$data[0]->long_description}}</div>
    <?php 
    }
    ?>  
    


</body>

</html>