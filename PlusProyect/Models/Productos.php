<?php
    require_once("Models\BDContext.php"); 

    class Productos
    {
        private $bd;
        private $IdProducto;
        private $Nombre;
        private $Descripcion;
        private $PrecioUnitario;
        private $Categoria;
        private $SubCategoria;
        private $Stock;

        public function __construct()
        {
            $this->bd=BDContext::conexion();
        }

        //Get,set IdProducto
        function get_IdProducto()
        {
            return $this->IdProducto;
        }
        function set_IdProducto($IdProducto)
        {
            $this->IdProducto=$IdProducto;
        }

         //Get,set Nombre
        function get_Nombre()
        {
            return $this->Nombre;
        }
        function set_Nombre($Nombre)
        {
            $this->Nombre=$Nombre;
        }

        //Get,set Descripcion
        function get_Descripcion()
        {
            return $this->Descripcion;
        }
        function set_Descripcion($Descripcion)
        {
            $this->Descripcion=$Descripcion;
        }

        //Get,set Descripcion
        function get_PrecioUnitario()
        {
            return $this->PrecioUnitario;
        }
        function set_PrecioUnitario($PrecioUnitario)
        {
            $this->PrecioUnitario=$PrecioUnitario;
        }

        //Get,set Categoria
        function get_Categoria()
        {
            return $this->Categoria;
        }
        function set_Categoria($Categoria)
        {
            $this->Categoria=$Categoria;
        }

        //Get,set SubCategoria
        function get_SubCategoria()
        {
            return $this->SubCategoria;
        }
        function set_SubCategoria($SubCategoria)
        {
            $this->SubCategoria=$SubCategoria;
        }

        //Get,set Categoria
        function get_Stock()
        {
            return $this->Stock;
        }
        function set_Stock($Stock)
        {
            $this->Stock=$Stock;
        }
        
        /* Listar Productos */
        function MostrarProductos()
        {
            $datos=$this->bd->query("CALL pr_BuscarProductos()");
            return $datos;
        }
        
        function AltaProducto()
        {
            if($this->Categoria!=$this->SubCategoria && $this->Stock>0 && $this->PrecioUnitario>0)
            {
                $datos=$this->bd->query("call pr_altaProductos('".$this->Nombre."','".$this->Descripcion."','".$this->PrecioUnitario."','".$this->Categoria."','".$this->Categoria."','".$this->SubCategoria."','".$this->Stock."',@p_salir)");		
                return $datos;
            }
            else 
            {
                return "Error";
            }
            
        }
        function PrecioProducto($cod)
        {
            $datos=$this->bd->query("Select PrecioUnitario from productos Where IdProducto='".$cod."' "); 
            return $datos;
        }

        function ConsultarStrock($cod)
        {            
            $datos=$this->bd->query("Select Stock from productos Where IdProducto='".$cod."' "); 
            return $datos;
        }




    }
?>