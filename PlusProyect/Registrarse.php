<?php
    if(isset($_POST["btnRegistrar"]))
    {
        if ($_POST['txtPassword']=$_POST["txtConfiPassword"])
        {
            require_once("Models\Clientes.php"); 
            $Cli=new cliente();
    
            $Cli->set_Username($_POST['txtUsername']);
     
            $Cli->set_password($_POST['txtPassword']);
    
            $Cli->set_nombre($_POST['txtNombre']);
        
            $Cli->set_apellidos($_POST['txtApellido']);
            
            $Cli->set_email($_POST['txtEmail']);
    
            $Cli->set_sexo($_POST['txtgenero']);
            
            $Cli->set_telefono($_POST['txtTelefono']);
    
            $Cli->set_dni($_POST['txtDni']);
    
            $Cli->set_direccion($_POST['txtDieccion']);
       
           $res= $Cli->ConsultaNick();
           $fila=mysqli_fetch_array($res);
            if($fila["Username"]!=NULL)
            {
                echo'<script type="text/javascript">
                        alert("Usuario ya existe");
                        </script>';
            }
            else{
                $Cli->InsertarCliente();
            
                header("location:Index.php");
    
            }
        }
        else{
            echo'<script type="text/javascript">
                        alert("Las contraseñas no coinciden  '.$_POST['txtPassword'].' '.  $_POST["txtConfiPassword"].'");
                        </script>';
        }
        
  
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" http-equiv="Content-Type" >
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   
    <script >
  $(document).ready(function () {
    function myFunction(){
        var x = document.getElementById("txtConfiPassword").value;
        var y=document.getElementById("txtPassword").value;
        alert(x +'aa'+ y);
        if(x!=y)
        {
            alert("Retifica las contraseñas");
            document.getElementById("btnRegistrar").disble=true;
        }
        else
            document.getElementById("btnRegistrar").disble=false;
        }
  });
    </script>
    <title>Plus Center</title>
    </head>
    <body>

    <header>
        <!--Elementos de navegacion -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <!--Titulo/Logo/Nombre Empresa -->
            <a class="navbar-brand" href="#">PLUS</a>
            <!-- Fin Titulo/Logo/Nombre Empresa -->
            

            <div class="collapse navbar-collapse" id="navbarCollapse">     
        
            </div>
        </nav>
        <!--Fin Elementos de navegacion -->
    </header>

        <main role="main">
            <br />
            <br />
            <br />
            <!--Login-->
            <div class="row">
                <div id="login" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
                    col-12">
                    <h2 class="text-center">Registrate</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="usuario">Nombre de usuario</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                            <svg class="bi bi-person-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                                            </svg> 
                                    </span>
                                </div>
                                <input id="txtUsuario" name="txtUsername"
                                    class="form-control" type="text"  onkeyup="ComprobarUsername(this.value);"
                                    placeholder="Username" maxlength="25" required/>
                            </div>
                                <label for="Nombre">Nombre</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">

                                            <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg>
                                        </span>
                                    </div>
                                <input id="txtNombre" name="txtNombre"
                                    class="form-control" type="text"
                                    placeholder="Nombre" S maxlength="25" required />
                            </div>

                        <div class="form-group">
                        <label for="Apellido">Apellido</label>
                        <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">

                                            <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg>
                                        </span>
                                    </div>
                        <input id="txtApellido" name="txtApellido"
                            class="form-control" type="text"
                            placeholder="Apellido" maxlength="100" required />
                        </div>

                        <div class="form-group">

                            <label for="palabraSecreta">Contraseña</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                    <svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="11" height="9" x="2.5" y="7" rx="2"/>
                                        <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                    </svg>
                                    </span>
                                </div>
                            <input id="palabraSecreta" name="txtPassword" id="txtPassword"
                                class="form-control" type="password"
                                placeholder="Contraseña"  pattern="?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$"  maxlength="16" required>
                        </div>
                        <div class="form-group">
                        <label for="VerCon">Verificar Contraseña</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                    <svg class="bi bi-lock-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="11" height="9" x="2.5" y="7" rx="2"/>
                                        <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                    </svg>
                                    </span>
                                </div>
                        <input id="VerfCon" name="txtConfiPassword" id="txtConfiPassword"
                            class="form-control" type="password" 
                            placeholder="Repite la contraseña" pattern="?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$" maxlength="16"  required="true" />
                        </div>

                        <div class="form-group">
                        <label for="Email">Email</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg class="bi bi-at" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                                        </svg>
                                    </span>
                                </div>
                        <input id="Email" name="txtEmail"
                            class="form-control" type="email"
                            placeholder="Correo" maxlength="100"  required>
                        </div>

                        <div class="form-group">
                        <label for="palabraSecreta">Teléfono</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg class="bi bi-phone" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                                            <path fill-rule="evenodd" d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        </svg>
                                    </span>
                                </div>
                        <input id="palabraSecreta" name="txtTelefono"
                            class="form-control" type="phone"
                            placeholder="Teléfono"  maxlength="9"  required>
                        </div>

                        <div class="form-group">
                        <label for="Direccion">Dirección</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                      <svg class="bi bi-building" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M15.285.089A.5.5 0 0 1 15.5.5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .418-.493l5.582-.93V3.5a.5.5 0 0 1 .324-.468l8-3a.5.5 0 0 1 .46.057zM7.5 3.846V8.5a.5.5 0 0 1-.418.493l-5.582.93V15h8v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.222l-7 2.624z"/>
                                         <path fill-rule="evenodd" d="M6.5 15.5v-7h1v7h-1z"/>
                                         <path d="M2.5 11h1v1h-1v-1zm2 0h1v1h-1v-1zm-2 2h1v1h-1v-1zm2 0h1v1h-1v-1zm6-10h1v1h-1V3zm2 0h1v1h-1V3zm-4 2h1v1h-1V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm-2 2h1v1h-1V7zm2 0h1v1h-1V7zm-4 0h1v1h-1V7zm0 2h1v1h-1V9zm2 0h1v1h-1V9zm2 0h1v1h-1V9zm-4 2h1v1h-1v-1zm2 0h1v1h-1v-1zm2 0h1v1h-1v-1z"/>
                                     </svg>
                                    </span>
                                </div>
                        <input id="Direccion" name="txtDieccion"
                            class="form-control" type="text"
                            placeholder="Dirección"  maxlength="16"  required />
                        </div>
                        <div class="form-group">
                        <label for="DNI">DNI</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                    <svg class="bi bi-credit-card" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                                        <rect width="3" height="3" x="2" y="9" rx="1"/>
                                        <path d="M1 5h14v2H1z"/>
                                    </svg>
                                    </span>
                                </div>
                        <input id="DNI" name="txtDni"
                            class="form-control" type="text"
                            placeholder="Contraseña"  maxlength="9"  required>
                        </div>

                        <div class="form-group">
                        <label for="Genero">Genero</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </span>
                                </div>
                        <select name="txtgenero" class="form-control" required>
                            <option value="">Seleccionar</option>
                            <option value="1">Hombre</option>
                            <option value="0">Mujer</option>
                        </select>
                        </div>
                        <button type="submit" name="btnRegistrar" id="btnRegistrar" class="btn btn-dark">
                         Registrarse
                        </button>
                        <br>
                    </form>
                </div>
            </div>
            <!--Fin login-->

        </main>
    </body>
</html>
