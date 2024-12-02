<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Conditional Report</title>
</head>

<body>
    <?php 
        //echo $_GET['id'];
        $data = App\Models\Product::where('id',$_GET['id'])->select('conditional_report')->get();
        //dd($data[0]->conditional_report);
    ?>
    <?php 
    if($data[0]->conditional_report !="")
    {
        $report = $data[0]->conditional_report;
        $ext ="";
        $ext = pathinfo(parse_url($report, PHP_URL_PATH), PATHINFO_EXTENSION);
        //$ext = $report->getClientOriginalExtension();
        if($ext == 'pdf'||$ext == 'txt'||$ext == 'rtf'||$ext == 'PDF'||$ext == 'TXT'||$ext == 'RTF')
        {
    ?>
            <iframe
                src="{{url($data[0]->conditional_report)}}#toolbar=0&navpanes=0&scrollbar=0"
                frameBorder="0"
                scrolling="auto"
                height="100%"
                width="100%"
            style="min-height: 600px;"></iframe>
    <?php 
        }
        else if($ext == 'JPG'||$ext == 'jpg'||$ext == 'jpeg'||$ext == 'JPEG'||$ext == 'png'||$ext == 'PNG'||$ext == 'gif'||$ext == 'GIF')
        {
    ?>
        <div style="min-width: 300px;margin:0 auto;">
            <img src="{{url($data[0]->conditional_report)}}" style="margin: 0 auto;display: block;">
        </div>    
    <?php 
        }
    }
    ?>   
</body>

</html>