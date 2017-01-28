<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	if ( !isset( $_POST[ "Seccion" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	if ( isset( $_POST[ "SubSeccion" ] )  ) {
		$sub = $_POST[ "SubSeccion" ];
	}
	if ( isset( $_POST[ "ID" ] )  ) {
		$pro = $_POST[ "ID" ];
	}
	$seccion = $_POST[ "Seccion" ];
	
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
				window.opener.wndFind = null;
			}
		</script>
	</head>
		<?php
			if ( $sub ) echo "<body bgcolor=\"#BCD\" Style=\"color: #019\" id=\"body\" onload=\"listarArticulos('$sub',null,$pro)\">";
			else echo "<body bgcolor=\"#BCD\" Style=\"color: #019\" id=\"body\" onload=\"listar('$seccion',null,true)\">";
		?>
		<div id="pnl0">
			<div id="pnlWelcome">
				<center><h1>Kiosco de Prensa</h1></center>
			</div>
			<center><h3><div id="pnlSubTitle">
				<?php
					echo "Buscar $seccion";
				?>
			</div></h3></center><br /><br />
			<div id="pnlMain" style="float: left; width: 75%"></div>
			<div id="pnlTool" style="float: left; width: 25%"></div>
		</div>
	</body>
</html>
