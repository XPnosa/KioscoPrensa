<div>
	<div id="pnlWelcome">
		<center><h1>Kiosco de Prensa</h1></center>
	</div>
	<center><div id="pnlSubWelcome"></div></center>
	<center><h3><div id="pnlSubTitle">Bienvenido</div></h3></center><br />
	<div id="pnl1">
		<div id="pnlMenu" style="float: left; width: 75%">
			<input id="btnFam" type="button" onclick="listar(this.name);" name="familia" value="Familias" />
			<input id="btnArt" type="button" onclick="listar(this.name);" name="articulo" value="Articulos" />
			<input id="btnPro" type="button" onclick="listar(this.name);" name="proveedor" value="Proveedores"/>
			<input id="btnDep" type="button" onclick="listar(this.name);" name="deposito" value="Depositos" />
			<input id="btnCli" type="button" onclick="listar(this.name);" name="cliente" value="Clientes" />
			<input id="btnCom" type="button" onclick="listar(this.name);" name="compra" value="Compras" />
			<input id="btnSts" type="button" onclick="mostrarEstadisticas('articulo');" name="stats" value="Estadisticas" />
		</div><div id="pnlAux" >
			<center>
				<input id="btnNew" type="button" onclick="newUser();" value="Nuevo Usuario" style="display:none">
				<input id="btnOut" type="button" onclick="if( confirm( '¿Estas seguro de que quieres salir?' ) ) location.reload();" value="Desconectarse">
			</center>
		</div><br />
		<div id="pnlMain" style="float: left; width: 75%"></div>
		<div id="pnlTool" style="float: left; width: 25%"></div>
	</div>
</div>
