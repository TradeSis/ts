<?php
       
    session_start();
    if(!isset($_SESSION['start'])) {
    
          $_SESSION['start'] = time();
    
    }
    if (isset($_SESSION['start']) && (time() - $_SESSION['start'] >300)) {

        session_unset();
    
         session_destroy();
        session_start();

    
    }

    $APLICACAO="";
    $URL      = $_SERVER["REQUEST_URI"];
    $uri_parse = parse_url($URL,PHP_URL_PATH);
    
        $ex = explode("/", $uri_parse);
        $ex = array_filter(array_values($ex));
    
        if(isset($ex[2])){
            $APLICACAO = $ex[2];
        }
    if ($APLICACAO=="vision"||
        $APLICACAO=="services"||
        $APLICACAO=="dashboard") {
        } else {
            echo "Aplicacao ".$APLICACAO." não identificada.";    
            session_destroy();
            return;
        }


    if (!isset($_SESSION["URL"])) {
         $_SESSION["URL"]= $URL;
    }
    if (!isset($_SESSION["APLICACAO"])) {
        $_SESSION["APLICACAO"] = $APLICACAO;
    }
    $EMAIL="";
    if (isset($_SESSION["EMAIL"])) {
        $EMAIL = $_SESSION["EMAIL"];
        
    } 

    echo("<script>console.log('SEGUE PARA APLICACAO : " . $APLICACAO . "');</script>"); 
    echo("<script>console.log('EMAIL : " . $EMAIL . "');</script>"); 
    //echo("<script>console.log('As sessões em cache irão expirar depois de: " . $cache_expire  . "minutos');</script>"); 
    
     

    if (!isset($_SESSION["EMAIL"])) {
        include_once  "./login/index.php";
        exit;
    } else {
        $EMAIL =  $_SESSION["EMAIL"];   
        if ($_SESSION["URL"]!==$URL) {
            $_SESSION["URL"]= $URL;
        }
        if ($_SESSION["APLICACAO"]!==$APLICACAO) {
     
            $_SESSION["APLICACAO"] = $APLICACAO;
    
        }
    }


  //  echo "URL=".$URL."\n";
  //  echo "APLICACAO=".$APLICACAO."\n";

    var_dump($_SESSION);
    

    switch ($APLICACAO) {
        case "vision": // Visões e DashBoards
            require "./tsvision/index.php";
        break;
        case "services": // Controle de Serviçõs 
            require "./tsservices/index.php";
        break;  
    
        case "web": // Sistema de Gestão Interna
            require "./tsweb/index.php";
        break;                       
        default:

        echo "Aplicacao ".$APLICACAO." não identificada. EMAIL: " .$EMAIL;    
        session_destroy();       
        break;
    }    

   //session_destroy();


?>
