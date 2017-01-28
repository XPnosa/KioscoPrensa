<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	if ( !isset( $_POST[ "ID" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ "ID" ];
	
	echo "<br /><center><input type='button' value='Nuevo articulo'";
	echo "onclick='Com.Art.newArtCom(\"$id\")' /></center>";
	echo "<br /><center><input type='button' value='Terminar'";
	echo "onclick='window.close()' /></center>";
?>
