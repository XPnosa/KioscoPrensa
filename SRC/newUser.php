<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Estrict//EN" "http://www.w3.org/TR/xhtml10/DTD/xhtml1-estrict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Kiosco de Prensa</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="./js/validar.js"></script>
		<script type="text/javascript" src="./js/clases.js"></script>
		<script type="text/javascript" src="./js/login.js"></script>
		<script type="text/javascript" src="./js/main.js"></script>
		<script lang="text/javascript">
			onbeforeunload = function(){
				window.opener.wndNew = null;
			}
		</script>
	</head>
		<body bgcolor="#BCD" Style="color: #019" id="body">
		<div id="pnl0">
			<div id="pnlWelcome">
				<center><h1>Kiosco de Prensa</h1></center>
			</div>
			<center><h3><div id="pnlSubTitle">Nuevo Usuario</div></h3></center><br /><br />
			<div id="pnlNew"><center>
				Usuario: <br />
				<input type="text" onkeypress="return filtroTeclado(event, strOk);" id="Nick" />
				<div id="valNick"></div><br />
				Contraseña: <br />
				<input type="password" onkeypress="return filtroTeclado(event, strOk);" id="Pass" />
				<div id="valPass"></div><br />
				<br /> <input type="button" value="Aceptar" onclick="crearUsuario(document.getElementById('Nick').value, document.getElementById('Pass').value);" id="Send" /></center>
			</div>
		</div>
	</body>
</html>

