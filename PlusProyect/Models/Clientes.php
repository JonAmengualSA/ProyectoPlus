<?php
    require_once("Models\BDContext.php"); 
class cliente
{
    private $bd;
    private $codigo;
    private $Username;
    private $password;
    private $nombre;
    private $apellidos;
    private $email; 
    private $sexo;
    private $telefono;
    private $dni;
    private $direccion;
    private $fechaAlta;
    private $saldo;


       public function __construct()
       {
            $this->bd=BDContext::conexion();

       }
       function get_bd() 
       {
           return $this->bd;
       }
       
        function get_codigo() 
        {
            return $this->codigo;
        }
        function set_codigo($codigo) 
        {
            $this->codigo=$codigo;
        }



        function get_Username() 
        {
            return $this->Username;
        }
        function set_Username($Username) 
        {
            $this->Username=$Username;
        }

        function get_password() 
        {
            return $this->password;
        }
        function set_password($password) 
        {
            $this->password=$password;
        }

        function get_nombre() 
        {
            return $this->nombre;
        }
        function set_nombre($nombre) 
        {
            $this->nombre=$nombre;
        }


        function get_apellidos() 
        {
            return $this->apellidos;
        }
        function set_apellidos($apellidos) 
        {
            $this->apellidos=$apellidos;
        }


        function get_email() 
        {
            return $this->email;
        }
        function set_email($email) 
        {
            $this->email=$email;
        }

        function get_sexo() 
        {
            return $this->sexo;
        }
        function set_sexo($sexo) 
        {
            $this->sexo=$sexo;
        }

        function get_telefono() 
        {
            return $this->telefono;
        }
        function set_telefono($telefono)
        {
            $this->telefono=$telefono;
        }


        function get_dni() 
        {
            return $this->dni;
        }
        function set_dni($dni)
        {
            $this->dni=$dni;
        }


        function get_direccion()
        {
            return $this->direccion;
        }
        function set_direccion($direccion) 
        {
            $this->direccion=$direccion;
        }

        function get_fechaAlta()
        {
            return $this->fechaAlta;
        }
        function set_fechaAlta($fechaAlta) 
        {
            $this->fechaAlta=$fechaAlta;
        }

        function get_saldo()
        {
            return $this->saldo;
        }
        function set_saldo($saldo) 
        {
            $this->saldo=$saldo;
        }



        function InsertarCliente()
        {   
    
            $datos=$this->bd->query("call pr_altaCliente('".$this->Username."','".$this->password."','".$this->nombre."','".$this->apellidos."','".$this->email."','".$this->sexo."','".$this->telefono."','".$this->dni."','".$this->direccion."',@p_salir)");		
            return $datos;
            
        }

        function UpdateCliente()
        {
            $datos=$this->bd->query("call pr_updateCliente('".$this->codigo."','".$this->Username."','".$this->password."','".$this->nombre."','".$this->apellidos."','".$this->email."','".$this->sexo."','".$this->telefono."','".$this->dni."','".$this->saldo."','".$this->direccion."')");		
            return $datos;
        }

        function delete()
        {
            $datos=$this->bd->query("Delete from clientes Where codigo='".$this->codigo."' ");					
        }

        function BuscaUsuario($User,$pass)
        {
            $datos=$this->bd->query("CALL pr_BuscarCliente('".$User."', '".$pass."')");
            return $datos;
        }
        function MostrarCliente()
        {
            $datos=$this->bd->query("CALL pr_Clientes()");
            return $datos;
        }

        function ConsultaNick()
        {
            $datos=$this->bd->query("Select Username from clientes Where Username='".$this->Username."' "); 
            return $datos;
        }
        function ConsultarSaldo($cod)
        {
            $datos=$this->bd->query("Select saldo from clientes Where codigo='".$cod."' "); 
            return $datos;
        }



}
?>