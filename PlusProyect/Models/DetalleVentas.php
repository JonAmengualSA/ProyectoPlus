<?php
  require_once("Models\BDContext.php");
    Class detalleVentas
    {
        private $bd;
        private $CodVenta;
        private $CodProducto;
        private $Cantidad;

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
        function get_CodProducto()
        {
            return $this->CodProducto;
        }
        function set_CodProducto($CodProducto)
        {
            $this->CodProducto=$CodProducto;
        }
        
        //Get,set usuario
        function get_Cantidad()
        {
            return $this->Cantidad;
        }
        function set_Cantidad($Cantidad)
        {
         $this->Cantidad=$Cantidad;
        }

        function ListaDetalleVenta($CodVenta)
        {
            $datos=$this->bd->query("CALL pr_DetalleVenta('".$CodVenta."')");  
            return $datos;
        }
        function ComprobarProducto($codVenta,$CodProducto)
        {
            $datos=$this->bd->query("Select Count(Cantidad) as Cantidad  from detalleventas Where CodVenta='".$codVenta."'and CodProducto= '".$CodProducto."' ");  
            return $datos;
        }
    }
?>
