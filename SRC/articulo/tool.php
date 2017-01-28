<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();

	if ( isset( $_POST[ "Find" ] ) ) {
		if ( !isset( $_POST[ "SubSec" ] ) ){
			echo "<h1>Invocación incorrecta del script.</h1>";
			exit;
		}
		
		if ( isset( $_POST[ "ID" ] )  ) $deposito = $_POST[ "ID" ];
		else $deposito = 'null';
		
		$find = true;
		$ssec = $_POST[ "SubSec" ];
	}

	$sec = "articulo";

	if ( $find ){
		echo "<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schName\" /></center>
		<center><input type=\"button\" value=\"Filtrar por Nombre\" onclick=\"listarArticulos('$ssec', document.getElementById('schName').value, $deposito);\" /></center>";
	}else{
		echo "<br /><center><input type=\"button\" value=\"Nuevo $sec\" onclick=\"Art.newArt()\" /></center>
		<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schName\" /></center>
		<center><input type=\"button\" value=\"Filtrar por Nombre\" onclick=\"listar('$sec', document.getElementById('schName').value);\" /></center>";
	}
?>
