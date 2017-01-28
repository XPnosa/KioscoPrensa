var wndFind;
var wndFindArt;

function listar(strSec, Nombre, Busqueda, Fecha1, Fecha2, FechaP1, FechaP2, FechaD1, FechaD2, FechaC1, FechaC2, ID) {
	
	var strSend = "";
	var bolSend = false
	
	//Filtraado
	if ( ID ) strSend += "ID=" + ID;
	
	if ( Nombre ) {
		strSend += "Nombre=" + Nombre;
		bolSend = true;
	}
	
	if ( Fecha1 && Fecha2 ) {
		if ( bolSend ) strSend += "&"
		strSend += "Fecha1=" + Fecha1 + "&Fecha2=" + Fecha2;
		bolSend = true;
	}
	
	if ( FechaP1 && FechaP2 ) {
		if ( bolSend ) strSend += "&"
		strSend += "FechaP1=" + FechaP1 + "&FechaP2=" + FechaP2;
		bolSend = true;
	}
	
	if ( FechaD1 && FechaD2 ) {
		if ( bolSend ) strSend += "&"
		strSend += "FechaD1=" + FechaD1 + "&FechaD2=" + FechaD2;
		bolSend = true;
	}
	
	if ( FechaC1 && FechaC2 ) {
		if ( bolSend ) strSend += "&"
		strSend += "FechaC1=" + FechaC1 + "&FechaC2=" + FechaC2;
		bolSend = true;
	}
	
	//Titulo
	var title;
	
	if ( strSec == "familia" ) title = "Familias";
	else if ( strSec == "articulo" ) title = "Articulos";
	else if ( strSec == "proveedor" ) title = "Proveedores";
	else if ( strSec == "deposito" ) title = "Depositos";
	else if ( strSec == "cliente" ) title = "Clientes";
	else title = "Compras";
	
	if ( !Busqueda ) document.getElementById("pnlSubTitle").innerHTML = title;
	
	//Panel Principal
	objAjaxSec = new AJAX();	
	objAjaxSec.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlMain").innerHTML = strResultado;
		}
	};
	objAjaxSec.open( 'POST', './' + strSec + '/index.php', true );
	objAjaxSec.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	if (Busqueda) objAjaxSec.send(strSend + "&Find=true");
	else objAjaxSec.send(strSend);
	
	//Panel Lateral
	objAjaxSecTool = new AJAX();	
	objAjaxSecTool.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlTool").innerHTML = strResultado;
		}
	};
	objAjaxSecTool.open( 'POST', './' + strSec + '/tool.php', true );
	objAjaxSecTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	if (Busqueda) objAjaxSecTool.send("Sec=" + strSec + "&Find=true");
	else objAjaxSecTool.send("Sec=" + strSec);
	
	mostrarAvisos();
}

function listarArticulos(strSec, Nombre, ID) {
	
	var strSend = '';
	
	//Filtraado
	if ( strSec ) strSend += "&SubSec=" + strSec;
	if ( Nombre ) strSend += "&Nombre=" + Nombre;
	if ( ID ) strSend += "&ID=" + ID;

	//Titulo
	document.getElementById("pnlSubTitle").innerHTML = 'Buscar articulo';
	
	//Panel Principal
	objAjaxSec = new AJAX();	
	objAjaxSec.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlMain").innerHTML = strResultado;
		}
	};
	objAjaxSec.open( 'POST', './articulo/index.php', true );
	objAjaxSec.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSec.send( "Find=true" + strSend );
	
	//Panel Lateral
	objAjaxSecTool = new AJAX();	
	objAjaxSecTool.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlTool").innerHTML = strResultado;
		}
	};
	objAjaxSecTool.open( 'POST', './articulo/tool.php', true );
	objAjaxSecTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSecTool.send( "Find=true" + strSend );
}

function listarArticulosCompra(ID) {
	
	//Titulo
	document.getElementById("pnlSubTitle").innerHTML = 'Compra #' + ID;
	
	//Panel Principal
	objAjaxSec = new AJAX();	
	objAjaxSec.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlMain").innerHTML = strResultado;
		}
	};
	objAjaxSec.open( 'POST', './compra/articulo/index.php', true );
	objAjaxSec.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSec.send( "ID=" + ID );
	
	//Panel Lateral
	objAjaxSecTool = new AJAX();	
	objAjaxSecTool.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlTool").innerHTML = strResultado;
		}
	};
	objAjaxSecTool.open( 'POST', './compra/articulo/tool.php', true );
	objAjaxSecTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSecTool.send( "ID=" + ID );
}

function listarArticulosDeposito(ID, State) {
	
	//Titulo
	document.getElementById("pnlSubTitle").innerHTML = 'Deposito #' + ID;
	
	//Panel Principal
	objAjaxSec = new AJAX();	
	objAjaxSec.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlMain").innerHTML = strResultado;
		}
	};
	objAjaxSec.open( 'POST', './deposito/articulo/index.php', true );
	objAjaxSec.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSec.send( "ID=" + ID + "&State=" + State );
	
	//Panel Lateral
	objAjaxSecTool = new AJAX();	
	objAjaxSecTool.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlTool").innerHTML = strResultado;
		}
	};
	objAjaxSecTool.open( 'POST', './deposito/articulo/tool.php', true );
	objAjaxSecTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxSecTool.send( "ID=" + ID + "&State=" + State );
}

function filtroFechas(campo, fecha1, fecha2){
	
	if ( campo == 'compra' ) listar('compra',null,null,fecha1,fecha2);
	if ( campo == 'pedido' ) listar('deposito',null,null,null,null,fecha1,fecha2);
	if ( campo == 'deposito' ) listar('deposito',null,null,null,null,null,null,fecha1,fecha2);
	if ( campo == 'cierre' ) listar('deposito',null,null,null,null,null,null,null,null,fecha1,fecha2);
	
	return;
	
}

function mostrarEstadisticas ( grupo, proveedor, articulo ) {
	
	var filtro = "";
	
	if ( articulo ) filtro += "&Art=" + articulo;
	if ( proveedor ) filtro += "&Pro=" + proveedor;
	
	document.getElementById("pnlSubTitle").innerHTML = 'Estadisticas';
	
	objAjaxStats = new AJAX();	
	objAjaxStats.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlMain").innerHTML = strResultado;
		}
	};
	objAjaxStats.open( 'POST', './stats/index.php', true );
	objAjaxStats.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxStats.send( "Agrupar=" + grupo + filtro );
	
	objAjaxStatsTool = new AJAX();	
	objAjaxStatsTool.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnlTool").innerHTML = strResultado;
		}
	};
	objAjaxStatsTool.open( 'POST', './stats/tool.php', true );
	objAjaxStatsTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxStatsTool.send( "Agrupar=" + grupo );
}

function buscar(Seccion, SubSeccion, ID) {
	
	if (wndFind) {
		alert('Ya tiene una ventana de busqueda abierta');
		return;
	}
	
	var strSend = "Seccion=" + Seccion;
	
	if (ID) strSend += "&ID=" + ID;
	if (SubSeccion) strSend += "&SubSeccion=" + SubSeccion;
	
	objAjaxFind = new AJAX();	
	objAjaxFind.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			wndFind = open( "", "_blank" );
			wndFind.document.open();
			wndFind.document.write(strResultado);
			wndFind.document.close();
		}
	};
	objAjaxFind.open( 'POST', './find.php', true );
	objAjaxFind.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxFind.send( strSend );
}

function buscarArticulos(Seccion, ID, State) {
	
	if (wndFindArt) {
		alert('Ya tiene una ventana de compra o deposito abieta');
		return;
	}
	
	var strSend = "Seccion=" + Seccion + "&ID=" + ID;
	if (State) strSend += "&State=" + State;
	
	objAjaxFind = new AJAX();
	objAjaxFind.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			wndFindArt = open( "", "_blank" );
			wndFindArt.document.open();
			wndFindArt.document.write(strResultado);
			wndFindArt.document.close();
		}
	};
	objAjaxFind.open( 'POST', './findArt.php', true );
	objAjaxFind.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxFind.send( strSend );
}

function seleccionar (strNombre, strSelect) {
	var idx=0;
	var objSelect = document.getElementById(strSelect);
	while (objSelect[idx].innerHTML != strNombre) idx++;
	objSelect.selectedIndex = idx++;
	wndFind.close();
	wndFind = null;
}

function redondea(sVal, nDec){ 
	var n = parseFloat(sVal); 
	var s = "0.00"; 
	if (!isNaN(n)){ 
		n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec); 
		s = String(n); 
		s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1); 
		s = s.substr(0, s.indexOf(".") + nDec + 1); 
	} 
	return s; 
} 

function AJAX() {
	if (window.XMLHttpRequest){
		return new XMLHttpRequest();
	}else if (window.ActiveXObject){
		try {
			return new ActiveXObject("MSXML2.XMLHTTP");
		}catch (e){
			try{
				return new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){}
		}
	}
	alert("No ha sido posible crear una instancia de XMLHttpRequest");
	return null;
}
