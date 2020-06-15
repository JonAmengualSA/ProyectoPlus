<?php
    require_once("Models\Clientes.php"); 
    $valor=$_POST['valor'];
    $Cli=new cliente();
    $Cli->set_Username($valor);

    $fila=mysqli_num_rows($Cli->BuscaUsuario($Cli->get_Username(),"%"));
    echo $fila;
?>