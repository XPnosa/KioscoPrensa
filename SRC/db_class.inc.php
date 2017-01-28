<?php
class articulo {
	protected $ID;
	protected $ID_Fam;
	protected $ID_Pro;
	protected $Nombre;
	protected $Stock;
	protected $PCBase;
	protected $PCFinal;
	protected $PVP;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class art_com {
	protected $ID_Art;
	protected $ID_Com;
	protected $Unidades;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class art_dep {
	protected $ID_Art;
	protected $ID_Dep;
	protected $Pedidas;
	protected $Recibidas;
	protected $Vendidas;
	protected $Devolver;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class cliente {
	protected $ID;
	protected $DNI;
	protected $Nombre;
	protected $Direccion;
	protected $Telefono;
	protected $Mail;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class compra {
	protected $ID;
	protected $ID_Cli;
	protected $Fecha;
	protected $Importe;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class deposito {
	protected $ID;
	protected $ID_Pro;
	protected $Importe;
	protected $Estado;
	protected $FechaPedido;
	protected $FechaDeposito;
	protected $FechaCierre;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class familia {
	protected $ID;
	protected $Nombre;
	protected $IVA;
	protected $RecEq;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class proveedor {
	protected $ID;
	protected $CIF;
	protected $Nombre;
	protected $Direccion;
	protected $Telefono;
	protected $Mail;
	protected $Comentario;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}

class stats {
	protected $Articulo;
	protected $Proveedor;
	protected $Pedidas;
	protected $Recibidas;
	protected $Vendidas;
	protected $Devueltas;
	protected $Importe;
	protected $UltimoDeposito;
	protected $UltimaVenta;

	function __construct() {}

	function __destruct() {}
	
	public function __get( $strPropertyName ) {
		if ( isset( $this->$strPropertyName ) ) {
			return $this->$strPropertyName;
		}
	}
	
	public function __set( $strPropertyName, $mixedValue ) {
		if ( isset( $this->$strPropertyName ) ) {
			$this->$strPropertyName = $mixedValue;
			return;
		}
	}
}
?>
