<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	if ( isset( $_POST[ "Find" ] ) ) $find = true;
	
	if ( !isset( $_POST[ "Nombre" ] ) ) {
		$nombre = "";
	}else{
		$nombre = $_POST[ "Nombre" ];
	}
	
	$seccion = "cliente";
	
	$strQuery = "SELECT * FROM `cliente` WHERE `Nombre` LIKE '%$nombre%' ORDER BY `ID` DESC LIMIT 10;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo "No se encontraron datos."; 
		mysql_close( $db_resource );
		exit;
	}
	echo "<table border='1'>";
	if ( $_SESSION[ "BGCOLOR" ] && !$find ) echo "<thead style='background-color:#CBA'><tr>";
	else echo "<thead style='background-color:#ABC'><tr>";
	echo "<th style='width:5%'>ID</th>";
	echo "<th style='width:10%'>DNI</th>";
	echo "<th style='width:20%'>Nombre</th>";
	echo "<th style='width:20%'>Direccion</th>";
	echo "<th style='width:10%'>Telefono</th>";
	echo "<th style='width:20%'>Mail</th>";
	echo "<th style='width:15%'>Comentario</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
		echo "<tr>";
		echo "<th>" . $objRow->ID . "</th>";
		echo "<th>" . $objRow->DNI . "</th>";
		echo "<th>" . $objRow->Nombre . "</th>";
		echo "<th>" . $objRow->Direccion . "</th>";
		echo "<th>" . $objRow->Telefono . "</th>";
		echo "<th>" . $objRow->Mail . "</th>";
		echo "<th>" . $objRow->Comentario . "</th>";
		if ( $find ) {
			echo "<th><img style='cursor: pointer' src='./img/plus.gif' onclick=\"window.opener.seleccionar('".$objRow->Nombre."','slcCliente')\" ></img></th>";
		}else{
			echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Cli.editCli('".$objRow->ID."')\" ></img></th>";
			echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Cli.delCli('".$objRow->ID."')\" ></img></th>";
		}
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
