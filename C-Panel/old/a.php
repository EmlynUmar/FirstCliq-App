<?php 
$thesite=$_SERVER["SERVER_NAME"]; 
$thesite=str_replace("www.","",$thesite); 
$thesite=str_replace("https://","",$thesite); 
$thesite=str_replace("http://","",$thesite); 
$thesite=str_replace("http://","",$thesite); 
$thematter=md5(base64_encode($thesite)); 
?>
Site: =    <?=$thesite;?>
<br/></br/>
Key: =  <?=$thematter;?>