<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>
<?php
	if ( !isset( $_POST[ 'Sec' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	$sec = $_POST[ 'Sec' ];
?>

<br /><center><input type="button" value="Nuevo <?php echo $sec; ?>" onclick="Dep.newDep()" /></center>
<br /><center><input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate1" style="width: 100px" />
<input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate2" style="width: 100px" /></center>
<center><input type="button" value="Filtrar por Fecha de pedido" onclick="validaFechas(document.getElementById('schDate1').value, document.getElementById('schDate2').value, 'pedido');" /></center>
<br /><center><input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate3" style="width: 100px" />
<input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate4" style="width: 100px" /></center>
<center><input type="button" value="Filtrar por Fecha de deposito" onclick="validaFechas(document.getElementById('schDate3').value, document.getElementById('schDate4').value, 'deposito');" /></center>
<br /><center><input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate5" style="width: 100px" />
<input type="text" value="YYYY-MM-DD" onfocus="this.value=''" onkeypress="return filtroTeclado(event, '0123456789-');" id="schDate6" style="width: 100px" /></center>
<center><input type="button" value="Filtrar por Fecha de cierre" onclick="validaFechas(document.getElementById('schDate5').value, document.getElementById('schDate6').value, 'cierre');" /></center>
