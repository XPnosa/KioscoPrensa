<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	if ( !isset( $_POST[ "ID" ] ) || !isset( $_POST[ "State" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ "ID" ];
	$estado = $_POST[ "State" ];
	
	if ( $estado == 0 ) {
		echo "<br /><center><input type='button' value='Nuevo articulo'";
		echo "onclick='Dep.Art.newArtDep(\"$id\")' /></center>";
		echo "<br /><center><input type='button' value='Marcar como pedido'";
		echo "onclick='Dep.marcarPedido(\"$id\")' /></center>";
	}else if ( $estado == 1 ) {
		echo "<center>Fecha de Cierre</center>";
		echo "<center><input type=\"text\" value=\"YYYY-MM-DD\" onchange='document.getElementById(\"check\").checked=false' onfocus=\"this.value=''\" onkeypress=\"return filtroTeclado(event, '0123456789-');\" id=\"schDate\" style=\"width: 100px\" /></center>";
		echo "<center>Sin Cierre <input type=\"checkbox\" id='check' onchange='document.getElementById(\"schDate\").value=\"\"'/><br />";
		echo "<center><input type='button' value='Marcar como recibido'";
		echo "onclick='Dep.marcarRecibido(\"$id\", document.getElementById(\"schDate\"), document.getElementById(\"check\"))' /></center>";
	}else if ( $estado == 2 ) {
		echo "<br /><center><input type='button' value='Marcar como cerrado'";
		echo "onclick='Dep.marcarCerrado(\"$id\")' /></center>";
	}
	echo "<br /><center><input type='button' value='Terminar'";
	echo "onclick='window.close()' /></center>";
?>
