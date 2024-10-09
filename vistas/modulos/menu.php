<aside class="main-sidebar">
    <section class="sidebar">
		<ul class="sidebar-menu">

            <?php
            $paginaActual = $_GET["ruta"];

            // Verificar si la página actual está en un conjunto de rutas
            function isActive($paginaActual, $rutas) {
                return in_array($paginaActual, (array)$rutas) ? 'active' : '';
            }
            //Rellenar el circulo dependiendo de si estamos en la página actual o no
            function marcarCirculo($paginaActual, $rutas) {
                return $paginaActual == $rutas ? 'fa fa-circle' : 'fa fa-circle-o';
            }

            if($_SESSION["perfil"] == "Administrador"){
                    echo '<li class="' . isActive($paginaActual, 'inicio') . '">
                            <a href="inicio">
                                <i class="fa fa-home"></i>
                                <span>Inicio</span>
                            </a>
                        </li>';

                if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

                    echo '<li class="treeview ' . isActive($paginaActual, ['usuarios', 'plantel']) . '">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Configuraciones</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">	
                                <li class="' . isActive($paginaActual, 'usuarios') . '">
                                    <a href="usuarios">	
                                        <i class="' . marcarCirculo($paginaActual, 'usuarios') . '"></i>
                                            <span>Usuarios</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'plantel') . '">
                                    <a href="plantel">
                                        <i class="' . marcarCirculo($paginaActual, 'plantel') . '"></i>
                                            <span>Plantel</span>
                                    </a>
                                </li>						
                            </ul>
                          </li>';

                    echo '<li class="treeview ' . isActive($paginaActual, ['parametros-generales', 'parametros-documentos'
                            , 'parametros-impresion', 'bancos', 'sucursales', 'matriz', 'tabla-listas']) . '">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Parametros</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'parametros-generales') . '">
                                    <a href="parametros-generales">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-generales') . '"></i>
                                        <span>Generales</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'parametros-documentos') . '">
                                    <a href="parametros-documentos">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-documentos') . '"></i>
                                        <span>Documentos</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'parametros-impresion') . '">
                                    <a href="parametros-impresion">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-impresion') . '"></i>
                                        <span>Impresion</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'bancos') . '">
                                    <a href="bancos">
                                        <i class="' . marcarCirculo($paginaActual, 'bancos') . '"></i>
                                        <span>Bancos</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'sucursales') . '">
                                    <a href="sucursales">
                                        <i class="' . marcarCirculo($paginaActual, 'sucursales') . '"></i>
                                        <span>Sucursales</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'matriz') . '">
                                    <a href="matriz">
                                        <i class="' . marcarCirculo($paginaActual, 'matriz') . '"></i>
                                            <span>Matriz</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'tabla-listas') . '">
                                    <a href="tabla-listas">
                                        <i class="' . marcarCirculo($paginaActual, 'tabla-listas') . '"></i>
                                            <span>Tabla para Listas</span>
                                    </a>
                                </li>											
                            </ul>
                        </li>';

                    echo '<li class="treeview ' . isActive($paginaActual, ['categorias', 'subcategorias'
                            , 'bodegas', 'plazos', 'listas', 'unidades', 'medios-pago', 'impuestos', 'rubros']) . '">
                            <a href="#">
                                <i class="fa fa-archive"></i>
                                <span>Maestro</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'categorias') . '">
                                    <a href="categorias">
                                        <i class="' . marcarCirculo($paginaActual, 'categorias') . '"></i>
                                            <span>Categorias</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'subcategorias') . '">			
                                    <a href="subcategorias">
                                        <i class="' . marcarCirculo($paginaActual, 'subcategorias') . '"></i>
                                            <span>Subcategorias</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'bodegas') . '">
                                    <a href="bodegas">
                                        <i class="' . marcarCirculo($paginaActual, 'bodegas') . '"></i>
                                            <span>Bodegas</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'plazos') . '">
                                    <a href="plazos">
                                        <i class="' . marcarCirculo($paginaActual, 'plazos') . '"></i>
                                            <span>Plazo de Pago</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'listas') . '">
                                    <a href="listas">
                                        <i class="' . marcarCirculo($paginaActual, 'listas') . '"></i>
                                            <span>Lista de Precios</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'unidades') . '">
                                    <a href="unidades">
                                        <i class="' . marcarCirculo($paginaActual, 'unidades') . '"></i>
                                            <span>Unidades</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'medios-pago') . '">
                                    <a href="medios-pago">
                                        <i class="' . marcarCirculo($paginaActual, 'medios-pago') . '"></i>
                                            <span>Medios de Pago</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'impuestos') . '">
                                    <a href="impuestos">
                                        <i class="' . marcarCirculo($paginaActual, 'impuestos') . '"></i>
                                            <span>Impuestos</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'rubros') . '">
                                    <a href="rubros">										
                                        <i class="' . marcarCirculo($paginaActual, 'rubros') . '"></i>
                                            <span>Rubros</span>
                                        </a>
                                </li>									
                            </ul>
                        </li>';

                    echo '<li class="treeview ' . isActive($paginaActual, ['proveedores', 'centro-costo'
                            , 'compras', 'ordenes-compra']) . '">		
                            <a href="#">		
                                <i class="fa fa-bank"></i>								
                                    <span>Adquisiciones</span>								
                                    <span class="pull-right-container">								
                                        <i class="fa fa-angle-left pull-right"></i>		
                                    </span>		
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'proveedores') . '">		
                                    <a href="proveedores">										
                                        <i class="' . marcarCirculo($paginaActual, 'proveedores') . '"></i>
                                            <span>Proveedores</span>		
                                    </a>		
                                </li>
                                <li class="' . isActive($paginaActual, 'centro-costo') . '">		
                                    <a href="centro-costo">										
                                        <i class="' . marcarCirculo($paginaActual, 'centro-costo') . '"></i>
                                        <span>Centro de Costos</span>	
                                    </a>	
                                </li>		
                                <li class="' . isActive($paginaActual, 'compras') . '">		
                                    <a href="compras">											
                                        <i class="' . marcarCirculo($paginaActual, 'compras') . '"></i>
                                        <span>Admin. Compras</span>		
                                    </a>		
                                </li>
                                <li class="' . isActive($paginaActual, 'ordenes-compra') . '">
                                    <a href="ordenes-compra">											
                                        <i class="' . marcarCirculo($paginaActual, 'ordenes-compra') . '"></i>
                                            <span>Administrador O.C</span>
                                    </a>
                                </li>		
                            </ul>
                        </li>';

                    echo '<li class="treeview ' . isActive($paginaActual, ['productos', 'entrada'
                            , 'salida', 'ajuste', 'productos-bodega']) . '">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Inventario</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'productos') . '">
                                    <a href="productos">									
                                        <i class="' . marcarCirculo($paginaActual, 'productos') . '"></i>
                                        <span>Productos</span>
                                    </a>
                                </li>							
                                <li class="' . isActive($paginaActual, 'entrada') . '">		
                                    <a href="entrada">									
                                        <i class="' . marcarCirculo($paginaActual, 'entrada') . '"></i>
                                        <span>Entrada</span>
                                    </a>							
                                </li>
                                <li class="' . isActive($paginaActual, 'salida') . '">	
                                    <a href="salida">									
                                        <i class="' . marcarCirculo($paginaActual, 'salida') . '"></i>
                                        <span>Salida</span>
                                    </a>
                                </li>							
                                <li class="' . isActive($paginaActual, 'ajuste') . '">		
                                    <a href="ajuste">									
                                        <i class="' . marcarCirculo($paginaActual, 'ajuste') . '"></i>
                                        <span>Ajustes</span>
                                    </a>								
                                </li>
                                <li class="' . isActive($paginaActual, ['productos-bodega']) . '">
                                    <a href="productos-bodega">							
                                        <i class="' . marcarCirculo($paginaActual, 'productos-bodega') . '"></i>
                                        <span>Productos-Bodega</span>
                                    </a>
                                </li>						
                            </ul>
                        </li>';

                    echo '<li class="treeview ' . isActive($paginaActual, ['orden-trabajo', 'personal'
                            , 'orden-vestuario']) . '">
                            <a href="#">
                                <i class="fa fa-file"></i>						
                                <span>Orden de Trabajo</span>						
                                <span class="pull-right-container">						    
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'orden-trabajo') . '">
                                    <a href="orden-trabajo">							
                                        <i class="' . marcarCirculo($paginaActual, 'orden-trabajo') . '"></i>
                                        <span>Administrador O.T</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'personal') . '">		
                                    <a href="personal">							
                                        <i class="' . marcarCirculo($paginaActual, 'personal') . '"></i>
                                        <span>Personal Vestuario</span>
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'orden-vestuario') . '">
                                    <a href="orden-vestuario">							
                                        <i class="' . marcarCirculo($paginaActual, 'orden-vestuario') . '"></i>
                                        <span>Orden de Vestuario</span>
                                    </a>
                                </li>					
                            </ul>
                        </li>';
                }
            }

    /* LISTA CLIENTES ENVIADA A LISTA VENTAS

            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                echo '<li>
                    <a href="clientes">
                        <i class="fa fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>';
            }
    */
            if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                echo '<li class="treeview ' . isActive($paginaActual, ['clientes', 'ventas'
                        , 'cotizaciones', 'cotizacion', 'cotizacion-exenta', 'venta-boleta'
                        , 'boleta-exenta', 'venta-factura', 'venta-factura-exenta']) . '">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Ventas</span>					
                            <span class="pull-right-container">					
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">								
                            <li class="' . isActive($paginaActual, 'clientes') . '">
                                <a href="clientes">							
                                    <i class="' . marcarCirculo($paginaActual, 'clientes') . '"></i>
                                    <span>Clientes</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'ventas') . '">
                                <a href="ventas">							
                                    <i class="' . marcarCirculo($paginaActual, 'ventas') . '"></i>
                                    <span>Administrar Ventas</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'cotizaciones') . '">
                                <a href="cotizaciones">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizaciones') . '"></i>
                                    <span>Admin. Cotizaciones</span>
                                </a>
                            </li>										
                            <li class="' . isActive($paginaActual, 'cotizacion') . '">
                                <a href="cotizacion">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizacion') . '"></i>
                                    <span>Cotizacion Afecta</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'cotizacion-exenta') . '">
                                <a href="cotizacion-exenta">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizacion-exenta') . '"></i>
                                    <span>Cotizacion Exenta</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-boleta') . '">
                                <a href="venta-boleta">							
                                    <i class="' . marcarCirculo($paginaActual, 'venta-boleta') . '"></i>
                                    <span>Boleta Afecta</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'boleta-exenta') . '">
                                <a href="boleta-exenta">							
                                    <i class="' . marcarCirculo($paginaActual, 'boleta-exenta') . '"></i>
                                    <span>Boleta Exenta</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-factura') . '">
                                <a href="venta-factura">					
                                    <i class="' . marcarCirculo($paginaActual, 'venta-factura') . '"></i>
                                    <span>Venta Factura Afecta</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-factura-exenta') . '">
                                <a href="venta-factura-exenta">						
                                    <i class="' . marcarCirculo($paginaActual, 'venta-factura-exenta') . '"></i>
                                    <span>Venta Factura Exenta</span>
                                </a>
                            </li>
                        </ul>    
                     </li>';

                            /*<li>
                                <a href="nota-credito">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Nota de Credito</span>
                                </a>
                            </li>
                            <li>
                                <a href="nota-debito">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Nota de Debito</span>
                                </a>
                            </li>
                            */

                echo '<li class="treeview ' . isActive($paginaActual, ['unidad-negocio', 'lista-precios'
                        , 'tipo-cliente', 'tipo-producto']) . '">
                        <a href="#">
                            <i class="fa fa-address-book"></i>
                            <span>Comercial</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">									
                            <li class="' . isActive($paginaActual, 'unidad-negocio') . '">
                                <a href="unidad-negocio">							
                                    <i class="' . marcarCirculo($paginaActual, 'unidad-negocio') . '"></i>
                                    <span>Unidad de Negocios</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'lista-precios') . '">
                                <a href="lista-precios">							
                                    <i class="' . marcarCirculo($paginaActual, 'lista-precios') . '"></i>
                                    <span>Lista de Precios</span>
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'tipo-cliente') . '">
                                <a href="tipo-cliente">							
                                    <i class="' . marcarCirculo($paginaActual, 'tipo-cliente') . '"></i>
                                    <span>Tipo Campaña</span>
                                </a>
                            </li>								
                            <li class="' . isActive($paginaActual, 'tipo-producto') . '">
                                <a href="tipo-producto">						
                                    <i class="' . marcarCirculo($paginaActual, 'tipo-producto') . '"></i>
                                    <span>Tipo Producto</span>
                                </a>
                            </li>
                        </ul>
                      </li>';
            }

                echo '<li class="treeview ' . isActive($paginaActual, 'cierre-caja') . '">
                        <a href="#">    
                            <i class="fa fa-shopping-bag"></i>                        
                            <span>Tesoreria</span>                        
                            <span class="pull-right-container">                        
                                <i class="fa fa-angle-left pull-right"></i>    
                            </span>   
                        </a>   
                        <ul class="treeview-menu">                                          
                            <li class="' . isActive($paginaActual, 'cierre-caja') . '">  
                                <a href="cierre-caja">                                
                                    <i class="' . marcarCirculo($paginaActual, 'cierre-caja') . '"></i>
                                    <span>Cierre de Caja</span>   
                                </a> 
                            </li>
                        </ul>  
                     </li> ';
            ?>
		</ul>
    </section>
</aside>