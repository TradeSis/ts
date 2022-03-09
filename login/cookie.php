<?php
echo "COOKIE=". $email;

 setcookie("email", $email,time()+10,"/");
 setcookie("empresa", $retorno["empresa"],time()+10,"/");
 setcookie("URL", $URL,time()+10,"/");
?>

 