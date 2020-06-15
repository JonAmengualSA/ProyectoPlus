<?php
class BDContext
{
    public static function conexion()
    {
        $conexion=mysqli_connect("localhost","root","","damproyecto");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }    
}
?>