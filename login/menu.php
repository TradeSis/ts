<?php
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<!-- Webix Library -->
	<script src="/ts/js/jquery/jquery.min.js" type="text/javascript"></script>	
	<script type="text/javascript"          src="/ts/js/webix/codebase/webix.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/ts/js/webix/codebase/skins/flat.min.css">


	<!-- Design -->
	<link rel="stylesheet" type="text/css" href="/ts/login/menu.css">	
	<style>
		
	
				

	</style>
	<script type="text/javascript">
		/* MENU TS/SERVICES */

var wMenuWeb = {
  "value": "Web",
  "id" : "wMenuWeb",

  labelAlign:"right",
  config:{
    on: {
      onItemClick:function(id){
        $$("menuIframe").define("src", id);
      }
    }
  },
  "submenu": [
    { id:"/ts/tsweb/empresa.php", value: "Empresas"},
    { id:"/ts/tsweb/aplicacao.php", value: "Aplicações"},
    { id:"/ts/tsweb/aplicacaoempresa.php", value: "Apli x Empresa"},
    { id:"/ts/tsweb/cliente.php", value: "Clientes"}
    
  ]
};

var wMenuServices = {
  "value": "Services",
  "id" : "wMenuServices",

  labelAlign:"right",
  config:{
    on: {
      onItemClick:function(id){
        $$("menuIframe").define("src", id);
      }
    }
  },
  "submenu": [
    { id:"/ts/tsservices/servicos.php", value: "Serviços"}
    
  ]
};

var wMenuVision= {
  "value": "Vision",
  "id" : "wMenuVision",

  labelAlign:"right",
  config:{
    on: {
      onItemClick:function(id){
        $$("menuIframe").define("src", id);
      }
    }
  },
  "submenu": [
    { id:"/ts/tsvision/index.php", value: "Visões"}
    
  ]
};

var wmenuData = [];

var wmenuAplicacao = <?php echo json_encode($_SESSION['MENU']) ?>;


     var i = 0;
     for(i in wmenuAplicacao) {
      //	alert("CAMPO= "+JSON.stringify(wmenuAplicacao[i], null, 4));
       if (wmenuAplicacao[i]["aplicacao"]=="services") {
			wmenuData.push(wMenuServices);
	   }
	   if (wmenuAplicacao[i]["aplicacao"]=="vision") {
		
		   wmenuData.push(wMenuVision);
	   }
     
	   if (wmenuAplicacao[i]["aplicacao"]=="web") {
		       wmenuData.push(wMenuWeb);
      }

     };


var wMenu = {
  "id": "wMenu",
  "data": wmenuData,

 // "layout": "x",
  "type": {
    "subsign": true
    ,
    autowidth:true
  },
  submenuConfig:{
    autowidth:true,
    autoheight:true
},
  "view": "menu",
  css:"myCss"
  
};


var wMenuBotoes = {
  "cols": [
    {
     "label": "usuario",
      "id":"btnusuario",
      "view": "button", 
       css:"btn_fundoazul"
    },
    {
      "label": "configuração",
      "view": "button",
       css:"webix_transparent"
    },
    {
      "label": "sair",
      "view": "button",
       css:"webix_transparent",
       
       on:{
        // the default click behavior that is true for any datatable cell
        "onItemClick":function(id, e, trg){ 
			
			
            this.getTopParentView().hide(); //hide window
            <?php session_destroy(); ?>;
              window.location.href="/ts";
           
            

        }
    }}],
  
    
  
  width:300
};

var wlogo =  { view: "label", label: "", width: 160, autoheight:true, css:'app-logo' };
var wlogoempresa =  { id:"logoempresa", view: "label", label: "tt", width: 160, autoheight:true};





var wcabec =
{
  "height": 50,
  "cols": [ wlogo, wMenu  , wlogoempresa,
            
            wMenuBotoes

  ]
};

var wframe = {
  "id": "menuIframe",
  "view": "iframe", 
  "multiview": true,
  animate:{ type:"flip", subtype:"vertical" },
  "disabled": false,
  "height": 0,
  "src": "" //"/ts/tsweb/clientes.php"
};

var ui = {
  responsive:true, 
    rows:[ wcabec,
           wframe
         ]
    };

    // CHAMA WEBIX
    webix.ready(function(){

      if (webix.CustomScroll)
    		webix.CustomScroll.init();

      // SETA WEBIX PARA BR
      webix.i18n.setLocale("pt-BR");
      // ATIVA UI
      webix.ui.fullScreen();
      webix.ui(ui);
      
   
      var wempresa = "<?php print $_SESSION['EMPRESA']; ?>";
      var wusuario = "<?php print $_SESSION['USUARIO']; ?>";
     

      $$("logoempresa").define("label",wempresa);
      $$("logoempresa").refresh();
      $$("btnusuario").define("label", wusuario);
      $$("btnusuario").refresh();

      //document.getElementById("btnusuario").innerHTML = wusuario;

    });

    
    var wURL = '';

	function chamaAJAX(wURL,wtype,wdataType) {
        var res = "";
        
         $.ajax({
                url: wURL,
                type: wtype,
                async: false,

                dataType: wdataType,
              
                success: function (json_get) {

					        res = json_get;
                  
                },
                error: function (xhr, status, errorThrown) {

                    alert("errorThrown=" + errorThrown);
                }
            })
            return res;
        }
        
    
   


	</script>
	
</head>
<body></body>
</html>
