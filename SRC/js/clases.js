function Familia(){
	
	this.className = "Familia";
	this.bolNombre = false;
	this.bolIVA = false;
	this.bolRecEq = false;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	
	this.nombreOk = function () {
		return this.bolNombre = true;
	}
	
	this.iVAOk = function () {
		return this.bolIVA = true;
	}
	
	this.recEqOk = function () {
		return this.bolRecEq = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolNombre && this.bolIVA && this.bolRecEq && this.bolComentario );
	}
	
	this.newFam = function() {
		var familia = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				familia.bolNombre = false;
				familia.bolIVA = false;
				familia.bolRecEq = false;
				familia.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './familia/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.editFam = function( ID ) {
		var familia = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				familia.bolNombre = true;
				familia.bolIVA = true;
				familia.bolRecEq = true;
				familia.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './familia/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.delFam = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar esta familia?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse esta familia porque \nesta referenciada en uno o varios articulos.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('familia');
				}
			};
			objAjaxDel.open( 'POST', './familia/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.regFam = function() {
		var Nombre = document.getElementById("txtNombre").value;
		var IVA = document.getElementById("txtIVA").value;
		var RecEq = document.getElementById("txtRecEq").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('familia');
			}
		};
		objAjaxReg.open( 'POST', './familia/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Nombre=" + Nombre + "&IVA=" + IVA + "&RecEq=" + RecEq + "&Comentario=" + Comentario );
	}
	
	this.updFam = function( ID ) {
		var Nombre = document.getElementById("txtNombre").value;
		var IVA = document.getElementById("txtIVA").value;
		var RecEq = document.getElementById("txtRecEq").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') > 0 )
					alert( strResultado );
				else
					listar('familia');
			}
		};
		objAjaxUpd.open( 'POST', './familia/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&Nombre=" + Nombre + "&IVA=" + IVA + "&RecEq=" + RecEq + "&Comentario=" + Comentario );
	}
	
}

function Articulo(){
	
	this.className = "Articulo";
	this.bolNombre = false;
	this.bolArticulo = false;
	this.bolFamilia = false;
	this.bolProveedor = false;
	this.bolPCBase = false;
	this.bolPVP = false;
	this.bolPedidas = false;
	this.bolRecibidas = false;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	
	this.nombreOk = function () {
		return this.bolNombre = true;
	}
	
	this.articuloOk = function () {
		return this.bolArticulo = true;
	}
	
	this.familiaOk = function () {
		return this.bolFamilia = true;
	}
	
	this.proveedorOk = function () {
		return this.bolProveedor = true;
	}
	
	this.pCBaseOk = function () {
		return this.bolPCBase = true;
	}
	
	this.pVPOk = function () {
		return this.bolPVP = true;
	}
	
	this.pedidasOk = function () {
		return this.bolPedidas = true;
	}
	
	this.recibidasOk = function () {
		return this.bolRecibidas = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolNombre && this.bolFamilia && this.bolProveedor && this.bolPCBase && this.bolPVP && this.bolComentario );
	}
	
	this.pedidasIsCorrect = function() {
		return ( this.bolArticulo && this.bolPedidas );
	}
	
	this.recibidasIsCorrect = function() {
		return ( this.bolRecibidas );
	}
	
	this.getName = function( ID ) {
		objAjaxGetName = new AJAX();	
		objAjaxGetName.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				document.getElementById("nombre").innerHTML = " " + strResultado;
			}
		};
		objAjaxGetName.open( 'POST', './venta/getName.php', true );
		objAjaxGetName.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxGetName.send( "ID=" + ID );
	}
	
	this.newArt = function() {
		var articulo = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolNombre = false;
				articulo.bolFamilia = false;
				articulo.bolProveedor= false;
				articulo.bolPCBase = false;
				articulo.bolPVP = false;
				articulo.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './articulo/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.newArtDep = function( ID_Dep ) {
		var articulo = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolArticulo = false;
				articulo.bolPedidas = false;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './deposito/articulo/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send( "ID_Dep=" + ID_Dep );
	}
	
	this.newArtCom = function( ID_Com ) {
		var articulo = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolArticulo = false;
				articulo.bolPedidas = false;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './compra/articulo/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send( "ID_Com=" + ID_Com );
	}
	
	this.editArt = function( ID ) {
		var articulo = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolNombre = true;
				articulo.bolFamilia = true;
				articulo.bolProveedor= true;
				articulo.bolPCBase = true;
				articulo.bolPVP = true;
				articulo.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './articulo/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.editArtDep = function( ID_Dep, ID_Art, Estado ) {
		var articulo = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolArticulo = true;
				articulo.bolPedidas = true;
				articulo.bolRecibidas = false;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './deposito/articulo/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID_Dep=" + ID_Dep + "&ID_Art=" + ID_Art + "&Estado=" + Estado );
	}
	
	this.editArtCom = function( ID_Com, ID_Art, Unidades ) {
		var articulo = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				articulo.bolArticulo = true;
				articulo.bolPedidas = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './compra/articulo/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID_Com=" + ID_Com + "&ID_Art=" + ID_Art + "&Unidades=" + Unidades );
	}
	
	this.delArt = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este articulo?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse este articulo porque \nesta referenciado en alguna compra o deposito.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('articulo');
				}
			};
			objAjaxDel.open( 'POST', './articulo/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.delArtDep = function( ID_Dep, ID_Art ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este articulo?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listarArticulosDeposito( ID_Dep, 0 );
				}
			};
			objAjaxDel.open( 'POST', './deposito/articulo/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "Articulo=" + ID_Art + "&Deposito=" + ID_Dep );
		}
	}
	
	this.delArtCom = function( ID_Com, ID_Art, Unidades ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este articulo?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else if ( strResultado.indexOf('Y') >= 0 )
						alert( 'No puede devolverse ese producto' );
					else{
						listarArticulosCompra( ID_Com );
						opener.listar('compra');
					}
				}
			};
			objAjaxDel.open( 'POST', './compra/articulo/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "Articulo=" + ID_Art + "&Compra=" + ID_Com + "&Unidades=" + Unidades );
		}
	}
	
	this.regArt = function() {
		var Nombre = document.getElementById("txtNombre").value;
		var Familia = document.getElementById("slcFamilia").value;
		var Proveedor = document.getElementById("slcProveedor").value;
		var PCBase = document.getElementById("txtPCBase").value;
		var PVP = document.getElementById("txtPVP").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else if ( strResultado.indexOf('warning') >= 0 ) 
					alert( 'El precio de compra final es \nmayor que el precio de venta' );
				else
					listar('articulo');
			}
		};
		objAjaxReg.open( 'POST', './articulo/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Nombre=" + Nombre + "&Familia=" + Familia + "&Proveedor=" + Proveedor + "&PCBase=" + PCBase + "&PVP=" + PVP + "&Comentario=" + Comentario );
	}
	
	this.regArtDep = function( ID_Dep ) {
		var Articulo = document.getElementById("slcArticulo").value;
		var Pedidas = document.getElementById("txtPedidas").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listarArticulosDeposito( ID_Dep, 0 );
			}
		};
		objAjaxReg.open( 'POST', './deposito/articulo/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Articulo=" + Articulo + "&Pedidas=" + Pedidas + "&Deposito=" + ID_Dep );
	}
	
	this.regArtCom = function( ID_Com ) {
		var Articulo = document.getElementById("slcArticulo").value;
		var Pedidas = document.getElementById("txtPedidas").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else if ( strResultado.indexOf('X') >= 0 )
					alert( 'No hay suficiente stock de ese producto' );
				else if ( strResultado.indexOf('Y') >= 0 )
					alert( 'Ese Articulo ya esta en la lista de compra' );
				else{
					listarArticulosCompra( ID_Com );
					opener.listar('compra');
				}
			}
		};
		objAjaxReg.open( 'POST', './compra/articulo/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Articulo=" + Articulo + "&Pedidas=" + Pedidas + "&Compra=" + ID_Com );
	}
	
	this.updArt = function( ID ) {
		var Nombre = document.getElementById("txtNombre").value;
		var Familia = document.getElementById("slcFamilia").value;
		var Proveedor = document.getElementById("slcProveedor").value;
		var PCBase = document.getElementById("txtPCBase").value;
		var PVP = document.getElementById("txtPVP").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else if ( strResultado.indexOf('warning') >= 0 ) 
					alert( 'El precio de compra final es \nmayor que el precio de venta' );
				else
					listar('articulo');
			}
		};
		objAjaxUpd.open( 'POST', './articulo/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&Nombre=" + Nombre + "&Familia=" + Familia + "&Proveedor=" + Proveedor + "&PCBase=" + PCBase + "&PVP=" + PVP + "&Comentario=" + Comentario );
	}
	
	this.updArtDep = function( ID_Dep, ID_Art, Estado ) {
		var Articulo = document.getElementById("slcArticulo").value;
		if (!Estado) var Pedidas = document.getElementById("txtPedidas").value;
		else var Recibidas = document.getElementById("txtRecibidas").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listarArticulosDeposito( ID_Dep, Estado );
			}
		};
		objAjaxUpd.open( 'POST', './deposito/articulo/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		if (!Estado) objAjaxUpd.send( "Articulo=" + Articulo + "&Pedidas=" + Pedidas + "&Deposito=" + ID_Dep + "&Estado=" + Estado );
		else objAjaxUpd.send( "Articulo=" + Articulo + "&Recibidas=" + Recibidas + "&Deposito=" + ID_Dep + "&Estado=" + Estado );
	}
	
	this.updArtCom = function( ID_Com, ID_Art, OLD, NEW ) {
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else if ( strResultado.indexOf('X') >= 0 )
					alert( 'No hay suficiente stock de ese producto' );
				else if ( strResultado.indexOf('Y') >= 0 )
					alert( 'No puede devolverse ese producto' );
				else{
					listarArticulosCompra( ID_Com );
					opener.listar('compra');
				}
			}
		};
		objAjaxUpd.open( 'POST', './compra/articulo/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "Articulo=" + ID_Art + "&Compra=" + ID_Com + "&OLD=" + OLD + "&NEW=" + NEW );
	}
	
}

function Proveedor(){
	
	this.className = "Proveedor";
	this.bolCIF = false;
	this.bolNombre = false;
	this.bolDireccion = true;
	this.bolTelefono = true;
	this.bolMail = true;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	
	this.cIFOk = function () {
		return this.bolCIF = true;
	}
	
	this.nombreOk = function () {
		return this.bolNombre = true;
	}
	
	this.direccionOk = function () {
		return this.bolDireccion = true;
	}
		
	this.telefonoOk = function () {
		return this.bolTelefono = true;
	}
		
	this.mailOk = function () {
		return this.bolMail = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolCIF && this.bolNombre && this.bolDireccion && this.bolTelefono && this.bolMail && this.bolComentario );
	}
	
	this.newPro = function() {
		var proveedor = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				proveedor.bolCIF = false;
				proveedor.bolNombre = false;
				proveedor.bolDireccion = true;
				proveedor.bolTelefono = true;
				proveedor.bolMail = true;
				proveedor.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './proveedor/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.editPro = function( ID ) {
		var proveedor = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				proveedor.bolCIF = true;
				proveedor.bolNombre = true;
				proveedor.bolDireccion = true;
				proveedor.bolTelefono = true;
				proveedor.bolMail = true;
				proveedor.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './proveedor/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.delPro = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este proveedor?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse este proveedor porque \nesta referenciado en uno o varios articulos.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('proveedor');
				}
			};
			objAjaxDel.open( 'POST', './proveedor/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.regPro = function() {
		var CIF = document.getElementById("txtCIF").value;
		var Nombre = document.getElementById("txtNombre").value;
		var Direccion = document.getElementById("txtDireccion").value;
		var Telefono = document.getElementById("txtTelefono").value;
		var Mail = document.getElementById("txtMail").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('proveedor');
			}
		};
		objAjaxReg.open( 'POST', './proveedor/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "CIF=" + CIF + "&Nombre=" + Nombre + "&Direccion=" + Direccion + "&Telefono=" + Telefono + "&Mail=" + Mail + "&Comentario=" + Comentario );
	}
	
	this.updPro = function( ID ) {
		var CIF = document.getElementById("txtCIF").value;
		var Nombre = document.getElementById("txtNombre").value;
		var Direccion = document.getElementById("txtDireccion").value;
		var Telefono = document.getElementById("txtTelefono").value;
		var Mail = document.getElementById("txtMail").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') > 0 )
					alert( strResultado );
				else
					listar('proveedor');
			}
		};
		objAjaxUpd.open( 'POST', './proveedor/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&CIF=" + CIF + "&Nombre=" + Nombre + "&Direccion=" + Direccion + "&Telefono=" + Telefono + "&Mail=" + Mail + "&Comentario=" + Comentario );
	}
	
}

function Deposito(){
	
	this.className = "Deposito";
	this.bolProveedor = false;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	this.Art = new Articulo();
	
	this.proveedorOk = function () {
		return this.bolProveedor = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolProveedor && this.bolComentario );
	}
	
	this.newDep = function() {
		var deposito = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				deposito.bolProveedor= false;
				deposito.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './deposito/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.editDep = function( ID ) {
		var deposito = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				deposito.bolProveedor = true;
				deposito.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './deposito/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.delDep = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este deposito?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse este deposito porque \nya ha sido confirmado por el usuario.');
					else if ( wndFindArt )
						alert('Primero debe cerrar la ventana de compra o deposito.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('deposito');
				}
			};
			objAjaxDel.open( 'POST', './deposito/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.regDep = function() {
		var Proveedor = document.getElementById("slcProveedor").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('deposito');
			}
		};
		objAjaxReg.open( 'POST', './deposito/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Proveedor=" + Proveedor + "&Comentario=" + Comentario );
	}
	
	this.updDep = function( ID ) {
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('deposito');
			}
		};
		objAjaxUpd.open( 'POST', './deposito/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&Comentario=" + Comentario );
	}
	
	this.marcarPedido = function( ID ) {
		if( confirm( '¿Estas seguro de que quieres marcar este deposito como pedido?\nNo podras editar las unidades pedidas.' ) ){
			objAjaxSetState = new AJAX();	
			objAjaxSetState.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else{
						listarArticulosDeposito( ID, 1 );
						opener.listar('deposito');
					}
				}
			};
			objAjaxSetState.open( 'POST', './deposito/pedido.php', true );
			objAjaxSetState.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxSetState.send( "ID=" + ID );
		}
	}
	
	this.marcarRecibido = function( ID, objFecha, objCheck ) {
		if ( fechaValida(objFecha.value) || objCheck.checked ){
			if( confirm( '¿Estas seguro de que quieres marcar este deposito como recibido?\nNo podras editar las unidades recibidas.' ) ){
				objAjaxSetState = new AJAX();	
				objAjaxSetState.onreadystatechange = function() {
					var strResultado = this.responseText;
					if ( this.readyState == 4 && this.status == 200 ){
						if ( strResultado.indexOf('error') >= 0 )
							alert( strResultado );
						else if ( strResultado.indexOf('warning') >= 0 )
							alert( 'La fecha de cierre debe ser posterior a la fecha actual' );
						else{
							listarArticulosDeposito( ID, (objCheck.checked ? 5 : 2 ) );
							opener.listar('deposito');
						}
					}
				};
				objAjaxSetState.open( 'POST', './deposito/recibido.php', true );
				objAjaxSetState.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
				objAjaxSetState.send( "ID=" + ID + "&Fecha=" + objFecha.value + "&Check=" + objCheck.checked );
			}
		}else alert('Fecha No Valida');
	}
	
	this.marcarCerrado = function( ID ) {
		if( confirm( '¿Estas seguro de que quieres marcar este deposito como cerrado?\nLas unidades a devolver desapareceran del stock.' ) ){
			objAjaxSetState = new AJAX();	
			objAjaxSetState.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else{
						listarArticulosDeposito( ID, 3 );
						opener.listar('deposito');
					}
				}
			};
			objAjaxSetState.open( 'POST', './deposito/cerrado.php', true );
			objAjaxSetState.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxSetState.send( "ID=" + ID );
		}
	}
	
	this.cerrarCaducados = function() {
		objAjaxSetState = new AJAX();	
		objAjaxSetState.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 ) alert( strResultado );
			}
		};
		objAjaxSetState.open( 'POST', './deposito/caducado.php', true );
		objAjaxSetState.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxSetState.send();
	}
	
}

function Cliente(){
	
	this.className = "Cliente";
	this.bolDNI = false;
	this.bolNombre = false;
	this.bolDireccion = true;
	this.bolTelefono = true;
	this.bolMail = true;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	
	this.dNIOk = function () {
		return this.bolDNI = true;
	}
	
	this.nombreOk = function () {
		return this.bolNombre = true;
	}
	
	this.direccionOk = function () {
		return this.bolDireccion = true;
	}
		
	this.telefonoOk = function () {
		return this.bolTelefono = true;
	}
		
	this.mailOk = function () {
		return this.bolMail = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolDNI && this.bolNombre && this.bolDireccion && this.bolTelefono && this.bolMail && this.bolComentario );
	}
	
	this.newCli = function() {
		var cliente = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				cliente.bolDNI = false;
				cliente.bolNombre = false;
				cliente.bolDireccion = true;
				cliente.bolTelefono = true;
				cliente.bolMail = true;
				cliente.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './cliente/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.editCli = function( ID ) {
		var cliente = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				cliente.bolDNI = true;
				cliente.bolNombre = true;
				cliente.bolDireccion = true;
				cliente.bolTelefono = true;
				cliente.bolMail = true;
				cliente.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './cliente/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.delCli = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este cliente?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse este cliente porque \nesta referenciado en una o varias compras.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('cliente');
				}
			};
			objAjaxDel.open( 'POST', './cliente/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.regCli = function() {
		var DNI = document.getElementById("txtDNI").value;
		var Nombre = document.getElementById("txtNombre").value;
		var Direccion = document.getElementById("txtDireccion").value;
		var Telefono = document.getElementById("txtTelefono").value;
		var Mail = document.getElementById("txtMail").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('cliente');
			}
		};
		objAjaxReg.open( 'POST', './cliente/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "DNI=" + DNI + "&Nombre=" + Nombre + "&Direccion=" + Direccion + "&Telefono=" + Telefono + "&Mail=" + Mail + "&Comentario=" + Comentario );
	}
	
	this.updCli = function( ID ) {
		var DNI = document.getElementById("txtDNI").value;
		var Nombre = document.getElementById("txtNombre").value;
		var Direccion = document.getElementById("txtDireccion").value;
		var Telefono = document.getElementById("txtTelefono").value;
		var Mail = document.getElementById("txtMail").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') > 0 )
					alert( strResultado );
				else
					listar('cliente');
			}
		};
		objAjaxUpd.open( 'POST', './cliente/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&DNI=" + DNI + "&Nombre=" + Nombre + "&Direccion=" + Direccion + "&Telefono=" + Telefono + "&Mail=" + Mail + "&Comentario=" + Comentario );
	}
	
}

function Compra(){
	
	this.className = "Compra";
	this.bolCliente = false;
	this.bolComentario = true;
	this.objValidaciones = new Validacion(this);
	this.Art = new Articulo();
	
	this.clienteOk = function () {
		return this.bolCliente = true;
	}
	
	this.comentarioOk = function () {
		return this.bolComentario = true;
	}
	
	this.isCorrect = function() {
		return ( this.bolCliente && this.bolComentario );
	}
	
	this.newCom = function() {
		var deposito = this;
		objAjaxNew = new AJAX();	
		objAjaxNew.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				deposito.bolCliente= false;
				deposito.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxNew.open( 'POST', './compra/new.php', true );
		objAjaxNew.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxNew.send();
	}
	
	this.editCom = function( ID ) {
		var compra = this;
		objAjaxEdit = new AJAX();	
		objAjaxEdit.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				compra.bolCliente = true;
				compra.bolComentario = true;
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxEdit.open( 'POST', './compra/edit.php', true );
		objAjaxEdit.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxEdit.send( "ID=" + ID );
	}
	
	this.delCom = function( ID ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar esta compra?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'X' )
						alert('No puede borrarse esta compra\nPara borrar una compra primero debe borrar sus articulos.');
					else if ( wndFindArt )
						alert('Primero debe cerrar la ventana de compra o deposito.');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						listar('compra');
				}
			};
			objAjaxDel.open( 'POST', './compra/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.regCom = function() {
		var Cliente = document.getElementById("slcCliente").value;
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('compra');
			}
		};
		objAjaxReg.open( 'POST', './compra/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Cliente=" + Cliente + "&Comentario=" + Comentario );
	}
	
	this.updCom = function( ID ) {
		var Comentario = document.getElementById("txtComentario").value;
		
		objAjaxUpd = new AJAX();	
		objAjaxUpd.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else
					listar('compra');
			}
		};
		objAjaxUpd.open( 'POST', './compra/upd.php', true );
		objAjaxUpd.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxUpd.send( "ID=" + ID + "&Comentario=" + Comentario );
	}
	
}

function Venta(){
	
	this.newVen = function() {
		
		var venta = this;
		
		document.getElementById("pnlSubTitle").innerHTML = 'Nueva Venta';
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 ){
					alert( strResultado );
					return;
				}else
					venta.listar( strResultado );
			}
		};
		objAjaxReg.open( 'POST', './venta/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send();
	}

	this.newArtVen = function( Compra, Articulo, Unidades ){
		
		var venta = this;
		
		objAjaxReg = new AJAX();	
		objAjaxReg.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				if ( strResultado.indexOf('error') >= 0 )
					alert( strResultado );
				else if ( strResultado.indexOf('X') >= 0 )
					alert( 'No hay suficiente stock de ese producto' );
				else if ( strResultado.indexOf('Y') >= 0 )
					alert( 'Ese Articulo ya esta en la lista de compra' );
				else
					venta.listar( Compra );
			}
		};
		objAjaxReg.open( 'POST', './compra/articulo/reg.php', true );
		objAjaxReg.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxReg.send( "Articulo=" + Articulo + "&Pedidas=" + Unidades + "&Compra=" + Compra );
	}
	
	this.delVen = function( ID ) {
		
		if( confirm( '¿Estas seguro?' ) ){
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado == 'Y' )
						alert('Ocurrio un error.\nNo todos los articulos pudieron ser borrados');
					else if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else
						loginVenta();
				}
			};
			objAjaxDel.open( 'POST', './venta/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "ID=" + ID );
		}
	}
	
	this.delArtVen = function( Compra, Articulo, Unidades ) {
		
		if( confirm( '¿Estas seguro de que quieres borrar este articulo?' ) ){
			
			var venta = this;
			
			objAjaxDel = new AJAX();	
			objAjaxDel.onreadystatechange = function() {
				var strResultado = this.responseText;
				if ( this.readyState == 4 && this.status == 200 ){
					if ( strResultado.indexOf('error') >= 0 )
						alert( strResultado );
					else if ( strResultado.indexOf('Y') >= 0 )
						alert( 'No puede devolverse ese producto' );
					else
						venta.listar( Compra );
				}
			};
			objAjaxDel.open( 'POST', './compra/articulo/del.php', true );
			objAjaxDel.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
			objAjaxDel.send( "Articulo=" + Articulo + "&Compra=" + Compra + "&Unidades=" + Unidades );
		}
	}
	
	this.listar = function( ID ) {
		
		//Panel Superior
		objAjaxSecTool = new AJAX();	
		objAjaxSecTool.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				document.getElementById("pnlTool").innerHTML = strResultado;
			}
		};
		objAjaxSecTool.open( 'POST', './venta/tool.php', true );
		objAjaxSecTool.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxSecTool.send( "ID=" + ID );
		
		//Panel Principal
		objAjaxSec = new AJAX();	
		objAjaxSec.onreadystatechange = function() {
			var strResultado = this.responseText;
			if ( this.readyState == 4 && this.status == 200 ){
				document.getElementById("pnlMain").innerHTML = strResultado;
			}
		};
		objAjaxSec.open( 'POST', './venta/index.php', true );
		objAjaxSec.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded; charset=UTF-8" );
		objAjaxSec.send( "ID=" + ID );
	}
	
}

var Fam = new Familia();
var Art = new Articulo();
var Pro = new Proveedor();
var Dep = new Deposito();
var Cli = new Cliente();
var Com = new Compra();
var Ven = new Venta();
