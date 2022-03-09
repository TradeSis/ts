<?php
	
   
    
    $aplicacao="";
    if(isset($_COOKIE["aplicacao"])) {
        $aplicacao=$_COOKIE["aplicacao"];
    }
    $URL="";
    if(isset($_COOKIE["URL"])) {
        $URL=$_COOKIE["URL"];
    }
    echo $aplicacao."|".$URL;

    //echo("<script>console.log('buscaCookie.php APLICACAO: " . $aplicacao . "');</script>");
    //echo("<script>console.log('buscaCookie.php URL: " . $URL . "');</script>");

?>