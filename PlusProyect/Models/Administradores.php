<?php
    require_once("Models\BDContext.php"); 

    class Administradores
    {
        private $bd;
        private $codAdmin;
        private $usuario;
        private $rango;
        private $pwsd;

        public function __construct()
        {
            $this->bd=BDContext::conexion();
        }

        //Get,set CodAdmin
        function get_codAdmin()
        {
            return $this->codAdmin;
        }
        function set_codAdmin($codAdmin)
        {
            $this->codAdmin=$codAdmin;
        }

         //Get,set usuario
        function get_usuario()
        {
            return $this->usuario;
        }
        function set_usuario($usuario)
        {
            $this->usuario=$usuario;
        }

        //Get,set Rango
        function get_rango()
        {
            return $this->rango;
        }
        function set_rango($rango)
        {
            $this->rango=$rango;
        }

        //Get,set pwsd
        function get_pwsd()
        {
            return $this->pwsd;
        }
        function set_pwsd($pwsd)
        {
            $this->pwsd=$pwsd;
        }
        
        function InsertarAdminis()
        {
            $datos=$this->bd->query("CALL pr_altaAdmins('".$this->codAdmin."','".$this->usuario."','".$this->rango."','".$this->pwsd."',@p_salida)");				
        }
        function UpdateAdmin()
        {
              $datos=$this->bd->query("CALL pr_altaAdmins('".$this->codAdmin."','".$this->usuario."','".$this->rango."','".$this->pwsd."')");
        }
        function delete()
        {
            $datos=$this->bd->query("DELETE FROM administradores Where CodAdmin='".$this->codAdmin."' ");					
        }
        
        function BuscarAdmin($User,$pass)
        {
            $datos=$this->bd->query("CALL pr_BuscarAdmin('".$User."', '".$pass."')");
            return $datos;
        }

        function MostrarAdmins()
        {
            $datos=$this->bd->query("CALL pr_SelectAdmins()");  
            return $datos;
        }

        
        

    }


?>