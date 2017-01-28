<?php
session_name( "Kiosco" );
session_start();

if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Estrict//EN" "http://www.w3.org/TR/xhtml10/DTD/xhtml1-estrict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	
	<head>
		
		<title>Kiosco de Prensa</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!--[if IE]>
			<script language="javascript">
				location.href="./bad_browser.html";
			</script>
		<![endif]--> 
		
		<script type="text/javascript" src="./js/validar.js"></script>
		<script type="text/javascript" src="./js/clases.js"></script>
		<script type="text/javascript" src="./js/login.js"></script>
		<script type="text/javascript" src="./js/main.js"></script>
		<script lang="text/javascript">
			function mostrarAvisos(){
				objAjaxWarning = new AJAX();
				objAjaxWarning.onreadystatechange = function() {
					var strResultado = this.responseText;
					if ( this.readyState == 4 && this.status == 200 ){
						document.getElementById('pnlSubWelcome').innerHTML = strResultado;
						if ( strResultado == '' ) {
							document.bgColor="#BCD";
							document.getElementById('body').style.color="#019";
						}else{ 
							document.bgColor="#DCB";
							document.getElementById('body').style.color="#910";
						}
					}
				};
				objAjaxWarning.open( 'POST', './deposito/alertas.php', true );
				objAjaxWarning.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
				objAjaxWarning.send();
			}
		</script>
		
	</head>
	
	<body bgcolor="#BCD" style="color: #019" id="body">
		
		<div id="pnl0">
			<div id="pnlWelcome">
				<center><h1>Kiosco de Prensa</h1></center>
			</div><br />
			<div id="pnlLogin"><center>
				Usuario: <br />
				<input type="text" onkeypress="return filtroTeclado(event, strOk);" id="Nick" value="" />
				<div id="valNick"></div><br />
				Contraseña: <br />
				<input type="password" onkeypress="return filtroTeclado(event, strOk);" id="Pass" value="" />
				<div id="valPass"></div><br />
				<br /> <input type="button" value="Aceptar" onclick="enviarDatos();" id="Send" /></center>
			</div>
			
		</div>
		
	</body>
	
</html>
