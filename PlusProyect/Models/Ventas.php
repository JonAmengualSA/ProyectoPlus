<?php
  require_once("Models\BDContext.php");
    Class ventas
    {
        private $bd;
        private $CodVenta;
        private $CodCliente;
        private $PrecioTotal;

        public function __construct()
        {
            $this->bd=BDContext::conexion();
        }

        
        //Get,set CodAdmin
        function get_CodVenta()
        {
            return $this->CodVenta;
        }
        function set_CodVenta($CodVenta)
        {
            $this->CodVenta=$CodVenta;
        }

         //Get,set usuario
        function get_CodCliente()
        {
            return $this->CodCliente;
        }
        function set_CodCliente($CodCliente)
        {
            $this->CodCliente=$CodCliente;
        }


        function get_PrecioTotal()
        {
            return $this->PrecioTotal;
        }
        function set_PrecioTotal($PrecioTotal)
        {
            $this->PrecioTotal=$PrecioTotal;
        }

        function ListaVentas()
        {
            $datos=$this->bd->query("CALL pr_BuscarVentas()");  
            return $datos;
        }

        function MaxCodventa()
        {
            $datos=$this->bd->query("CALL pr_MaxCodVenta()");  
            return $datos;
        }

        function PrimeraVenta($Cli,$prod)
        {
            $datos=$this->bd->query("CALL pr_Venta('".$Cli."','".$prod."')");  
            return $datos;
        }
        function MasVenta($Cli,$prod,$CV)
        {
            $datos=$this->bd->query("CALL pr_MasVentas('".$Cli."','".$prod."', '".$CV."')");  
            return $datos;
        }
        function VentaMismoProducto($Cli,$prod,$CV)
        {       
            $datos=$this->bd->query("CALL pr_VentaMismoProducto('".$Cli."','".$prod."', '".$CV."')");  
            return $datos;
        }

    }



?>