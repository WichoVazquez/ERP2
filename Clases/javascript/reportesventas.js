  google.load('visualization', '1.1', {packages: ['corechart', 'controls']});
  google.setOnLoadCallback(drawVisualization);
    //  google.setOnLoadCallback(drawChart);



$(function() {
$("#chart").hide();
$("#control").hide();
	$("#busy-state").hide();
  $("#reporte_general").hide();
	//

	$("#filter-mes").hide();
	$("#label-fmes").hide();
	$("#filter-ano").hide();
	$("#label-fano").hide();
	$("#filter-mes-nuevo").hide();
	$("#label-fmes-nuevo").hide();
	$("#filter-ano-nuevo").hide();
	$("#label-fano-nuevo").hide();

  $("#Mostrar_Vendedores").show();
  $("#Mostrar_Productos").show();
  $("#Mostrar_Servicios").show();


	//

	$("#buscar" )
      .button()
      .click(function() {
      	reporte_google(1);
       // $("#reporte_general").show();

		/*}*/	
      });
});// JavaScript Document


function Pagina(nropagina){
  ajax=objetoAjax();
  var bus=document.getElementById("search").value;  
  document.getElementById("sentencias").innerHTML="cargando...";  
  ajax.onreadystatechange=function()
    {
      if (ajax.readyState==4 && ajax.status==200)
      {
        
        document.getElementById("sentencias").innerHTML=ajax.responseText;
      }
    }
  ajax.open("POST","../Clases/Ajax/busquedacliente.php",true);
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("search="+bus+"&pag="+nropagina);
}

function objetoAjax(){
 if (window.XMLHttpRequest)
    {
    // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else
    {
    // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  return xmlhttp;
}



function drawVisualization() {
        var dashboard = new google.visualization.Dashboard(
             document.getElementById('dashboard'));
      
         var control = new google.visualization.ControlWrapper({
           'controlType': 'ChartRangeFilter',
           'containerId': 'control',
           'options': {
             // Filter by the date axis.
             'filterColumnIndex': 0,
             'ui': {
               'chartType': 'LineChart',
               'chartOptions': {
                 'chartArea': {'width': '90%'},
                 'hAxis': {'baselineColor': 'none'}
               },
               // Display a single series that shows the closing value of the stock.
               // Thus, this view has two columns: the date (axis) and the stock value (line series).
               'chartView': {
                 'columns': [0, 3]
               },
               // 1 day in milliseconds = 24 * 60 * 60 * 1000 = 86,400,000
               'minRangeSize': 86400000
             }
           }
         });
      
         var chart = new google.visualization.ChartWrapper({
           'chartType': 'ColumnChart',
           'containerId': 'chart',
           'options': {
             // Use the same chart area width as the control for axis alignment.
             'chartArea': {'height': '80%', 'width': '90%'},
             'hAxis': {'slantedText': false},
             'vAxis': {'viewWindow': {'min': 0, 'max': 2000}},
             'legend': {'position': 'none'}
           },
           // Convert the first column from 'date' to 'string'.
           'view': {
             'columns': [
               {
                 'calc': function(dataTable, rowIndex) {
                   return dataTable.getFormattedValue(rowIndex, 0);
                 },
                 'type': 'string' },
                  1,
                   2,
                    3,
                    4                    ]
           }
         });
      
         var data = new google.visualization.DataTable();
         data.addColumn('date', 'Date');
         data.addColumn('number', 'Cotizaciones');
         data.addColumn('number', 'Pedidos');
         data.addColumn('number', 'Guías Entregadas');
         data.addColumn('number', 'Facturación');
     
      
         // Create random stock values, just like it works in reality.
         var open, close = 300;
         var low, high;

         for (var day = 1; day < 121; ++day) {



           var change = (Math.sin(day / 2.5 + Math.PI) + Math.sin(day / 3) - Math.cos(day * 0.7)) * 150;
           change = change >= 0 ? change + 10 : change - 10;
           open = close;
           close = Math.max(50, open + change);
           low = Math.min(open, close) - (Math.cos(day * 1.7) + 1) * 15;
           low = Math.max(0, low);
           high = Math.max(open, close) + (Math.cos(day * 1.3) + 1) * 15;


           var date = new Date(2014, 0 ,day);

           data.addRow([date, Math.round(low), Math.round(open), Math.round(close), Math.round(high)]);
         }
      
         dashboard.bind(control, chart);
         dashboard.draw(data);
      }
      

   



function cambiarCriterio(id)
{
	estado=$("#filter-criterio").val();	
	
	$("#filter-mes").hide();
	$("#label-fmes").hide();
	$("#filter-ano").hide();
	$("#label-fano").hide();
	$("#datepicker").hide();
	$("#label-date1").hide();
	$("#datepicker2").hide();
	$("#label-date2").hide();

	$("#filter-mes-nuevo").hide();
	$("#label-fmes-nuevo").hide();
	$("#filter-ano-nuevo").hide();
	$("#label-fano-nuevo").hide();

	switch(estado)
	{
		case "0": $("#datepicker").show();
				$("#label-date1").show();
				$("#datepicker2").show();
				$("#label-date2").show();
				break;
		case "1": $("#filter-mes").show();
				$("#label-fmes").show();
				$("#filter-ano").show();
				$("#label-fano").show();
				$("#filter-mes-nuevo").show();
				$("#label-fmes-nuevo").show();
				$("#filter-ano-nuevo").show();
				$("#label-fano-nuevo").show();


				break;
		case "2": 

				break;
		
	}
}

function reporte_google(id)
{
	var arr;
	var get;

	switch( $("#filter-criterio").val())
	{
		case "0":
					//arr={criterio:$("#filter-criterio").val(), status: $("#filter-status").val(), fecha: $("#datepicker").val()};
					get="criterio="+$("#filter-criterio").val()+"&status="+$("#filter-status").val()+"&fecha="+$("#datepicker").val();
					break;

		case "1":	//arr={criterio:$("#filter-criterio").val(), status: $("#filter-status").val(), fecha1: $("#datepicker").val(), fecha2: $("#datepicker2").val() };
					get="criterio="+$("#filter-criterio").val()+"&status="+$("#filter-status").val()+"fecha1="+$("#datepicker").val();
					break;
		case "2":	get="criterio="+$("#filter-criterio").val()+"&status="+$("#filter-status").val()+"&mes="+$("#filter-mes").val()+"&ano="+$("#filter-ano").val();
					//arr={criterio:$("#filter-criterio").val(), status: $("#filter-status").val(), mes: $("#filter-mes").val(), ano: $("#filter-ano").val() };
					break;
					

	}
var fehcaI=$("#datepicker").val();
var fechaFin=$("#datepicker2").val();

/*
     $('<iframe id="sitedel" src="reporte_ventas.php?fecha1='+fehcaI+'&fecha2='+fechaFin+'"/>').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
        beforeClose:function(e, m) {
                    Pagina(1);
        },
        
        position: {
          my: "center center",
          at: "center center",
          of: window
        },
                autoOpen: true,
                width: 750, 
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
          
                    background: "white",
          
                }
        
            }).width(700).height(650).css("background", "#ffffff");
*/
	
	drawVisualization();

	$("#chart").show();
  $("#control").show();

			
}

function showResultCliente(str)
{
 $('#usuario').val();
if(str.length==0)
{
	document.getElementById('livecliente').innerHTML="";
    document.getElementById("livecliente").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livecliente").innerHTML=xmlhttp.responseText;
    document.getElementById("livecliente").style.border="1px solid #A5ACB2";
    }
  }

xmlhttp.open("POST","../Clases/Ajax/selectcliente_id_todos.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("cliente="+str+"&usuario="+$('#usuario').val());  

}
}

function showResultVendedor(str)
{
if(str.length==0)
{
	document.getElementById('livevendedor').innerHTML="";
    document.getElementById("livevendedor").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livevendedor").innerHTML=xmlhttp.responseText;
    document.getElementById("livevendedor").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("POST","../Clases/Ajax/selectvendedor_id_todos.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("vendedor="+str);  
}
}


function ponerValorCliente(str){
  document.getElementById('cliente').value=str.desc;
  document.getElementById('cliente').title=str.id;
  document.getElementById('cliente').setAttribute("idcliente",str.id);
  document.getElementById('livecliente').innerHTML="";
  document.getElementById("livecliente").style.border="0px";
  console.log('$( "#cliente" ).attr("idcliente")');
 
}


function ponerValorVendedor(str){
  document.getElementById('vendedor').value=str.desc;
  //$("#producto").attr("idproducto", str.id);
  document.getElementById('vendedor').setAttribute("idvendedor", str.id);
  //$("#cantidad").attr("disabled", "enabled");
  document.getElementById('livevendedor').innerHTML="";
  document.getElementById("livevendedor").style.border="0px";

  
}


function activatePanelTotallity(checkbocs)
{
  
  if(checkbocs.id=="epv_check")
    if(checkbocs.checked)
    $('#Mostrar_Vendedores').show();
    else
    $('#Mostrar_Vendedores').hide();
  


  if(checkbocs.id=="mat_check")
    if(checkbocs.checked)
    $('#Mostrar_Productos').show();
  else
    $('#Mostrar_Productos').hide();
  

    if(checkbocs.id=="ser_check")
  if(checkbocs.checked)
    $('#Mostrar_Servicios').show();
  
  else
  
    $('#Mostrar_Servicios').hide();
  


}


