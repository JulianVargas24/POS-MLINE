<aside class="main-sidebar fixed">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <?php
            $paginaActual = $_GET["ruta"];
            // Verificar si la página actual está en un conjunto de rutas
            function isActive($paginaActual, $rutas)
            {
                return in_array($paginaActual, (array)$rutas) ? 'active' : '';
            }

            //Rellenar el circulo dependiendo de si estamos en la página actual o no
            function marcarCirculo($paginaActual, $rutas)
            {
                return in_array($paginaActual, (array)$rutas) ? 'fa fa-circle' : 'fa fa-circle-o';
            }

            if ($_SESSION["perfil"] == "Administrador") {
                echo '<li class="' . isActive($paginaActual, 'inicio') . '">
                            <a href="inicio">
                                <i class="fa fa-home"></i>
                                <span>Inicio</span>
                            </a>
                        </li>';
                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {
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
                                        Usuarios
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'plantel') . '">
                                    <a href="plantel">
                                        <i class="' . marcarCirculo($paginaActual, 'plantel') . '"></i>
                                        Plantel
                                    </a>
                                </li>						
                            </ul>
                          </li>';
                    echo '<li class="treeview ' . isActive($paginaActual, ['parametros-generales', 'parametros-documentos'
                            , 'parametros-impresion', 'bancos', 'sucursales', 'matriz', 'tabla-listas']) . '">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Parámetros</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="' . isActive($paginaActual, 'parametros-generales') . '">
                                    <a href="parametros-generales">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-generales') . '"></i>
                                        Generales
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'parametros-documentos') . '">
                                    <a href="parametros-documentos">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-documentos') . '"></i>
                                        Documentos
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'parametros-impresion') . '">
                                    <a href="parametros-impresion">
                                        <i class="' . marcarCirculo($paginaActual, 'parametros-impresion') . '"></i>
                                        Impresión
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'bancos') . '">
                                    <a href="bancos">
                                        <i class="' . marcarCirculo($paginaActual, 'bancos') . '"></i>
                                        Bancos
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'sucursales') . '">
                                    <a href="sucursales">
                                        <i class="' . marcarCirculo($paginaActual, 'sucursales') . '"></i>
                                        Sucursales
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'matriz') . '">
                                    <a href="matriz">
                                        <i class="' . marcarCirculo($paginaActual, 'matriz') . '"></i>
                                        Matriz
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'tabla-listas') . '">
                                    <a href="tabla-listas">
                                        <i class="' . marcarCirculo($paginaActual, 'tabla-listas') . '"></i>
                                        Tabla para listas
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
                                        Categorías
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'subcategorias') . '">			
                                    <a href="subcategorias">
                                        <i class="' . marcarCirculo($paginaActual, 'subcategorias') . '"></i>
                                        Subcategorías
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'bodegas') . '">
                                    <a href="bodegas">
                                        <i class="' . marcarCirculo($paginaActual, 'bodegas') . '"></i>
                                        Bodegas
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'plazos') . '">
                                    <a href="plazos">
                                        <i class="' . marcarCirculo($paginaActual, 'plazos') . '"></i>
                                        Plazos de pago
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'listas') . '">
                                    <a href="listas">
                                        <i class="' . marcarCirculo($paginaActual, 'listas') . '"></i>
                                        Listas de precios
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'unidades') . '">
                                    <a href="unidades">
                                        <i class="' . marcarCirculo($paginaActual, 'unidades') . '"></i>
                                        Unidades
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'medios-pago') . '">
                                    <a href="medios-pago">
                                        <i class="' . marcarCirculo($paginaActual, 'medios-pago') . '"></i>
                                        Medios de pago
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'impuestos') . '">
                                    <a href="impuestos">
                                        <i class="' . marcarCirculo($paginaActual, 'impuestos') . '"></i>
                                        Impuestos
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'rubros') . '">
                                    <a href="rubros">										
                                        <i class="' . marcarCirculo($paginaActual, 'rubros') . '"></i>
                                        Rubros
                                    </a>
                                </li>									
                            </ul>
                        </li>';
                    echo '<li class="treeview ' . isActive($paginaActual, ['proveedores', 'centro-costo'
                            , 'compras', 'compra', 'editar-compra', 'ordenes-compra', 'orden-compra', 'editar-orden-compra']) . '">		
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
                                        Proveedores
                                    </a>		
                                </li>
                                <li class="' . isActive($paginaActual, 'centro-costo') . '">		
                                    <a href="centro-costo">										
                                        <i class="' . marcarCirculo($paginaActual, 'centro-costo') . '"></i>
                                        Centro de costos
                                    </a>	
                                </li>		
                                <li class="' . isActive($paginaActual, ['compras', 'compra', 'editar-compra']) . '">		
                                    <a href="compras">											
                                        <i class="' . marcarCirculo($paginaActual, ['compras', 'compra', 'editar-compra']) . '"></i>
                                        Admin. compras	
                                    </a>		
                                </li>
                                <li class="' . isActive($paginaActual, ['ordenes-compra', 'orden-compra', 'editar-orden-compra']) . '">
                                    <a href="ordenes-compra">											
                                        <i class="' . marcarCirculo($paginaActual, ['ordenes-compra', 'orden-compra', 'editar-orden-compra']) . '"></i>
                                        Administrar O.C
                                    </a>
                                </li>		
                            </ul>
                        </li>';
                    echo '<li class="treeview ' . isActive($paginaActual, ['productos', 'entrada', 'entradas'
                            , 'salida', 'salidas', 'ajuste', 'ajustes', 'productos-bodega']) . '">
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
                                        Productos
                                    </a>
                                </li>							
                                <li class="' . isActive($paginaActual, ['entrada', 'entradas']) . '">		
                                    <a href="entrada">									
                                        <i class="' . marcarCirculo($paginaActual, ['entrada', 'entradas']) . '"></i>
                                        Entradas
                                    </a>							
                                </li>
                                <li class="' . isActive($paginaActual, ['salida', 'salidas']) . '">	
                                    <a href="salida">									
                                        <i class="' . marcarCirculo($paginaActual, ['salida', 'salidas']) . '"></i>
                                        Salidas
                                    </a>
                                </li>							
                                <li class="' . isActive($paginaActual, ['ajuste', 'ajustes']) . '">		
                                    <a href="ajuste">									
                                        <i class="' . marcarCirculo($paginaActual, ['ajuste', 'ajustes']) . '"></i>
                                        Ajustes
                                    </a>								
                                </li>
                                <li class="' . isActive($paginaActual, ['productos-bodega']) . '">
                                    <a href="productos-bodega">							
                                        <i class="' . marcarCirculo($paginaActual, 'productos-bodega') . '"></i>
                                        Productos-Bodega
                                    </a>
                                </li>						
                            </ul>
                        </li>';
                    echo '<li class="treeview ' . isActive($paginaActual, ['orden-trabajo', 'personal'
                            , 'orden-vestuario', 'admin-orden-produccion']) . '">
                            <a href="#">
                                <i class="fa fa-file"></i>						
                                <span>Orden de trabajo</span>						
                                <span class="pull-right-container">						    
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">    
                                <li style="padding: 5px 15px; color: #fff;">
                                    OT Vestuario
                                </li>
                                                              
                                <li class="' . isActive($paginaActual, 'orden-trabajo') . '">
                                    <a href="orden-trabajo">							
                                        <i class="' . marcarCirculo($paginaActual, 'orden-trabajo') . '"></i>
                                        Administrador OTV
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'personal') . '">		
                                     <a href="personal">							
                                         <i class="' . marcarCirculo($paginaActual, 'personal') . '"></i>
                                        Personal vestuario
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'orden-vestuario') . '">
                                    <a href="orden-vestuario">							
                                        <i class="' . marcarCirculo($paginaActual, 'orden-vestuario') . '"></i>
                                        Orden de vestuario
                                    </a>
                                </li>
                                <li style="padding: 5px 15px; color: #fff;">
                                    OT Producción
                                </li>
                                                              
                                <li class="' . isActive($paginaActual, 'admin-orden-produccion') . '">
                                    <a href="admin-orden-produccion">							
                                        <i class="' . marcarCirculo($paginaActual, 'admin-orden-produccion') . '"></i>
                                        Administrador OTP
                                    </a>
                                </li>
                                <li class="' . isActive($paginaActual, 'personal') . '">		
                                    <a href="orden-produccion">							
                                        <i class="' . marcarCirculo($paginaActual, 'personal') . '"></i>
                                        Orden de producción
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
            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
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
                                    Clientes
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'ventas') . '">
                                <a href="ventas">							
                                    <i class="' . marcarCirculo($paginaActual, 'ventas') . '"></i>
                                    Administrar ventas
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'cotizaciones') . '">
                                <a href="cotizaciones">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizaciones') . '"></i>
                                    Admin. cotizaciones
                                </a>
                            </li>										
                            <li class="' . isActive($paginaActual, 'cotizacion') . '">
                                <a href="cotizacion">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizacion') . '"></i>
                                    Cotización afecta
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'cotizacion-exenta') . '">
                                <a href="cotizacion-exenta">							
                                    <i class="' . marcarCirculo($paginaActual, 'cotizacion-exenta') . '"></i>
                                    Cotización exenta
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-boleta') . '">
                                <a href="venta-boleta">							
                                    <i class="' . marcarCirculo($paginaActual, 'venta-boleta') . '"></i>
                                    Boleta afecta
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'boleta-exenta') . '">
                                <a href="boleta-exenta">							
                                    <i class="' . marcarCirculo($paginaActual, 'boleta-exenta') . '"></i>
                                    Boleta exenta
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-factura') . '">
                                <a href="venta-factura">					
                                    <i class="' . marcarCirculo($paginaActual, 'venta-factura') . '"></i>
                                    Venta Factura afecta
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'venta-factura-exenta') . '">
                                <a href="venta-factura-exenta">						
                                    <i class="' . marcarCirculo($paginaActual, 'venta-factura-exenta') . '"></i>
                                    Venta factura exenta
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
                                    Unidades de negocios
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'lista-precios') . '">
                                <a href="lista-precios">							
                                    <i class="' . marcarCirculo($paginaActual, 'lista-precios') . '"></i>
                                    Lista de precios
                                </a>
                            </li>
                            <li class="' . isActive($paginaActual, 'tipo-cliente') . '">
                                <a href="tipo-cliente">							
                                    <i class="' . marcarCirculo($paginaActual, 'tipo-cliente') . '"></i>
                                    Tipos de campaña
                                </a>
                            </li>								
                            <li class="' . isActive($paginaActual, 'tipo-producto') . '">
                                <a href="tipo-producto">						
                                    <i class="' . marcarCirculo($paginaActual, 'tipo-producto') . '"></i>
                                    Tipos de productos
                                </a>
                            </li>
                        </ul>
                      </li>';
            }
            echo '<li class="treeview ' . isActive($paginaActual, 'cierre-caja') . '">
                        <a href="#">    
                            <i class="fa fa-shopping-bag"></i>                        
                            <span>Tesorería</span>                        
                            <span class="pull-right-container">                        
                                <i class="fa fa-angle-left pull-right"></i>    
                            </span>   
                        </a>   
                        <ul class="treeview-menu">                                          
                            <li class="' . isActive($paginaActual, 'cierre-caja') . '">  
                                <a href="cierre-caja">                                
                                    <i class="' . marcarCirculo($paginaActual, 'cierre-caja') . '"></i>
                                    Cierre de caja
                                </a> 
                            </li>
                        </ul>  
                     </li> ';
            ?>
        </ul>
    </section>
</aside>

<script src="vistas\js\menu.js"></script>