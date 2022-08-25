$(document).ready(function (e) {
	$("#invoiceButton").on("click", function(){
		consultarFacturas();
	});
	$("#cleanInvoice").on("click", function(){
		limpiarFacturas();
	});
});


function consultarFacturas(){
	var url = "http://127.0.0.1/prueba-solati/Index/listarFacturas";

	fetch(url, {
		method: "GET"
	  }).then(function (response) {
		if (response.ok) {
		  return response.json();
		} else {
		  console.log('Respuesta de red OK pero respuesta HTTP no OK');
		  return response.json();
		}
	  }).then(function (data) {
		if(data.length > 0){
			$("#containInvoice").empty();
			data.forEach(e => {
				$("#containInvoice").append(`<div>${e.id}</div>`);
				$("#containInvoice").append(`<div>${e.descripcion}</div>`);
				$("#containInvoice").append(`<div>${e.factura}</div>`);
			});
		}
	  }).catch(function (error) {
		console.log('Hubo un problema con la petición Fetch:' + error.message);
	  });
}

function limpiarFacturas(){
	$("#containInvoice").empty();
}