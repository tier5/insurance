<html>
<head></head>
<body>
<?php 
//$fields="startDate=20170901&endDate=20170930&Record_Type=S&type=course";
//$res= curl_command('http://lasvegasrealtor.mobi:81/Service.asmx/getCalender', $post_count, $fields);
$url='http://lasvegasrealtor.mobi:81/Service.asmx/getCalender?startDate=20170901&endDate=20170930&Record_Type=S&type=course';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $status=simplexml_load_string($result);
        echo'<pre>';
       print_r($status);
       echo'</pre>';
?>
</body>
</html>