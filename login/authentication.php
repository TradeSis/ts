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

    //   echo "email=".$email."\n";
    //   echo "password=".$password."\n";
    //   echo $URL;


        $query = "select * from usuario where email = '$email'";  

        $result = mysqli_query($con,$query);
     //   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        $retorno = [];
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                    $retorno = $row;
          }
        }
       // var_dump($retorno);

        mysqli_close($con);


          
        if($count == 1){  
                if (MD5($senha)==$retorno["senha"]){
                    echo "OK";
                 
                   $_SESSION["EMAIL"]   = $retorno["email"];
                   $_SESSION["EMPRESA"] = $retorno["empresa"];
                   $_SESSION["USUARIO"] = $retorno["nome"];


                    
                }   else{  
                    echo "Senha do Usuario ".$retorno["nome"].", e-mail ".$email." Invalida!";
                }     
        

        
        }  
        else{  
            echo "User ".$email." Não Cadastrado";
        }     
?> 