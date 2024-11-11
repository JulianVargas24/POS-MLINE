<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <?php

            if ($_SESSION["perfil"] == "Administrador") {
                echo '<li>
                            <a href="inicio">
                                <i class="fa fa-home"></i>
                                <span>Inicio</span>
                            </a>
                        </li>';
                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {
                    echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Configuraciones</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">	
                                <li>
                                    <a href="usuarios">	  
                                        <i class="fa fa-circle-o"></i>                             
                                        Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="plantel">
                                        <i class="fa fa-circle-o"></i> 
                                        Plantel
                                    </a>
                                </li>						
                            </ul>
                          </li>';
                    echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Parámetros</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="parametros-generales">
                                        <i class="fa fa-circle-o"></i>
                                        Generales
                                    </a>
                                </li>
                                <li>
                                    <a href="parametros-documentos">
                                        <i class="fa fa-circle-o"></i>
                                        Documentos
                                    </a>
                                </li>
                                <li>
                                    <a href="parametros-impresion">
                                        <i class="fa fa-circle-o"></i>
                                        Impresión
                                    </a>
                                </li>
                                <li>
                                    <a href="bancos">
                                        <i class="fa fa-circle-o"></i>
                                        Bancos
                                    </a>
                                </li>
                                <li>
                                    <a href="sucursales">
                                        <i class="fa fa-circle-o"></i>
                                        Sucursales
                                    </a>
                                </li>
                                <li>
                                    <a href="matriz">
                                        <i class="fa fa-circle-o"></i>
                                        Matriz
                                    </a>
                                </li>
                                <li>
                                    <a href="tabla-listas">
                                        <i class="fa fa-circle-o"></i>
                                        Tabla para listas
                                    </a>
                                </li>											
                            </ul>
                        </li>';
                    echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i>
                                <span>Maestro</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="categorias">
                                        <i class="fa fa-circle-o"></i>
                                        Categorías
                                    </a>
                                </li>
                                <li>			
                                    <a href="subcategorias">
                                        <i class="fa fa-circle-o"></i>
                                        Subcategorías
                                    </a>
                                </li>
                                <li>
                                    <a href="bodegas">
                                        <i class="fa fa-circle-o"></i>
                                        Bodegas
                                    </a>
                                </li>
                                <li>
                                    <a href="plazos">
                                        <i class="fa fa-circle-o"></i>
                                        Plazos de pago
                                    </a>
                                </li>
                                <li>
                                    <a href="listas">
                                        <i class="fa fa-circle-o"></i>
                                        Listas de precios
                                    </a>
                                </li>
                                <li>
                                    <a href="unidades">
                                        <i class="fa fa-circle-o"></i>
                                        Unidades
                                    </a>
                                </li>
                                <li>
                                    <a href="medios-pago">
                                        <i class="fa fa-circle-o"></i>
                                        Medios de pago
                                    </a>
                                </li>
                                <li>
                                    <a href="impuestos">
                                        <i class="fa fa-circle-o"></i>
                                        Impuestos
                                    </a>
                                </li>
                                <li>
                                    <a href="rubros">
                                        <i class="fa fa-circle-o"></i>										
                                        Rubros
                                    </a>
                                </li>									
                            </ul>
                        </li>';
                    echo '<li class="treeview">		
                            <a href="#">		
                                <i class="fa fa-bank"></i>								
                                    <span>Adquisiciones</span>								
                                    <span class="pull-right-container">								
                                        <i class="fa fa-angle-left pull-right"></i>		
                                    </span>		
                            </a>
                            <ul class="treeview-menu">
                                <li>		
                                    <a href="proveedores">
                                        <i class="fa fa-circle-o"></i>										
                                        Proveedores
                                    </a>		
                                </li>
                                <li>		
                                    <a href="centro-costo">
                                        <i class="fa fa-circle-o"></i>										
                                        Centro de costos
                                    </a>	
                                </li>		
                                <li>		
                                    <a href="compras">
                                        <i class="fa fa-circle-o"></i>											
                                        Admin. compras	
                                    </a>		
                                </li>
                                <li>
                                    <a href="ordenes-compra">
                                        <i class="fa fa-circle-o"></i>											
                                        Administrar O.C
                                    </a>
                                </li>		
                            </ul>
                        </li>';
                    echo '<li class="treeview">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Inventario</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="productos">
                                        <i class="fa fa-circle-o"></i>									
                                        Productos
                                    </a>
                                </li>							
                                <li>		
                                    <a href="entrada">	
                                        <i class="fa fa-circle-o"></i>								
                                        Entradas
                                    </a>							
                                </li>
                                <li>	
                                    <a href="salida">
                                        <i class="fa fa-circle-o"></i>									
                                        Salidas
                                    </a>
                                </li>							
                                <li>		
                                    <a href="ajuste">
                                        <i class="fa fa-circle-o"></i>									
                                        Ajustes
                                    </a>								
                                </li>
                                <li>
                                    <a href="productos-bodega">
                                        <i class="fa fa-circle-o"></i>							
                                        Productos-Bodega
                                    </a>
                                </li>						
                            </ul>
                        </li>';
                    echo '<li class="treeview">
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
                                                              
                                <li>
                                    <a href="orden-trabajo">
                                        <i class="fa fa-circle-o"></i>							
                                        Administrador OTV
                                    </a>
                                </li>
                                <li>		
                                     <a href="personal">
                                        <i class="fa fa-circle-o"></i>							
                                        Personal vestuario
                                    </a>
                                </li>
                                <li>
                                    <a href="orden-vestuario">
                                        <i class="fa fa-circle-o"></i>							
                                        Orden de vestuario
                                    </a>
                                </li>
                                <li style="padding: 5px 15px; color: #fff;">
                                    OT Producción
                                </li>
                                                              
                                <li>
                                    <a href="admin-orden-produccion">
                                        <i class="fa fa-circle-o"></i>							
                                        Administrador OTP
                                    </a>
                                </li>
                                <li>		
                                    <a href="orden-produccion">
                                        <i class="fa fa-circle-o"></i>							
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
                echo '<li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Ventas</span>					
                            <span class="pull-right-container">					
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">								
                            <li>
                                <a href="clientes">
                                    <i class="fa fa-circle-o"></i>							
                                    Clientes
                                </a>
                            </li>
                            <li>
                                <a href="ventas">
                                    <i class="fa fa-circle-o"></i>							
                                    Administrar ventas
                                </a>
                            </li>
                            <li>
                                <a href="cotizaciones">
                                    <i class="fa fa-circle-o"></i>							
                                    Admin. cotizaciones
                                </a>
                            </li>										
                            <li>
                                <a href="cotizacion">
                                    <i class="fa fa-circle-o"></i>							
                                    Cotización afecta
                                </a>
                            </li>
                            <li>
                                <a href="cotizacion-exenta">
                                    <i class="fa fa-circle-o"></i>							
                                    Cotización exenta
                                </a>
                            </li>
                            <li>
                                <a href="venta-boleta">
                                    <i class="fa fa-circle-o"></i>							
                                    Boleta afecta
                                </a>
                            </li>
                            <li>
                                <a href="boleta-exenta">
                                    <i class="fa fa-circle-o"></i>							
                                    Boleta exenta
                                </a>
                            </li>
                            <li>
                                <a href="venta-factura">
                                    <i class="fa fa-circle-o"></i>					
                                    Venta Factura afecta
                                </a>
                            </li>
                            <li>
                                <a href="venta-factura-exenta">
                                    <i class="fa fa-circle-o"></i>						
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
                echo '<li class="treeview">
                        <a href="#">
                            <i class="fa fa-address-book"></i>
                            <span>Comercial</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">									
                            <li>
                                <a href="unidad-negocio">
                                    <i class="fa fa-circle-o"></i>							
                                    Unidades de negocios
                                </a>
                            </li>
                            <li>
                                <a href="lista-precios">
                                    <i class="fa fa-circle-o"></i>							
                                    Lista de precios
                                </a>
                            </li>
                            <li>
                                <a href="tipo-cliente">
                                    <i class="fa fa-circle-o"></i>							
                                    Tipos de campaña
                                </a>
                            </li>								
                            <li>
                                <a href="tipo-producto">
                                    <i class="fa fa-circle-o"></i>						
                                    Tipos de productos
                                </a>
                            </li>
                        </ul>
                      </li>';
            }
            echo '<li class="treeview">
                        <a href="#">    
                            <i class="fa fa-shopping-bag"></i>                        
                            <span>Tesorería</span>                        
                            <span class="pull-right-container">                        
                                <i class="fa fa-angle-left pull-right"></i>    
                            </span>   
                        </a>   
                        <ul class="treeview-menu">                                          
                            <li>  
                                <a href="cierre-caja">
                                    <i class="fa fa-circle-o"></i>                                
                                    Cierre de caja
                                </a> 
                            </li>
                        </ul>  
                     </li> ';
            ?>
        </ul>
    </section>
</aside>

<script src="vistas/js/menu.js"></script>