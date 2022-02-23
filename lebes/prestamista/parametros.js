
// #A2 - TITULO
var wTitulo = {
          "view": "label",
          "label": "Parametros do Seguro Prestamista",
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
            "rows": [
              {
                "label": "Parametros",
                "view": "button",
                "height": 0,
                click:function(){ showForm("win1", this.$view) }
              }
            ]
          }
        ]
      };

var wDtinicial = { id:"dtinicial","view": "datepicker", "height": 0 ,
              
               stringResult:true, 	icons: true};
var wDtfinal   = { id:"dtfinal","view": "datepicker", "height": 0 ,	
               
              stringResult:true, icons: true};

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



 

 

   
    

// #B3 - TELA PRINCIPAL - GRID
var wGrid = {
      "view": "datatable",
      autoConfig:true,
      "columns": [
      {
        "id": "categoria",
        "header": "Categoria",
        "sort": "string", 
        adjust: true
      },
      {
          "id": "TpSeguro",
          "header": "Tipo Seguro",
          "sort": "string", 
          adjust: true
        },
        {
          "id": "considerarEntrada",
          "header": "considerarEntrada",
          "sort": "string", 
          adjust: true
        },
        {
          "id": "etbcod",
          "header": "Filial",
          "sort": "string", 
          adjust: true
        },

        {
          "id": "valMinParc",
          "header": "Vl Parc",
          "sort": "string", 
           adjust: true , format:webix.i18n.numberFormat
        },
        {
          "id": "qtdMinParc",
          "header": "Qt Parc",
          "sort": "string", adjust: true
        },
        {
          "id": "percentualSeguro",
          "header": "Perc Seguro",
          "sort": "string", adjust: true, format:webix.i18n.numberFormat
        },
        {
          "id": "valorPorParcela",
          "header": "Valor Por Parcela",
          "sort": "string", adjust: true, format:webix.i18n.numberFormat
        },
        {
          "id": "codigoSeguro",
          "header": "codigoSeguro",
          "sort": "string", adjust: true
            
        }
      ],
      "select": true,
      "scrollX": false,
      "id": "wGrid",
      "height": 0,
      footer:true
    };

// #B1 - TELA PRINCIPAL
var wPrincipal =
          { "id": "wPrincipal",
            "rows": [
                      wPesquisa , // #B2
                      wGrid       // #B3
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
     
      webix.ui({
        view:"popup",
        id:"win1",
        width:500,
        head:false,
        body:webix.copy(form)
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
       

       executa(periodo);
      

       
    });

    function showForm(winId, node){
      $$(winId).getBody().clear();
      $$(winId).show(node);
      $$(winId).getBody().focus();
    }


    function executa(wvar){

     //alert ("periodo selecionado: " + wvar);
      var wretorno = chamaAJAX ("http://10.2.0.233/bsweb/api/prestamista/buscaParametros");
      
      $$("wGrid").clearAll();

      $$("wGrid").parse(wretorno.parametros);

        

  }
  

  function chamaAJAX(wURL) {

    var res = "";
    
     $.ajax({
        url: wURL,
        type: "POST",
        async: false,
  
        dataType: "json",
        
        success: function (json_get) {
  
          //alert("DENTRO DO AJAX= "+JSON.stringify(json_get));
          res = json_get;	
          
        },
        error: function (xhr, status, errorThrown) {
  
          alert("errorThrown=" + errorThrown);
        }
      })
      return res;
    }
    
  
      
