var wndNew;
var strOk = "aAáÁbBcCdDeEéÉfFgGhHiIíÍjJkKlLmMnNñÑoOóÓpPqQrRsStTuUúÚvVwWxXyYzZçÇ1234567890";

function filtroTeclado(evento, strValido) {
	var keyNum = ( window.event ? evento.keyCode : evento.which );
	var keyChar;
	keyChar = String.fromCharCode( keyNum );
	if ( keyNum == 13 ) return false;
	if ( keyNum == 8 || keyNum == 9 || keyNum == 16 ) return true;
	else return strValido.indexOf(keyChar) != -1;
}

function enviarDatos() {
	objAjaxLogin = new AJAX();	
	objAjaxLogin.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			if (strResultado == "") {
				login();
				mostrarAvisos();
				Dep.cerrarCaducados();
			}else{
				alert("Imposible conectar con la base de datos");
			}
		}
	};
	objAjaxLogin.open( 'POST', './login.php', true );
	objAjaxLogin.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxLogin.send( "User=" + document.getElementById( "Nick" ).value + "&Pass=" + document.getElementById( "Pass" ).value );
}

function enviarDatosVenta() {
	objAjaxLogin = new AJAX();	
	objAjaxLogin.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			if (strResultado == "") {
				loginVenta();
			}else{
				alert("Imposible conectar con la base de datos");
			}
		}
	};
	objAjaxLogin.open( 'POST', './loginVenta.php', true );
	objAjaxLogin.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxLogin.send( "User=" + document.getElementById( "Nick" ).value + "&Pass=" + document.getElementById( "Pass" ).value );
}

function login(){
	objAjaxMain = new AJAX();	
	objAjaxMain.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnl0").innerHTML = strResultado;
			document.getElementById("btnSts").click();
		}
	};
	objAjaxMain.open( 'POST', './menu.php', true );
	objAjaxMain.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxMain.send();
}

function loginVenta(){
	objAjaxMain = new AJAX();	
	objAjaxMain.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			document.getElementById("pnl0").innerHTML = strResultado;
		}
	};
	objAjaxMain.open( 'POST', './menuVenta.php', true );
	objAjaxMain.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxMain.send();
}

function cierraVenta( importe, pago ) {
	if ( !pago ) pago = 0;
	importe = parseFloat(importe);
	if ( pago < importe ) {
		alert ( 'El pago no es suficiente' );
		return;
	}
	if ( confirm( '¿Esta seguro?' ) ) {
		var strResultado = '<center><h3>';
		strResultado += document.getElementById('importe').innerHTML + " €";
		strResultado += '<br />Pagado: ' + redondea( pago, 2 ) + " €";
		strResultado += '<br />Devolver: ' + redondea ( ( pago - importe ), 2 ) + " €";
		strResultado += '<br /><br /><input type="button" value="Terminar" onclick="loginVenta();"'
		strResultado += '</h3></center>';
		document.getElementById('pnlTool').style.width = "100%"
		document.getElementById('pnlTool').innerHTML = strResultado;
		document.getElementById('pnlMain').innerHTML = "";
	}
}

function newUser(){
	if (wndNew) {
		alert('Ya tiene una ventana de nuevo usuario abierta');
		return;
	}
	
	objAjaxUser = new AJAX();	
	objAjaxUser.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			wndNew = open( "", "_blank" );
			wndNew.document.open();
			wndNew.document.write(strResultado);
			wndNew.document.close();
		}
	};
	objAjaxUser.open( 'POST', './newUser.php', true );
	objAjaxUser.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxUser.send();
}

function crearUsuario(user, pass){
	
	var pattern = /^[a-zA-Z0-9]{4,16}$/;
	
	if ( !user.match( pattern ) || !pass.match( pattern ) ) {
		alert ('Solo se permiten caracteres alfanumericos\n' + 
			   'La longitud del campo usuario debe ser de 4 a 16 caracteres\n' + 
			   'La longitud del campo contraseña debe ser de 4 a 16 caracteres');
		return;
	}
	objAjaxUser = new AJAX();	
	objAjaxUser.onreadystatechange = function() {
		var strResultado = this.responseText;
		if ( this.readyState == 4 && this.status == 200 ){
			if ( strResultado.indexOf('error') >= 0 )
				alert( 'No tienes suficientes permisos para crear un nuevo usuario.' );
			else{
				alert( 'Usuario creado con exito.' );
				opener.wndNew.close();
				opener.wndNew = null;
			}
		}
	};
	objAjaxUser.open( 'POST', './createUser.php', true );
	objAjaxUser.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
	objAjaxUser.send( 'User=' + user + "&Pass=" + pass );
}
