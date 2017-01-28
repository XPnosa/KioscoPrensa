<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	$seccion = "stats";
	
	if ( !isset( $_POST[ 'Agrupar' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$group = $_POST[ 'Agrupar' ];
	
	$articulo = $proveedor = 1;
	
	if ( isset( $_POST[ 'Art' ] ) ) $articulo = "`A`.`Nombre` LIKE '%".$_POST[ 'Art' ]."%'";
	if ( isset( $_POST[ 'Pro' ] ) ) $proveedor = "(SELECT `Nombre` FROM `proveedor` WHERE `ID` = A.`ID_Pro` LIMIT 1) LIKE '%".$_POST[ 'Pro' ]."%'";
	
	$strQuery = "SELECT SUM(`Importe`) AS Importe FROM `deposito`;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, $seccion ) ) $gasto = $objRow->Importe;
	
	$strQuery = "SELECT SUM(`Importe`) AS Importe FROM `compra`;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, $seccion ) ) $ingreso = $objRow->Importe;
	
	echo "<center><div style='width:33%; float:left;'><b>Gastos: </b><label id='gasto'>".number_format($gasto, 2)."</label></div>";
	echo "<div style='width:33%; float:left;'><b>Ingresos: </b><label id='ingreso'>".number_format($ingreso, 2)."</label></div>";
	echo "<div style='width:33%; float:left;'><b>Beneficios: </b><label id='beneficio'>".number_format(($ingreso - $gasto), 2)."</label></div></center><br /><br />";
	
	if ( $group == 'articulo' ) {
		$strQuery = "SELECT `A`.`Nombre` AS Articulo, `A`.`PCFinal` AS PCFinal, `A`.`PVP` AS PVP, 
					(SELECT `Nombre` FROM `proveedor` WHERE `ID` = A.`ID_Pro` LIMIT 1) AS Proveedor, 
					SUM(`art_dep`.`Pedidas`) AS Pedidas, SUM(`art_dep`.`Recibidas`) AS Recibidas, 
					SUM(`art_dep`.`Vendidas`) AS Vendidas, SUM(`art_dep`.`Devolver`) AS Devueltas, 
					(SELECT MAX(`FechaPedido`) FROM `deposito` LEFT JOIN `art_dep` 
					ON (`ID` = `ID_Dep` ) WHERE `ID_Art` = A.`ID`) AS UltimoDeposito,
					(SELECT MAX(`Fecha`) FROM `compra` LEFT JOIN `art_com` 
					ON (`ID` = `ID_Com` ) WHERE `ID_Art` = A.`ID`) AS UltimaVenta
					FROM articulo A LEFT JOIN art_dep ON (`A`.`ID` = `art_dep`.`ID_Art`) 
					WHERE $articulo AND $proveedor GROUP BY `Nombre`";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		if ( !mysql_num_rows ( $query ) ) { 
			echo "No se encontraron datos."; 
			mysql_close( $db_resource );
			exit;
		}
		echo "<table border='1'>";
		if ( $_SESSION[ "BGCOLOR" ] ) echo "<thead style='background-color:#CBA'><tr>";
		else echo "<thead style='background-color:#ABC'><tr>";
		echo "<th style='width:20%'>Articulo</th>";
		echo "<th style='width:20%'>Proveedor</th>";
		echo "<th style='width:5%'>Unidades Pedidas</th>";
		echo "<th style='width:5%'>Unidades Recibidas</th>";
		echo "<th style='width:5%'>Unidades Vendidas</th>";
		echo "<th style='width:5%'>Unidades Devueltas</th>";
		echo "<th style='width:20%'>Ultimo Deposito</th>";
		echo "<th style='width:20%'>Ultima Venta</th>";
		echo "</tr></thead>";
		while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
			echo "<tr>";
			echo "<th style='cursor: pointer' onclick=\"listar('articulo','" . $objRow->Articulo . "')\">" . $objRow->Articulo . "</th>";
			echo "<th style='cursor: pointer' onclick=\"listar('proveedor','" . $objRow->Proveedor . "')\">" . $objRow->Proveedor . "</th>";
			echo "<th>" . $objRow->Pedidas . "</th>";
			echo "<th>" . $objRow->Recibidas . "</th>";
			echo "<th>" . $objRow->Vendidas . "</th>";
			echo "<th>" . $objRow->Devueltas . "</th>";
			echo "<th>" . $objRow->UltimoDeposito . "</th>";
			echo "<th>" . $objRow->UltimaVenta . "</th>";
			echo "</tr>";
		}
		echo "</table>";
	}else{ // ( group == 'proveedor' )
		$strQuery = "SELECT (SELECT `Nombre` FROM `proveedor` WHERE `ID` = A.`ID_Pro` LIMIT 1) AS Proveedor, 
					SUM(`art_dep`.`Pedidas`) AS Pedidas, SUM(`art_dep`.`Recibidas`) AS Recibidas, 
					SUM(`art_dep`.`Vendidas`) AS Vendidas, SUM(`art_dep`.`Devolver`) AS Devueltas, 
					(SELECT MAX(`FechaPedido`) FROM `deposito` WHERE `ID_Pro` = A.`ID_Pro`) AS UltimoDeposito
					FROM articulo A LEFT JOIN art_dep ON (`A`.`ID` = `art_dep`.`ID_Art`)
					WHERE $proveedor GROUP BY (SELECT `Nombre` FROM `proveedor` WHERE `ID` = A.`ID_Pro` LIMIT 1);";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		if ( !mysql_num_rows ( $query ) ) { 
			echo "No se encontraron datos."; 
			mysql_close( $db_resource );
			exit;
		}
		echo "<table border='1'>";
		if ( $_SESSION[ "BGCOLOR" ] ) echo "<thead style='background-color:#CBA'><tr>";
		else echo "<thead style='background-color:#ABC'><tr>";
		echo "<th style='width:30%'>Proveedor</th>";
		echo "<th style='width:10%'>Unidades Pedidas</th>";
		echo "<th style='width:10%'>Unidades Recibidas</th>";
		echo "<th style='width:10%'>Unidades Vendidas</th>";
		echo "<th style='width:10%'>Unidades Devueltas</th>";
		echo "<th style='width:30%'>Ultimo Deposito</th>";
		echo "</tr></thead>";
		while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
			echo "<tr>";
			echo "<th style='cursor: pointer' onclick=\"listar('proveedor','" . $objRow->Proveedor . "')\">" . $objRow->Proveedor . "</th>";
			echo "<th>" . $objRow->Pedidas . "</th>";
			echo "<th>" . $objRow->Recibidas . "</th>";
			echo "<th>" . $objRow->Vendidas . "</th>";
			echo "<th>" . $objRow->Devueltas . "</th>";
			echo "<th>" . $objRow->UltimoDeposito . "</th>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
