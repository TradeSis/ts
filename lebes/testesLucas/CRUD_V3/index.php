<!--#1 - Chamada html, direcionando para webix, css e jquery-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="/ts/js/jquery/jquery.min.js" type="text/javascript"></script>	
	<script type="text/javascript"          src="/ts/js/webix/codebase/webix.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/ts/js/webix/codebase/skins/flat.min.css">


	<style>
		</style>

	<script>
//#2 - Chamada do ajax!
var wURL = '';

function chamaAJAX(wURL,wType="get",wdataType="json") {
    var res = [];

    $.ajax({
			url: wURL,
			type: wType,
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

//#3 - FUNCAO clearParcelas 
let clearLogin = () => {                             //# 3- Modificação!
    webix.confirm({
        title:"All data will be lost!",
        text:"Are you sure?"
    }).then(
        () => {
            
            $$("form_login").clear();               //************************** */
            $$("form_login").clearValidation();     //************************** */
        }
)};

//#4 - FUNCAO saveTarefas 
let saveLogin = () => {                                //# 4- Modificação!
    let form = $$( "form_login" );                      //************************** */
    let list = $$( "table_login" );                     //************************** */
    let item_data = $$("form_login").getValues();     //************************** */
    
   // alert(JSON.stringify(item_data, null, 4));
   
   

    if( form.isDirty() /*&& form.validate()*/  ){
      
        if( item_data.id ) 
            list.updateItem(item_data.id, item_data);
        else 
            list.add( item_data );
    }
	$$("win_login").hide();                             //************************** */
   //alert("saveParcelas");
}

// #A2 - TITULO
var wTitulo = {
          "view": "label",
          "label": "App CRUD - V3 Login bando de dados ",
          "id": "wTitulo",
          "height": 0
        };

// #A1 - BARRA DE TAREFAS SUPERIOR
var wToolbar = {
          "id": "wToolbar",
          "height": 34,
          "view": "toolbar",
          "css": "webix_dark",
          "padding": {
            "right": 20,
            "left": 20
          },
          "elements": [
               wTitulo // #A2

          ]

        };

// #B2 - TELA PRINCIPAL - PESQUISAS
var wPesquisa = {
        "id": "wPesquisa",
        "height": 100,
        "view": "form",
        "minHeight": 380,
        "autoheight": false,
        "elements": [
          {
            "cols": [
              {
                "label": "Parametros",
                "view": "button",
                "height": 0,
                click:function(){ showForm("win1", this.$view) }
              },
			  {
                "label": "Inclusão",
                "view": "button",
				"width":120,
                "height": 0,
                click:function(){ showForm("win_login") }                         //Funcionou!
              }
            ]
          }
        ]
      };

var wDtinicial = { id:"dtinicial","view": "datepicker", "height": 0 ,
              
               stringResult:true, 	icons: true};
var wDtfinal   = { id:"dtfinal","view": "datepicker", "height": 0 ,	
               
              stringResult:true, icons: true};

/* FORMULARIO DE pesquisa */
var form = {
  id:"formulario",
  view:"form",
  autowidth:true,
  borderless:true,
  "rows": [
		{
			"height": 58,
			"cols": [ wDtinicial, wDtfinal
			]
		},
		{ view:"button", value: "Pesquisa", click:function(){
        
               
                 
                   conteudo = $$("dtinicial").getText() + " TO " + $$("dtfinal").getText();
                   alert(conteudo);
                   
                   //01/11/2021 TO 30/11/2021
                  executa(conteudo);
                  $$("win1").hide();
                }
   }
	],
  elementsConfig:{
    labelPosition:"top",
  }
};

/* DATATABLE parcelas */
const table_login = {                 //# 2- Modificação!
    view:"datatable", 
    id:"table_login",
    scroll:"y",
    select:true,
   // url:"data/data.js",
    hover:"myhover",
    save:/* "/ts/erp/testes/crud/save.php" */  "/ts/erp/testes/testesLucas/CRUD_V3/save.php", /* PHP SAVE IN MYSQL */                    //****************##########1 */

    columns:                           //# 1- Modificação!
        [
            {
              "id": "ID",                     
              "header": "ID",
              "sort": "string"
            },
            {
              "id": "username",
              "header": "Nome",
              "sort": "string"
            },
            {
              "id": "password",
              "header": "Senha",
              "sort": "string"
            },
        { header:"", template:"<span class='webix_icon wxi-close delete_icon'></span>", width:35}
		//{ template:"<input class='delbtn' type='button' value='Delete'>", width:100 }
    ],
    onClick:{
        delete_icon(e, id){
        this.remove(id);
        return false;
        }
    },
    on:{
		onItemDblClick(id, e, node) {

			/** PEGA valores do datatable */
			let values = $$("table_login").getItem(id);       //# 5- Modificação!

            //showForm("win_parcelas", this.$view);
			/** MOSTRA form_parcelas */
			  showForm("win_login");
			
			/** COLOCA valores do datatable no form_parcelas */
            $$("form_login").setValues(values);

		},
        onAfterSelect(id){
			
		   webix.message("Click on row: " + id.row+", column: " + id.column);
            	
        }
    }
}

/** FORMULARIO parcelas */
const form_login = {                                   //# 6- Modificação!
    view:"form", 
    id:"form_login", 
	autowidth:true,
  borderless:true,
 
    elements:[                                               //# 7- Modificação!
        { type:"section", template:"Edição de Terefas"},
        { view:"text", name:"ID", label:"ID", invalidMessage:"Should be between 1970 and current" },
        { view:"text", name:"username", label:"Nome", invalidMessage:"Should be between 1970 and current" },
        { view:"text", name:"password", label:"Senha", invalidMessage:"Should be between 1970 and current" },
         
        {
            margin:10, cols:[
                { view:"button", id:"btn_save", value:"Save",click:saveLogin},             //# 9- Modificação!
                { view:"button", id:"btn_clear", value:"Clear", click:clearLogin}
                
            ]
        },
        {}
    ]
}

// #B1 - TELA PRINCIPAL
var wPrincipal =
          { "id": "wPrincipal",
            "rows": [
                      wPesquisa , // #B2
                      
					  {cols: 
                        [table_login]                         //# 8- Modificação!
                      }
            ]

          };

// #C2
var wBarraEsquerda =
      {
        "view": "sidebar",
      //  "url": "demo->61b12d86b72b5e00183b15eb",
        "data": [
      		{
      			"value": "Amigos",
      			"icon": "wxi-check"
      		},
      		{
      			"value": "News",
      			"icon": "wxi-dots"
      		},
      		{
      			"value": "Photos",
      			"icon": "wxi-alert"
      		},
      		{
      			"value": "Messages",
      			"icon": "wxi-folder"
      		},
      		{
      			"value": "Settings",
      			"icon": "wxi-file"
      		}
      	],
        "width": 163,
        "id": "wFiltros"
      };

// #C3
var wBarraDireita =  {
              "id": "wBarraDireita",
              "view": "sidebar",
              collapsed:true   ,
              "data": [
            		{
            			"value": "Amigos 2",
            			"icon": "wxi-check"
            		},
            		{
            			"value": "News",
            			"icon": "wxi-dots"
            		},
            		{
            			"value": "Photos",
            			"icon": "wxi-alert"
            		},
            		{
            			"value": "Messages",
            			"icon": "wxi-folder"
            		},
            		{
            			"value": "Settings",
            			"icon": "wxi-file"
            		}
            	],
              "width": 152
            };

// #C1
var wCorpo = {
      "id": "wCorpo",
      "height": 0,
      "type": "wide",
      "cols": [
                wBarraEsquerda,      // #C2
                wPrincipal,    // #B1
                { "rows":[
                  { 
                  //  css: "menu", 
                   padding: 2, 
                    view: "form",
                    cols:[
                      { view: "button", type: "icon", icon: "bars",
                       click: function(){
                         $$("wBarraDireita").toggle();
                       }
                      }
                    ]
                  },
                wBarraDireita ]}
      ]
    };



// 1 - PRINCPAL PARTE
var ui = {
  responsive:true, 
    rows:[  wToolbar // #A1
          , wCorpo   // #C1
         ]
    };

// CHAMA WEBIX
webix.ready(function(){

if (webix.CustomScroll)
      webix.CustomScroll.init();

// SETA WEBIX PARA BR
webix.i18n.setLocale("pt-BR");
// ATIVA UI

/** CRIA WINDOW POPUP para o FORM de PESQUISA */
webix.ui({
  view:"popup",
  id:"win1",
  width:500,
  head:false,
  body:webix.copy(form)
});
 
/** CRIA WINDOW para o FORM form_parcelas */
webix.ui({                                                           //# 8- Modificação!
  view:"window",
  id:"win_login",                                       
  width:300,

      modal:true,
  position:"center",
head:false,
  body:webix.copy(form_login)
});

 webix.ui.fullScreen();
 webix.ui(ui);

 /* Inicializa form */
 var dtini = new Date();
 var dd = '01';
 var mm = String(dtini.getMonth() + 1).padStart(2, '0'); //January is 0!
 var yyyy = dtini.getFullYear();
// alert(yyyy+' '+mm+' '+dd);
 $$("dtinicial").setValue(new Date(yyyy,mm - 1,dd));
 var periodo = dd + '/' + mm + '/' + yyyy;
 var hoje = new Date();
 var dd = String(hoje.getDate()).padStart(2, '0');
 var mm = String(hoje.getMonth() + 1).padStart(2, '0'); //January is 0!
 var yyyy = hoje.getFullYear();
 $$("dtfinal").setValue(new Date(yyyy,mm - 1,dd));
 periodo += ' TO ' + dd + '/' + mm + '/' + yyyy;
 
/** Chama dados das parcelas */
 executa(periodo);


 
});

function showForm(winId, node){
$$(winId).getBody().clear();
$$(winId).show(node);
$$(winId).getBody().focus();
}


function executa(wvar){

// alert ("periodo selecionado: " + wvar);
  wJson = chamaAJAX("/ts/erp/testes/testesLucas/CRUD_v3/leitura.php");                         //# 9- Modificação! NOVA****
  
  //alert(JSON.stringify(wJson, null, 4));

  $$("table_login").clearAll();
  $$("table_login").parse(wJson.login);                                                 //Tarefas("pai")

/* AJAX WEBIX	
webix.ajax("/ts/api/dbmy/consultaParcelas", function(text,data){
      var wJson = data.json();
      $$("wGrid").clearAll();
       $$("wGrid").parse(wJson.parcelas);
 });
 */
}


  
</script>


</head>
<body></body>
</html>