<?php

/*VERSAO Projetos public 23/02/2022*/

/* helio escreveu na develop_helio _ e deixou lá */

//header
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function retornaheader($code) {
    if (isset($code)) {
        switch ($code) {
               case 200: $text = 'OK';
                   break;
               case 201: $text = 'Created';
                   break;
               case 202: $text = 'Accepted';
                   break;
               case 203: $text = 'Non-Authoritative Information';
                   break;
               case 204: $text = 'No Content';
                   break;
               case 205: $text = 'Reset Content';
                   break;
               case 206: $text = 'Partial Content';
                   break;
               case 300: $text = 'Multiple Choices';
                   break;
               case 301: $text = 'Moved Permanently';
                   break;
               case 302: $text = 'Moved Temporarily';
                   break;
               case 303: $text = 'See Other';
                   break;
               case 304: $text = 'Not Modified';
                   break;
               case 305: $text = 'Use Proxy';
                   break;
               case 400: $text = 'Bad Request';
                   break;
               case 401: $text = 'Unauthorized';
                   break;
               case 402: $text = 'Payment Required';
                   break;
               case 403: $text = 'Forbidden';
                   break;
               case 404: $text = 'Not Found';
                   break;
               case 405: $text = 'Method Not Allowed';
                   break;
               case 406: $text = 'Not Acceptable';
                   break;
               case 407: $text = 'Proxy Authentication Required';
                   break;
               case 408: $text = 'Request Time-out';
                   break;
               case 409: $text = 'Conflict';
                   break;
               case 410: $text = 'Gone';
                   break;
               case 411: $text = 'Length Required';
                   break;
               case 412: $text = 'Precondition Failed';
                   break;
               case 413: $text = 'Request Entity Too Large';
                   break;
               case 414: $text = 'Request-URI Too Large';
                   break;
               case 415: $text = 'Unsupported Media Type';
                   break;
               case 500: $text = 'Internal Server Error';
                   break;
               case 501: $text = 'Not Implemented';
                   break;
               case 502: $text = 'Bad Gateway';
                   break;
               case 503: $text = 'Service Unavailable';
                   break;
               case 504: $text = 'Gateway Time-out';
                   break;
               case 505: $text = 'HTTP Version not supported';
                   break;
               default:
                   exit('Unknown http status code "' . htmlentities($code) . '"');
                   break;
           }

           $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
           header($protocol . ' ' . $code . ' ' . $text);
           $GLOBALS['http_response_code'] = $code;
       } else {
           $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
       }

       return $code;
   }

function pegaparam($varname) {
        $v=(isset($_GET[$varname]))?$_GET[$varname]:((isset($_POST[$varname]))?$_POST[$varname]:'');
        //if(!$v) $v = $_SESSION[$varname];
        //else $_SESSION[$varname] = $v;
        return($v);
}

//header
$aplicacao = null;
$funcao    = null; //Param

$metodo    = $_SERVER["REQUEST_METHOD"]; //POST, PUT, DELETE and GET
$uri       = $_SERVER["REQUEST_URI"];


$data      = null;

$versao   = pegaparam("versao");
$log      = pegaparam("log");

$parametro = "";
$uri_parse = parse_url($uri,PHP_URL_PATH);

$conteudoEntrada  = file_get_contents('php://input');

$jsonEntrada = json_decode($conteudoEntrada, TRUE); // Transforma um texto formato json, numa array json

//$data = array($conteudoEntrada);
//parse_str($conteudoEntrada,$data);

$unsetCount = 3;
/**/
//TRATA A URI
//echo  $uri_parse. "\n";
$ex = explode("/", $uri_parse);
for($i = 0; $i < $unsetCount; $i++){
 // unset($ex[$i]);
}
$ex = array_filter(array_values($ex));
if(isset($ex[2])){
  $aplicacao = $ex[2];
}
if(isset($ex[3])){
  $funcao = $ex[3];
}

if(isset($ex[4])){
  $parametro = $ex[4];
}

/**/
$hml=false;
if ($_SERVER['SERVER_ADDR']=="10.2.0.233"||$_SERVER['SERVER_ADDR']=="10.2.0.44") {
  $hml = true;
}

/**
echo 'host='.$_SERVER['SERVER_ADDR']."\n";
echo "aplicacao=".$aplicacao."\n";
echo "versao=".$versao."\n";
echo "funcao=".$funcao."\n";
echo "parametro=".$parametro."\n";
echo "metodo=".$metodo."\n";
echo "log=".$log."\n";
echo "hml=".$hml."\n";
**/
$cookie=null;
$empresa=null;

if(isset($_COOKIE["user_email"])) {
    $cookie=$_COOKIE["user_email"];
    echo("<script>console.log('PHP user_email: " . $_COOKIE["user_email"] . "');</script>");
}

if(isset($_COOKIE["empresa"])) {
    $empresa=$_COOKIE["empresa"];
    echo("<script>console.log('PHP empresa: " . $_COOKIE["empresa"] . "');</script>");
}

//echo "cookie=".$cookie."\n";

echo("<script>console.log('PHP COOKIE: " .$cookie . "');</script>");
echo("<script>console.log('APLICACAO: " . $aplicacao . "');</script>");




/**/
echo("<script>console.log('SEGUE PARA APLICACAO : " . $aplicacao . "');</script>");     

switch ($aplicacao) {
	case "view":

        if(!isset($cookie))
                {
                    if($aplicacao=="view"||$aplicacao=="login") {
                        
                            echo("<script>console.log('REQUIRE: " . $aplicacao . "');</script>");
                        require  "../login/login.php";

                        } else {
                            echo("<script>console.log('LOCATION: " . $uri . "');</script>");     
                        header("location:/ts/login?URL=".$uri );
                        }
                        
                        exit;
                
                }
         if ($empresa=="TESTE"){
            //require  "./erp/testes/menu.php";
            require "./erp/applucas/menu.php";
         } else {
            require "./erp/dashboard/menu.php";
         }

         break;

	case "aduana":
		require  "./erp/antigos/aduana/menu.php";
		break;

  case "lebes":
            require  "../lebes/menu.php";
            break;
            
	case "testes":
        require  "./erp/testes/menu.php";
        break;

        case "vision":
            require  "./tsvision/app.php";
            break;

   default:

   echo "Aplicacao ".$aplicacao." não identificada.";
    retornaheader(400);
      break;
}



?>
