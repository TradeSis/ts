<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<!-- Webix Library -->
	<script type="text/javascript"          src="/ts/js/webix/codebase/webix.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/ts/js/webix/codebase/skins/flat.min.css">



	<style>
		
	
				

	</style>
	<script>
	//

var wMenuApps = {
  "value": "Prestamista",
  "id" : "wmApps",
  autowidth:true,
  labelAlign:"right",
  config:{
    autowidth:true,
    on: {
      onItemClick:function(id){
        $$("menuIframe").define("src", id);
      }
    }
  },
  "submenu": [
    { id:"/ts/erp/lebes/prestamista/parametros.php", value: "Parametros"}
  ]
};


var wMenu = {
  "id": "wMenu",
  "data":[  
            wMenuApps,
            
         ],

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
       css:"webix_transparent"
    },
    
  ],
  width:300
};
var wlogo =  { view: "label", label: "", width: 160, autoheight:true, css:'app-logo' };

var wcabec =
{
  "height": 50,
  "cols": [ wlogo, wMenu  ,
            
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
  "src": ""
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

    });

	
	
	</script>
	
</head>
<body></body>
</html>
