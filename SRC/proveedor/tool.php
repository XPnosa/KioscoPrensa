<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();

if ( !isset( $_POST[ 'Sec' ] ) ) {
	echo "<h1>Invocación incorrecta del script.</h1>";
	exit;
}

$sec = $_POST[ 'Sec' ];
if ( isset( $_POST[ "Find" ] ) ) $find = true;

if ( $find ){
	echo "<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schName\" /></center>
	<center><input type=\"button\" value=\"Filtrar por Nombre\" onclick=\"listar('$sec', document.getElementById('schName').value, true);\" /></center>";
}else{
	echo "<br /><center><input type=\"button\" value=\"Nuevo $sec\" onclick=\"Pro.newPro()\" /></center>
	<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schName\" /></center>
	<center><input type=\"button\" value=\"Filtrar por Nombre\" onclick=\"listar('$sec', document.getElementById('schName').value);\" /></center>";
}
?>
