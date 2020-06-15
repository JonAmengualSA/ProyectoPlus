<?php	
	 session_start();
	if (!isset ($_SESSION['CodAdmin']))	
	{
		header("location:Index.php");
	
    }	
    if (isset ($_POST["btnExit"]))
        {
           
            header("location:Index.php");
            session_destroy();
        }
        
	foreach($_GET as $clave => $valor)
	{
		if($valor=="Editar")
            $codCliente = $clave;
        if($valor=="Detalle")
            $CodVenta=$clave;
    }
    /************************************************************Añadir Cliente*********************************************/
    if(isset($_POST["btnAñadirCliente"]))
    {
        require_once("Models\Clientes.php"); 
        $Cli=new cliente();

        $Cli->set_Username($_POST['txtUsername']);

        $Cli->set_password($_POST['txtPswd']);

        $Cli->set_nombre($_POST['txtNombre']);

        $Cli->set_apellidos($_POST['txtApellidos']);
        
        $Cli->set_email($_POST['txtEmail']);

        $Cli->set_sexo($_POST['txtSexo']);
        
        $Cli->set_telefono($_POST['txtTelefono']);

        $Cli->set_dni($_POST['txtDNI']);

        $Cli->set_direccion($_POST['txtDireccion']);
   
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

        }
    }
/************************************************************Editar Cliente*********************************************/
if(isset($_POST["btEditCliente"]))
{
    require_once("Models\Clientes.php"); 
    $Cli=new cliente();

    $Cli->set_codigo($_POST['txtCodigo']);

    $Cli->set_Username($_POST['txtUsername']);

    $Cli->set_password($_POST['txtPswd']);

    $Cli->set_nombre($_POST['txtNombre']);

    $Cli->set_apellidos($_POST['txtApellidos']);
    
    $Cli->set_email($_POST['txtEmail']);

    $Cli->set_sexo($_POST['txtSexo']);
    
    $Cli->set_telefono($_POST['txtTelefono']);

    $Cli->set_dni($_POST['txtDNI']);

    $Cli->set_saldo($_POST['txtSaldo']);

    $Cli->set_direccion($_POST['txtDireccion']);

   $res= $Cli->ConsultaNick();
   $fila=mysqli_fetch_array($res);
    $Cli->UpdateCliente();

    
}
/********Eliminar Cliente********/
if(isset($_POST["btEliminarCliente"]))
{
    require_once("Models\Clientes.php"); 
    $Cli=new cliente();

    $Cli->set_codigo($_POST['txtCodigo']);
    $Cli->delete();
}

/************************************************************Añadir Admin*********************************************/
    if(isset($_POST["btnAñadirAdmin"]))
    {
        require_once("Models\Administradores.php"); 
        $Ad=new Administradores();

        $Ad->set_codAdmin($_POST['txtCodAdmin']);

        $Ad->set_usuario($_POST['txtUsuario']);
    
        $Ad->set_pwsd($_POST['txtPassword']);
        
        $Ad->set_rango($_POST['txtRango']);
        
        $Ad->InsertarAdminis();
        
    }
    /************************************************************Editar Admin*********************************************/
  
    if(isset($_POST["btnAñadirAdmin"]))
    {
        require_once("Models\Administradores.php"); 
        $Ad=new Administradores();

        $Ad->set_codAdmin($_POST['txtCodAdmin']);

        $Ad->set_usuario($_POST['txtUsuario']);
    
        $Ad->set_pwsd($_POST['txtPassword']);
        
        $Ad->set_rango($_POST['txtRango']);
        
        $Ad->UpdateAdmin();
        
    }

 /************************************************************Eliminar Admin*********************************************/
    if(isset($_POST["btnEliminarAdmin"]))
    {
        require_once("Models\Administradores.php"); 
        $Ad=new Administradores();

        $Ad->set_codAdmin($_POST['txtCodAdmin']);
        
        $Ad->UpdateAdmin();
        
    }
    /************************************************************Añadir Categoriass*********************************************/
    if(isset($_POST["btnAñadirCategoria"]))
    {
        require_once("Models\Categorias.php"); 
        $Cat=new Categorias();

        $Cat->set_CodCategoria($_POST['txtCodCategoria']);

        $Cat->set_Categoria($_POST['txtCategoria']);
        
        $Cat->AltaProducto();
 
    }
    /************************************************************Editar Categoriass*********************************************/



    /************************************************************Añadir Productos*********************************************/
    if(isset($_POST["btnAñadirProducto"]))
    {
        require_once("Models\Productos.php"); 
        $Prod=new Productos();

        $Prod->set_Nombre($_POST['txtNombre']);
        $Prod->set_Descripcion($_POST['txtDescripcion']);
        $Prod->set_PrecioUnitario($_POST['txtPrecioUnitario']);
        $Prod->set_Categoria($_POST['txtCategoria']);
        $Prod->set_SubCategoria($_POST['txtSubCategoria']);

        $Prod->AltaProducto();
 
    }
     /************************************************************Editar Productos*********************************************/

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


<form action="" method="post">
        <!-- START THE FEATURETTES -->
        <table class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
          col-12">
            <td> 
                <div class="dropdown ">
                <button class="btn btn-dark dropdown-toggle" type="button" id="ddClientes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clientes
                </button>
                <div class="dropdown-menu" aria-labelledby="ddClientes">
                    <button class="dropdown-item" id="btnListarClientes" name="btnListarClientes" type="submit">Listar Clientes</button>
                    <button class="dropdown-item" id="btnListarCompras" name="btnListarCompras" type="submit">Compras</button>
                </div>
                </div>
            </td>
            <td>
                <div class="dropdown ">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="ddProductos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ddProductos">
                        <button class="dropdown-item" id="btnListarProductos" name="btnListarProductos" type="submit">Listar Productos</button>
                        <button class="dropdown-item" id="btnListarCategorias" name="btnListarCategorias" type="submit">Listar Categorias</button>
                    </div>
                </div>
            </td>
            <td>
                <div class="dropdown ">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="ddAdministradores" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administradores
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ddAdministradores">
                        <button class="dropdown-item" id="btnListarAdmins" name="btnListarAdmins" type="submit">Listar Administradores</button>
                    </div>
                </div>
            </td>
        </table>
       

        
           

        </div>
        <hr class="featurette-divider">

        <div class="table-responsive col-lg-0 offset-lg-2 col-md-9 offset-md-0">
          <table class="table col-lg-0 offset-lg-0 col-md-4 offset-md-2">
            <?php
            /***************************************Listar Clientes****************************************************** */
                if(isset ($_POST["btnListarClientes"]))
                { require_once("Models\Clientes.php"); 
                    echo'<thead>';
                        echo '<tr>';
                            echo '<th scope="col">#</th>';
                            echo '<th scope="col">Codigo</th>';
                            echo  '<th scope="col">Username</th>';
                            echo '<th scope="col">Contraseña</th>';
                            echo '<th scope="col">Nombre</th>';
                            echo '<th scope="col">Apellidos</th>';
                            echo '<th scope="col">Email</th>';
                            echo '<th scope="col">Sexo</th>';
                            echo '<th scope="col">Teléfono</th>';
                            echo '<th scope="col">D.N.I.</th>';
                            echo '<th scope="col">Dirección</th>';
                            echo '<th scope="col">Fecha Alta</th>';
                            echo '<th scope="col">Saldo</th>';
                            echo'<th scope="col"></th>';
                        echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $Cli=new cliente();
                    $resultado=$Cli->MostrarCliente();
                    while($fila=mysqli_fetch_array($resultado))
                    {
                        echo '<tr>';
                        echo'<form method="post" action="'.$_SERVER['PHP_SELF'].'">';

                            echo '<td><input type="submit" value="Editar" name="btEditCliente"></td>';
                            echo '<td><input type="text" name="txtCodigo" value="'.$fila['codigo'].'" readonly/></td>';
                            echo '<td><input type="text" name="txtUsername" value="'.$fila['Username'].'"/></td> ';
                            echo '<td><input type="text" name="txtPswd" value="'.$fila['password'].'"/></td> ';
                            echo '<td><input type="text" name="txtNombre" value="'.$fila['nombre'].'"/></td> ';
                            echo '<td><input type="text" name="txtApellidos" value="'.$fila['apellidos'].'"/></td> '; 
                            echo '<td><input type="text" name="txtEmail" value="'.$fila['email']  .'"/></td> ';
                            echo '<td><input type="text" name="txtSexo" value="'.$fila['sexo']  .'"/></td> ';   
                            echo '<td><input type="text" name="txtTelefono"  value="'.$fila['telefono']  .'"/></td> ';
                            echo '<td><input type="text" name="txtDNI"value="'.$fila['dni'].'"readonly /></td> ';
                            echo '<td><input type="text"  name="txtDireccion" value="'.$fila['direccion'] .'"/></td> ';
                            echo '<td><input type="text"  name="txtFechaAlta" value="'.$fila['fechaAlta'].'"readonly /></td> ';
                            echo '<td><input type="number"  name="txtSaldo" value="'.$fila['saldo'] .'"></td> ';
                            echo '<td><input type="submit" value="Delete" name="btEliminarCliente"/></td>';
                        echo '</form>';
                       echo'</tr>';
                    }
                    echo '<tr>';
                    echo'<form method="post" action="">';

                        echo '<td><input type="submit" value="Añadir" name="btnAñadirCliente"></td>';
                        echo '<td></td>';
                        echo '<td><input type="text" name="txtUsername" value=""/></td> ';
                        echo '<td><input type="text" name="txtPswd" value=""/></td> ';
                        echo '<td><input type="text" name="txtNombre" value=""/></td> ';
                        echo '<td><input type="text" name="txtApellidos" value=""/></td> '; 
                        echo '<td><input type="text" name="txtEmail" value=""/></td> ';
                        echo '<td><input type="text" name="txtSexo" value=""/></td> ';   
                        echo '<td><input type="text" name="txtTelefono"  value=""/></td> ';
                        echo '<td><input type="text" name="txtDNI"value="" /></td> ';
                        echo '<td><input type="text"  name="txtDireccion" value=""/></td> ';
                        echo '<td></td> ';
                        echo '<td></td> ';
                        echo '<td></td> ';
                        echo '</form>';
                   echo'</tr>';
                    echo '</tbody>';
                }
 /***************************************Listar Administradores****************************************************** */
                if(isset ($_POST["btnListarAdmins"]))
                { require_once("Models\Administradores.php"); 
                    echo'<thead>';
                        echo '<tr>';
                            echo '<th scope="col">#</th>';
                            echo '<th scope="col">CodAdmin</th>';
                            echo  '<th scope="col">Usuario</th>';
                            echo '<th scope="col">Password</th>';
                            echo '<th scope="col">Rango</th>';
                        echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $Admin=new Administradores();
                    $resultado=$Admin->MostrarAdmins();
                    while($fila=mysqli_fetch_array($resultado))
                    {
                        echo '<tr>';
                        echo'<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
                            if($_SESSION["Rango"]=="AA")
                            {
                                echo '<td><input type="submit" value="Editar" name="btEditAdmin"></td>';
                            }
                            else
                            {
                                echo '<td></td>';
                            }
                            echo '<td><input type="text" name="txtCodAdmin" value="'.$fila['CodAdmin'].'" readonly/></td>';
                            echo '<td><input type="text" name="txtUsuario" value="'.$fila['Usuario'].'"/></td> ';
                            echo '<td><input type="text" name="txtPassword" value="'.$fila['password'].'"/></td> ';
                            echo '<td><input type="text" name="txtRango" value="'.$fila['rango'].'" ';
                            if($_SESSION["Rango"]=="AA")
                            {
                            }
                            else
                            {
                                echo 'readonly';
                            }
                            echo '/></td> ';
                            if($_SESSION["Rango"]=="AA")
                            {
                                echo '<td><input type="submit" value="Delete" name="btnEliminarAdmin"/></td>';
                            }
                            else
                            {
                                echo '<td></td>';
                            }  
                            echo '<td></td>';
                            echo '</form>';
                       echo'</tr>';
                       
                    }

                    echo '<tr>';
                    echo'<form method="post" action="">';

                        echo '<td><input type="submit" value="Añadir" name="btnAñadirAdmin" /></td>';
                        echo '<td><input type="text" name="txtCodAdmin" /></td>';
                        echo '<td><input type="text" name="txtUsuario" /></td> ';
                        echo '<td><input type="text" name="txtPassword"/></td> ';
                        echo '<td><input type="text" name="txtRango"</td>'; 
                        
                        echo '</form>';
                   echo'</tr>';
                    echo '</tbody>';
                }
                /*************Lista Productos************* */
                if (isset ($_POST["btnListarProductos"]))
                {
                    require_once("Models\Productos.php");
                    require_once("Models\Categorias.php");

                    echo'<thead>';
                    echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">IdProducto</th>';
                        echo  '<th scope="col">Nombre</th>';
                        echo '<th scope="col">Descripción</th>';
                        echo '<th scope="col">Precio Unitario</th>';
                        echo '<th scope="col">Categoria</th>';
                        echo '<th scope="col">SubCategoria</th>';
                        echo '<th scope="col">Stock</th>';
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $Prod=new Productos();
                    $resultado=$Prod->MostrarProductos();
                    while($fila=mysqli_fetch_array($resultado))
                    {
                        echo '<tr>';
                        echo'<form method="get" action="'.$_SERVER['PHP_SELF'].'">';

                            echo '<td><input type="submit" value="Editar" name="btnEditarProducto"></td>';
                            echo '<td><input type="text" name="codigo" value="'.$fila['IdProducto'].'" readonly/></td>';
                            echo '<td><input type="text" name="txtNombre" value="'.$fila['Nombre'].'"/></td> ';
                            echo '<td><input type="text" name="txtDescripcion" value="'.$fila['Descripcion'].'"/></td> ';
                            echo '<td><input type="text" name="txtPrecioUnitario" value="'.$fila['PrecioUnitario'].'"/></td> ';
                            echo '<td><select name="txtCategoria"><option value="'.$fila['CCAt'].'">'.$fila['Categoria'].'</option>';
                            $Ca=new Categorias();
                            $resultadoCat=$Ca->MostrarCategorias();
                            while ($lineaCat = mysqli_fetch_array($resultadoCat)) 
                                {	
                                    echo'<option value="'.$lineaCat['CodCategoria'].'">'.$lineaCat['Categoria'].'</option>';
                                }
                            echo '</select></td>';

                            echo '<td><select name="txtSubCategoria"><option value="'.$fila['CSCAt'].'" >'.$fila['SubCategoria'].'</option>';
                            $Ca=new Categorias();
                            $resultadoCat=$Ca->MostrarCategorias();
                            while ($lineaCat = mysqli_fetch_array($resultadoCat)) 
                            {	
                                echo'<option value="'.$lineaCat['CodCategoria'].'">'.$lineaCat['Categoria'].'</option>';
                            }
                            echo '</select></td>';
                            echo '<td><input type="text" name="txtStock" value="'.$fila['Stock']  .'"/></td> ';
                        echo '</form>';
                       echo'</tr>';
                    }

                    echo '<tr>';
                    echo'<form method="post" action="">';

                        echo '<td><input type="submit" value="Añadir" name="btnAñadirProducto"></td>';
                        echo '<td></td>';
                        echo '<td><input type="text" name="txtNombre" /></td> ';
                        echo '<td><input type="text" name="txtDescripcion"/></td> ';
                        echo '<td><input type="text" name="txtPrecioUnitario"</td>';
                        /* Añadir Combobox */ 
                        echo '<td><select name="txtCategoria"><option value=""required>Selecciona Categoria</option>';
                        $Ca=new Categorias();
                        $resultadoCat=$Ca->MostrarCategorias();
	                	while ($lineaCat = mysqli_fetch_array($resultadoCat)) 
	            			{	
	            				echo'<option value="'.$lineaCat['CodCategoria'].'"required>'.$lineaCat['Categoria'].'</option>';
	            			}
					    echo '</select></td>';

                        /* Añadir Combobox */ 
                        echo '<td><select name="txtSubCategoria"><option value="" required>Selecciona SubCategoria</option>';
                        $Ca=new Categorias();
                        $resultadoCat=$Ca->MostrarCategorias();
	                	while ($lineaCat = mysqli_fetch_array($resultadoCat)) 
	            			{	
	            				echo'<option value="'.$lineaCat['CodCategoria'].'" required>'.$lineaCat['Categoria'].'</option>';
	            			}
					    echo '</select></td>';

                        echo '</form>';
                    echo'</tr>';
                    echo '</tbody>';
                }

                /*************Lista Categorias************* */
                if(isset ($_POST["btnListarCategorias"]))
                { require_once("Models\Categorias.php"); 
                    echo'<thead>';
                        echo '<tr>';
                            echo '<th scope="col">#</th>';
                            echo '<th scope="col">CodCategoria</th>';
                            echo  '<th scope="col">Categoria</th>';
                            echo '<th></th>';
                        echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $Cat=new Categorias();
                    $resultado=$Cat->MostrarCategorias();
                    while($fila=mysqli_fetch_array($resultado))
                    {
                       echo '<tr>';
                        echo'<form method="get" action="'.$_SERVER['PHP_SELF'].'">';
                            echo '<td><input type="submit" value="Editar" name="btnEditCategoria"></td>';
                            echo '<td><input type="text" name="txtCodCategoria" value="'.$fila['CodCategoria'].'" /></td>';
                            echo '<td><input type="text" name="txtCategoria" value="'.$fila['Categoria'].'" /></td>';
                            echo '<td><input type="submit" value="Delete" name="btnEliminarCategoria"/></td>';
                        echo '</form>';
                       echo'</tr>';
                       
                    }

                    echo '<tr>';
                    echo'<form method="post" action="">';
                        echo '<td><input type="submit" value="Añadir" name="btnAñadirCategoria"></td>';
                        echo '<td><input type="text" name="txtCodCategoria" /></td>';
                        echo '<td><input type="text" name="txtCategoria" /></td> ';                        
                    echo '</form>';
                    echo'</tr>';
                    echo '</tbody>';
                }

                /*****Lista de todas las ventas ******/
                if(isset ($_POST["btnListarCompras"]))
                { require_once("Models\Ventas.php"); 
                    echo'<thead>';
                        echo '<tr>';
                            echo '<th scope="col">#</th>';
                            echo '<th scope="col">CodVenta</th>';
                            echo  '<th scope="col">Cliente</th>';
                            echo '<th scope="col">Precio Total</th>';
                            echo '<th scope="col">Fecha Compra</th>';
                            echo '<th></th>';
                        echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $Venta=new ventas();
                    $resultado=$Venta->ListaVentas();
                    while($fila=mysqli_fetch_array($resultado))
                    {
                       echo '<tr>';
                        echo'<form method="post" action="">';
                            echo '<td><input type="submit" value="Detalles" name="btnDetalle"></td>';
                            echo '<td><input type="number" name="txtCodVenta" value="'.$fila['CodVenta'].'" readonly/></td>';
                            echo '<td><input type="text" name="txtCliente" value="'.$fila['Cliente'].'" readonly/></td>';
                            echo '<td><input type="number" name="txtPreciTotal" value="'.$fila['PrecioTotal'].'" readonly/></td>';
                            echo '<td><input type="date" name="txtCliente" value="'.$fila['FechaCompra'].'" readonly/></td>';
                        echo '</form>';
                       echo'</tr>';
                       
                    }
                }
                /* Lista Detalle Ventas */
                if(isset($_POST['btnDetalle']))
                {
                    require_once("Models\DetalleVentas.php"); 
                    echo'<thead>';
                        echo '<tr>';
                            echo '<th scope="col">CodVenta</th>';
                            echo  '<th scope="col">Producto</th>';
                            echo '<th scope="col">Cantidad</th>';
                            echo '<th scope="col">Precio del Producto</th>';
                            echo '<th scope="col">Total Por el Producto</th>';
                            echo '<th></th>';
                        echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    $DVenta=new detalleVentas();
                    $resultado=$DVenta->ListaDetalleVenta($_POST["txtCodVenta"]);
                    while($fila=mysqli_fetch_array($resultado))
                    {
                       echo '<tr>';
                        echo'<form method="get" action="'.$_SERVER['PHP_SELF'].'">';
                            echo '<td><input type="number" name="txtCodVenta" value="'.$fila['CodVenta'].'" readonly/></td>';
                            echo '<td><input type="text" name="txtProducto" value="'.$fila['Producto'].'" readonly/></td>';
                            echo '<td><input type="number" name="txtCantidad" value="'.$fila['Cantidad'].'" readonly/></td>';
                            echo '<td><input type="number" name="txtPrecioUnitario" value="'.$fila['PrecioUnitario'].'" readonly/></td>';
                            echo '<td><input type="number" name="txtTotal" value="'.$fila['TotalPorProducto'].'" readonly/></td>';
                        echo '</form>';
                       echo'</tr>';
                    }
                }

            ?>
          </table>
        </div>
</form>
       
        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
      
    </main>



  </body>
</html>