 var respuesta;
 var direccion;
 var show_map = 0;

 $(document).on("ready", function() {
 $('#MAPA_GOOGLE').hide();
 $("#full-direction").hide();
	$("#latitud").hide();
	$("#longitud").hide();
 
																$('#muestra-mapas').bind('click',function(){
																	
																	if (show_map == 0)
																	{

																		direccion = $("#calle").val()+","+$("#colonia").val()+","+$("#cp").val()+" "+$("#municipio").val();
																		console.log("DIRECCION: "+direccion);
														 			$('#MAPA_GOOGLE').show();
																		cargaValores(direccion);
																		show_map = 1;
																	}
																	else
																	{
																		$('#MAPA_GOOGLE').hide();
																		show_map = 0;
																	}


																	   
																});
												});

function cargaValores(dir){

																				var APIgoogle = "http://maps.google.com/maps/api/geocode/json?address=" + dir + "&sensor=false";

																					$.getJSON(APIgoogle, function(resultadoJSON) {
																								for (i = 0; i < resultadoJSON.results.length; i++) {
																												 respuesta = resultadoJSON.results[i];
																													
																																	$("#full-direction").html(respuesta.formatted_address);
																																	$("#latitud").html(respuesta.geometry.location.lat);
																																	$("#longitud").html(respuesta.geometry.location.lng);
																																	
																								}
																				});
																					cargaMapa(dir);
}

function cargaMapa(direccion) {

																var geoCoder = new google.maps.Geocoder(direccion)
																 var request = {address:direccion};
				 
														geoCoder.geocode(request, function(result, status){
																					var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());

																		
																					
																					var opciones = {
																						zoom: 13,
																						center: latlng,
																						mapTypeId: google.maps.MapTypeId.ROADMAP
																					};

																var mapa = new google.maps.Map(document.getElementById("mapa"), opciones);
																

																var marker2 = new google.maps.Marker({
																		draggable: true,
																		position: latlng,
																		title:respuesta.formatted_address,
																		map: mapa
																});


																var popup2 = new google.maps.InfoWindow({
																		content: document.getElementById("razon").value
																			, position: latlng ,
																			map: mapa
																});

																popup2.open(mapa, marker2);
														

																 })
												}