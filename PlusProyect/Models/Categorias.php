<?php
    require_once("Models\BDContext.php"); 

    class Categorias
    {
        private $bd;
        private $CodCategoria;
        private $Categoria;

        public function __construct()
        {
            $this->bd=BDContext::conexion();
        }

        //GET,SET CodCategoria
        function get_CodCategoria()
        {
            return $this->CodCategoria;
        }
        function set_CodCategoria($CodCategoria)
        {
            $this->CodCategoria=$CodCategoria;
        }

         //GET,SET Categoria
        function get_Categoria()
        {
            return $this->Categoria;
        }
        function set_Categoria($Categoria)
        {
            $this->Categoria=$Categoria;
        }

    
        
        /* Listar Categorias */
        function MostrarCategorias()
        {
            $datos=$this->bd->query("CALL pr_BuscarCategorias()");
            return $datos;
        }
        
        function AltaCategoria()
        {
            $datos=$this->bd->query("call pr_altaCategorias('".$this->CodCategoria."','".$this->Categoria."',@p_salir)");		
            return $datos;
        }        
        




    }
?>