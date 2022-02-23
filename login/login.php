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
					//alert(location.search);	
						var warraysplit = (location.search.split('='));
						var wURLORIGEM  = warraysplit[1];
						if (!wURLORIGEM) {
							wURLORIGEM = "/ts/dashboard";
						}
						

		var form = {
			view:"form",
			borderless:true,
			elements: [
				{ view:"text", label:'Login', name:"login", id:"user" },
				{ view:"text", label:'Senha', name:"password" , id:"password",type:"password"},
				{ view:"button", value: "login", click:function(){
					if (this.getParentView().validate()){ //validate form
                      //  webix.message("All is correct");
						var wuser = $$("user").getValue();
						var wpass = $$("password").getValue();
						
						

						var wURL = "/ts/authentication.php?" + 
										"user=" + wuser + 
										"&pass=" + wpass +
										"&URL=" + wURLORIGEM;
					 		//alert(wURL);

						var wretorno = chamaAJAX (wURL);
						wretorno = wretorno.trim();
						//alert("wretorno1="+wretorno);
 					
                        if (wretorno!="OK"){
							//alert("wretorno2="+wretorno);

						    document.getElementById("container").innerHTML = wretorno;
						

                        } else {
							//alert("wretorno3="+wretorno);
							this.getTopParentView().hide(); //hide window
							//alert(wURLORIGEM);
							window.location.href=wURLORIGEM;
						};
                        
						


                        //this.getTopParentView().hide(); //hide window
                    }
					else
						webix.message({ type:"error", text:"Form data is invalid" });
				}}
			],
			rules:{
				
				"login":webix.rules.isNotEmpty
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
            head:"LOGIN NO SISTEMA",
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



		