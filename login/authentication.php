<?php      
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
    $host = "sql486.main-hosting.eu";  
    $user = "u384787522_helio";  
    $password = "2Et*MNY1oJul";  
    $db_name = "u384787522_tswebdev";  

      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  


    $email = $_GET['email'];  
    $senha = $_GET['senha'];  
    //$URL = $_GET['URL'];  
   

        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $senha = stripcslashes($senha);  

        $query = "select * from usuario where email = '$email'";  

        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);  
        
        $retorno = [];
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                    $retorno = $row;
          }
        }
      


          
        if($count == 1){  
                if (MD5($senha)==$retorno["senha"]){
                    echo "OK";
                 
                   $_SESSION["EMAIL"]   = $retorno["email"];
                   $_SESSION["EMPRESA"] = $retorno["empresa"];
                   $_SESSION["USUARIO"] = $retorno["nome"];
                   $empresa = $_SESSION["EMPRESA"];
                   $query = "SELECT * FROM aplicacaoEmpresa WHERE aplicacaoEmpresa.empresa = '$empresa'";  

                   $result = mysqli_query($con,$query);
                   $retorno["menuAplicacao"] = [];
                  // $_SESSION["MENU"] = {};
                   
                   if($result){
                        while($row = mysqli_fetch_assoc($result)){
                         //   array_push($retorno["aplicacao"]["aplicacao"], $row["aplicacao"]);
                         $retorno["menuAplicacao"][] = array("aplicacao" => $row["aplicacao"]);
                        }    
                        //$_SESSION["MENU"] = $retorno["aplicacao"]; 
                        $_SESSION["MENU"] = $retorno["menuAplicacao"];
                           
                     //   print_r( $_SESSION["MENU"]);  
                         // echo json_encode($_SESSION["MENU"]);
                    }


                    
                }   else{  
                    echo "Senha do Usuario ".$retorno["nome"].", e-mail ".$email." Invalida!";
                }     
        

        
        }  
        else{  
            echo "User ".$email." Não Cadastrado";
        }   
        mysqli_close($con);

?> 