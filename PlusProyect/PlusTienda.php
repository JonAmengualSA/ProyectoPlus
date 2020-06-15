<?php	
         require_once("Models\Productos.php");
         require_once("Models\Categorias.php");
         require_once("Models\Ventas.php");
         require_once("Models\Clientes.php");
         require_once("Models\DetalleVentas.php");
	 session_start();
	if (!isset ($_SESSION['ID']))	
	{
		header("location:Index.php");
	
    }	
    if (isset ($_POST["btnExit"]))
        {
           
            header("location:Index.php");
            session_destroy();
        }
    if (isset($_POST["btnComprar"]))
    {
        if(!isset ($_SESSION['CodCompra']))
        {
       
            $ven=new ventas();
            $ven->PrimeraVenta($_SESSION['ID'],$_POST["btnComprar"]);
            $resultado=$ven->MaxCodventa();
            $fila=mysqli_fetch_array($resultado);
            $_SESSION['CodCompra']= $fila['CodVenta'];

            echo'<script type="text/javascript">
            alert("Compra Realizada");
            </script>';
        }
        else
        {
          $prod=new Productos();
          $red=$prod->PrecioProducto($_POST["btnComprar"]);
          $filaPro=mysqli_fetch_array($red);

          $Cli=new cliente();
          $resultado=$Cli->ConsultarSaldo($_SESSION['ID']);
          $fila=mysqli_fetch_array($resultado);
          if($fila['saldo']>$filaPro['PrecioUnitario'])
          {
            $resultado= $prod->ConsultarStrock($_POST["btnComprar"]);
            $fila=mysqli_fetch_array($resultado);
              
            if($fila['Stock']>0)
            {
             
              $DV=new detalleVentas();
              $red=$DV->ComprobarProducto($_SESSION['ID'],$_POST["btnComprar"]);
              $filaDV=mysqli_fetch_array($red);

              if($filaDV['Cantidad']>0)
              {

                $ven=new ventas();
                $ven->VentaMismoProducto($_SESSION['ID'],$_POST["btnComprar"],$_SESSION['CodCompra']);
                echo'<script type="text/javascript">
                alert("Compra Realizada");
                </script>';
              }
              else
              {
                $ven=new ventas();
                $ven->MasVenta($_SESSION['ID'],$_POST["btnComprar"],$_SESSION['CodCompra']);
                echo'<script type="text/javascript">
                alert("Compra Realizada");
                </script>';
              }

            }
            echo'<script type="text/javascript">
            alert("No hay stock");
            </script>';

          }
          else{
            echo'<script type="text/javascript">
            alert("Saldo insuficiente");
            </script>';
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

  </head>
  <body>

    <header>
     <!--Elementos de navegacion -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!--Titulo/Logo/Nombre Empresa -->
        <a class="navbar-brand" href="Index.php">PLUS</a>
         <!-- Fin Titulo/Logo/Nombre Empresa -->
         <form method="post" action=""> <input class="btn btn-dark"  id="btnExit"name="btnExit" type="submit" value="Salir" /></form>
        <div class="collapse navbar-collapse" id="navbarCollapse">     
          <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
        <!--Fin Elementos de navegacion -->
    </header>

    
      <br />
      <br />
      <br />
      <br />
     
   
    <main role="main">
    <table class="table col-lg-2 offset-lg-2 col-md-4 offset-md-2">
            <tbody>
                <?php
                  $Prod=new Productos();
                  $resultado=$Prod->MostrarProductos();
                  $i=0;
                  while($fila=mysqli_fetch_array($resultado))
                  {
                    if($i==5)
                    {
                        echo '<tr>'; 
                    }
                    echo '<td>';
                    echo '<table class="table ">';
                        echo'<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
                        echo '<tr><div><img src="'.$fila['Imagen'].'" style="width:200px;height:200px" ></div></tr> ';
                          echo '<tr><div><h4>'.$fila['Nombre'].'</h4></div></tr> ';

                          echo '<tr><div>'.$fila['PrecioUnitario'].'€</div></tr>';
                          echo '<tr> <td><button type="submit" value="'.$fila['IdProducto'].'" id="btnComprar" name="btnComprar">Comprar</button></td></tr>';
                            
                        echo'</form>';
                    echo '</table>';
                    echo '<td>';
                   if($i==5)
                    {
                        echo '</tr>';
                        $i=0;
                    }
                    else
                     $i++;
                  }
                ?>
            </tbody>
        </table>



            <!-- /END THE FEATURETTES -->
    <!-- FOOTER -->

    </main>



    </body>
</html>