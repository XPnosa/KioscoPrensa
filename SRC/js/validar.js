function Validacion(clase){
	
	this.valArticulo = function( idxArticulo ) {
		var label = document.getElementById("valArticulo");
		if ( idxArticulo > 0 ) clase.articuloOk();
		else clase.bolArticulo = false;
		this.formPedidasOk();
	}
	
	this.valFamilia = function( idxFamilia ) {
		var label = document.getElementById("valFamilia");
		if ( idxFamilia > 0 ) clase.familiaOk();
		else clase.bolFamilia = false;
		this.formOk();		
	}
	
	this.valProveedor = function( idxProveedor ) {
		var label = document.getElementById("valProveedor");
		if ( idxProveedor > 0 ) clase.proveedorOk();
		else clase.bolProveedor = false;
		this.formOk();
	}
	
	this.valCliente = function( idxCliente ) {
		var label = document.getElementById("valCliente");
		if ( idxCliente > 0 ) clase.clienteOk();
		else clase.bolCliente = false;
		this.formOk();
	}
	
	this.valNombre = function( strNombre ) {
		var label = document.getElementById("valNombre");
		if ( strNombre.length >= 5 && strNombre.length <= 50 ) {
			clase.nombreOk();
			label.innerHTML = "";
		}else{
			clase.bolNombre = false;
			label.style.color = "red";
			label.innerHTML = "Nombre No Valido (5-50 Caracteres)";
		}
		this.formOk();
	}
	
	this.valIVA = function( strIVA ) {
		var label = document.getElementById("valIVA");
		if ( strIVA.length > 0 && strIVA >= 0 && strIVA <= 99 ) {
			clase.iVAOk();
			label.innerHTML = "";
		}else{ 
			clase.bolIVA = false;
			label.style.color = "red";
			label.innerHTML = "IVA No Valido (0-99)";
		}
		this.formOk();
	}
	
	this.valRecEq = function( strRecEq ) {
		var label = document.getElementById("valRecEq");
		if ( strRecEq.length > 0 && strRecEq >= 0 && strRecEq <= 99 ) {
			clase.recEqOk();
			label.innerHTML = "";
		}else{ 
			clase.bolRecEq = false;
			label.style.color = "red";
			label.innerHTML = "Recargo Eq. No Valido (0-99)";
		}
		this.formOk();
	}
	
	this.valPCBase = function( strPCBase ) {
		var label = document.getElementById("valPCBase");
		if ( strPCBase.length > 0 && strPCBase >= 0 ) {
			clase.pCBaseOk();
			label.innerHTML = "";
		}else{
			clase.bolPCBase = false;
			label.style.color = "red";
			label.innerHTML = "Precio Compra No Valido";
		}
		this.formOk();
	}
	
	this.valPVP = function( strPVP ) {
		var label = document.getElementById("valPVP");
		if ( strPVP.length > 0 && strPVP >= 0 ) {
			clase.pVPOk();
			label.innerHTML = "";
		}else{ 
			clase.bolPVP = false;
			label.style.color = "red";
			label.innerHTML = "Precio Venta No Valido";
		}
		this.formOk();
	}
	
	this.valDNI = function( strDNI ) {
		var label = document.getElementById("valDNI");
		var pattern = /[0-9]{8}[A-Z]{1}/;
		if ( strDNI.length == 9 && strDNI.match( pattern ) ) {
			clase.dNIOk();
			label.innerHTML = "";
		}else{
			clase.bolDNI = false;
			label.style.color = "red";
			label.innerHTML = "DNI No Valido (Formato: 00000000L)";
		}
		this.formOk();
	}
	
	this.valCIF = function( strCIF ) {
		var label = document.getElementById("valCIF");
		var pattern = /[A-Z]{1}[0-9]{8}/;
		if ( strCIF.length == 9 && strCIF.match( pattern ) ) {
			clase.cIFOk();
			label.innerHTML = "";
		}else{
			clase.bolCIF = false;
			label.style.color = "red";
			label.innerHTML = "CIF No Valido (Formato: L00000000)";
		}
		this.formOk();
	}
	
	this.valDireccion = function( strDireccion ) {
		var label = document.getElementById("valDireccion");
		if ( strDireccion.length <= 50 ) {
			clase.direccionOk();
			label.innerHTML = "";
		}else{
			clase.bolDireccion = false;
			label.style.color = "red";
			label.innerHTML = "Direccion No Valida (0-50 Caracteres)";
		}
		this.formOk();
	}
	
	this.valTelefono = function( strTelefono ) {
		var label = document.getElementById("valTelefono");
		if ( strTelefono.length <= 9 ) {
			clase.telefonoOk();
			label.innerHTML = "";
		}else{ 
			clase.bolTelefono = false;
			label.style.color = "red";
			label.innerHTML = "Telefono No Valido (0-9 Numeros)";
		}
		this.formOk();
	}
	
	this.valMail = function( strMail ) {
		var label = document.getElementById("valMail");
		var pattern = /^[a-z0-9_\.-]{2,}[@]{1}[a-z0-9_-]{2,}[.]{1}[a-z0-9_-]{2,}$/;
		if ( strMail.length == 0 || ( strMail.length <= 50 && strMail.match( pattern ) ) ) {
			clase.mailOk();
			label.innerHTML = "";
		}else{ 
			clase.bolMail = false;
			label.style.color = "red";
			label.innerHTML = "Mail No Valido";
		}
		this.formOk();
	}
	
	this.valComentario = function( strComentario ) {
		var label = document.getElementById("valComentario");
		if ( strComentario.length <= 100 ) {
			label.innerHTML = "";
			clase.comentarioOk();
		}else{ 
			clase.bolComentario = false;
			label.style.color = "red";
			label.innerHTML = "Comentario No Valido (0-100 Caracteres)";
		}
		this.formOk();
	}
	
	this.valPedidas = function( strPedidas ) {
		var label = document.getElementById("valPedidas");
		if ( strPedidas.length > 0 && strPedidas > 0 ) {
			clase.pedidasOk();
			label.innerHTML = "";
		}else{ 
			clase.bolPedidas = false;
			label.style.color = "red";
			label.innerHTML = "Debe especificar una cantidad de unidades";
		}
		this.formPedidasOk();
	}
	
	this.valRecibidas = function( strRecibidas ) {
		var label = document.getElementById("valRecibidas");
		if ( strRecibidas.length > 0 && strRecibidas >= 0 ) {
			clase.recibidasOk();
			label.innerHTML = "";
		}else{ 
			clase.bolRecibidas = false;
			label.style.color = "red";
			label.innerHTML = "Debe especificar una cantidad de unidades";
		}
		this.formRecibidasOk();
	}
	
	this.formOk = function() {
		if ( clase.isCorrect() ) document.getElementById("btnOk").disabled = false;
		else document.getElementById("btnOk").disabled = true;
	}
	
	this.formPedidasOk = function() {
		if ( clase.pedidasIsCorrect() ) document.getElementById("btnOk").disabled = false;
		else document.getElementById("btnOk").disabled = true;
	}
	
	this.formRecibidasOk = function() {
		if ( clase.recibidasIsCorrect() ) document.getElementById("btnOk").disabled = false;
		else document.getElementById("btnOk").disabled = true;
	}
	
}

function validaFechas(fecha1, fecha2, campo){
	
	var bolFecha1 = fechaValida( fecha1 );
	var bolFecha2 = fechaValida( fecha2 );
	
	if ( bolFecha1 && bolFecha2 ) {
		
		//Fechas Validas
		var mayor, menor;
		
		if ( fecha1 > fecha2 ) {
			mayor = fecha1 + " 23:59:59";
			menor = fecha2;
		}else{
			menor = fecha1;
			mayor = fecha2 + " 23:59:59";;
		}
		
		//Filtrar datos
		filtroFechas( campo, menor, mayor );
		
		return;
	}
	
	alert('Fechas no validas');
	return;
	
}

function validaUnidades( boton ){
	var articulo = document.getElementById('id').value;
	var unidades = document.getElementById('txtPedidas').value;
	if ( unidades < 0 || !unidades || articulo < 0 || !articulo ) boton.disabled=true;
	else boton.disabled=false;
}

function fechaValida( fecha ) {
	
	var pattern = /[0-9]{4}-[0-9]{2}-[0-9]{2}/;
	
	if ( fecha.match(pattern) ) {
		
		//Formato Valido
		var date = fecha.split( '-' );

		if ( date[0] >= 1900 && date[0] <= 2100 ){
			
			//Año Valido
			var bisiesto = ( date[0]%4 == 0) && ( ( date[0]%100 != 0 ) || ( date[0]%400 == 0 ) );

			if ( date[1] == 2 ){
				
				//Mes de Febrero
				if ( date[2] >= 1 && ( ( bisiesto && date[2] <= 29 ) || ( !bisiesto && date[2] <= 28 ) ) ) {
					
					//Dia Valido 
					return true;
				}
				
			}else if ( date[1] == 4 || date[1] == 6 || date[1] == 9 || date[1] == 11 ){
				
				//Mes de 30 dias
					if ( date[2] >= 1 && date[2] <= 30 ) {
					
					//Dia Valido 
					return true;
				}
				
			}else if ( date[1] >= 1 && date[1] <= 12) {
				
				//Mes de 31 dias
				if ( date[2] >= 1 && date[2] <= 31 ) {
					
					//Dia Valido 
					return true;
				}
				
			}
			
		} 
		
	}
	
	return false;
	
}
