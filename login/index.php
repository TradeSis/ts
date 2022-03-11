<?php
	if (session_status() !== PHP_SESSION_ACTIVE) {
		//session_start();
		return;
	}
	
	$wURLORIGEM = $_SESSION["URL"];
	
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="/ts/js/jquery/jquery.min.js" type="text/javascript"></script>	

	<script type="text/javascript"          src="/ts/js/webix/codebase/webix.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/ts/js/webix/codebase/skins/flat.min.css">

		
	</head>
	<body>
		

		<div id="container">    
        </div>    
	

		<script type="text/javascript" charset="utf-8">
					
		var wURLORIGEM = "<?php print $wURLORIGEM; ?>";

		var form = {
			view:"form",
			borderless:true,
			elements: [
				{ view:"text", label:'E-Mail', name:"email", id:"email" },
				{ view:"text", label:'Senha', name:"senha" , id:"senha",type:"password"},
				{ view:"button", value: "login", click:function(){
					if (this.getParentView().validate()){ //validate form
                      //  webix.message("All is correct");
						var wemail = $$("email").getValue();
						var wsenha = $$("senha").getValue();
						
						
					//	alert(wemail + "-" + wsenha);

						var wURL = "/ts/login/authentication.php?" + 
										"email=" + wemail + 
										"&senha=" + wsenha;
					// 	alert(wURL);

						var wretorno = chamaAJAX (wURL);
						wretorno = wretorno.trim();
					//	alert("wretorno1="+wretorno);
 					
                        if (wretorno!="OK"){
					//		alert("wretorno2="+wretorno);

						    document.getElementById("container").innerHTML = wretorno;
						

                        } else {
					//		alert("wretorno3="+wretorno);
							this.getTopParentView().hide(); //hide window
						//	alert(wURLORIGEM);
                            this.destructor();
							window.location.href=wURLORIGEM;
						};
                        
						


                        //this.getTopParentView().hide(); //hide window
                    }
					else
						webix.message({ type:"error", text:"Form data is invalid" });
				}}
			],
			rules:{
				
				"email":webix.rules.isNotEmpty
			},
			elementsConfig:{
				labelPosition:"top",
			}
		};

        webix.ui({
            view:"window",
            id:"win2",
            width:300,
            position:"center",
            modal:true,
            head:"Informe seus dados!!!",
            body:webix.copy(form)
        }).show();


		var wURL = '';

function chamaAJAX(wURL) {

	var res = "";
	
	 $.ajax({
			url: wURL,
			type: "get",
			async: false,

			dataType: "text",
		  
			success: function (text_get) {

			
				res = text_get;	
				
			},
			error: function (xhr, status, errorThrown) {

				alert("errorThrown=" + errorThrown);
			}
		})
		return res;
	}
	
	



		</script>
	</body>
</html>



		