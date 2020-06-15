<?php
  if (isset ($_POST['btnLogin']))
  {
    $username=$_POST['txtUsuario'];
    $pswd=$_POST['txtPswd'];

    if($username!="" && $pswd!="")
    { 
      require_once("Models\Clientes.php"); 
      $Cli=new cliente();
      
      $Cli->set_Username($username);
      $Cli->set_password($pswd);
      $fila=mysqli_fetch_assoc($Cli->BuscaUsuario($Cli->get_Username(),$Cli->get_password()));

      if(!$fila["codigo"])/* Si no existe ningun Cliente  */
      { 
        require_once("Models\Administradores.php"); 
        $Admin=new Administradores();
        $Admin->set_usuario($username);
        $Admin->set_pwsd($pswd);
        $fila=mysqli_fetch_assoc($Admin->BuscarAdmin($Admin->get_usuario(),$Admin->get_pwsd()));
        echo $fila["CodAdmin"];
        if(!$fila["CodAdmin"])/* Si no existe ningun Admin  */
        {
          header("location:Registrarse.php");
        }
        else
        {
          session_start();
          $_SESSION['CodAdmin']=$fila["CodAdmin"];
          $_SESSION['Rango']=$fila["Rango"];
          header("location:Administracion.php");
        }

      }
      else
			{						
				//echo $fila["codigoUsuario"];
					session_start();
					$_SESSION['ID']=$fila["codigo"];
					$_SESSION['Nombre']=$fila["nombre"];
					header("location:PlusTienda.php");
			}
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
   <script
		src="https://code.jquery.com/jquery-3.5.1.js"
		integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
		crossorigin="anonymous">
    </script>
    
    <script
	    src="https://code.jquery.com/jquery-3.5.1.slim.js"
        integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM="
	    crossorigin="anonymous">
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <title>Plus Center</title>
    <script type="text/javascript">
        function Registrarse()
        {
            window.location.href="Registrarse.php";
        }


    </script>
  </head>
  <body>

    <header>
     <!--Elementos de navegacion -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!--Titulo/Logo/Nombre Empresa -->
        <a class="navbar-brand" href="Index.php">PLUS</a>
         <!-- Fin Titulo/Logo/Nombre Empresa -->

         <div class="collapse navbar-collapse" id="navbarCollapse">     
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="AboutPlus.html">About us<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contact.htm">Conctat</a>
            </li>
          </ul>
      </nav>
        <!--Fin Elementos de navegacion -->
    </header>

    
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
   
    <main>
<!--Login-->
        <div class="row">
          <div id="login" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
              col-12">
              <h2 class="text-center">Inicia sesion</h2>
            
                <br />   
                <br />
            <form method="post" action="">
            
                  <div class="form-group">
                      <label for="usuario">Nombre de usuario</label>
                        
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">

                                <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </span>
                        </div>
                         <!--txtUsuario-->
                        <input id="txtUsuario" name="txtUsuario" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
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
                            <!--txtPswd-->
                            <input id="txtPswd" name="txtPswd" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" maxlength="10">
                        </div>                  
                      
                  </div>
                    <br/>
                  <button type="submit" class="btn btn-dark" id="btnLogin" name="btnLogin" >
                      Entrar
                  </button>

                  <button type="button" class="btn btn-dark" onclick="Registrarse()">
                    Registrarse
                  </button>

                  <br/>
                  <br/>
                  <a href="#">Contraseña olvidada</a>
                  <br>
                
              </form>
          </div>
      </div>
      <!--Fin login-->

    </main>



  </body>
</html>