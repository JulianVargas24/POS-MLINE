$(function(){
    var $nuevo = $("#form_nueva_categoria");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaCategoria", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar una Categoria Valida!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
             nuevaCategoria:{
                    required: true,
                    noSpace: true,
                    validaCategoria: true
                }
            },
            messages:{
             nuevaCategoria:{
                 required: 'Debes Ingresar una Categoria!'
             }
            },
       })  
     }
 })


 $(function(){
    var $nuevo = $("#form_editar_categoria");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaCategoria", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar una Categoria Valida!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
             editarCategoria:{
                    required: true,
                    noSpace: true,
                    validaCategoria: true
                }
            },
            messages:{
             editarCategoria:{
                 required: 'Debes Ingresar una Categoria!'
             }
            },
       })  
     }
 })


 $(function(){
    var $nuevo = $("#form_nuevo_usuario");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaUsuario", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9]+$/.test( value ); 
      }, "Por Favor Ingresar un Usuario Válido!");

      jQuery.validator.addMethod("validaPass", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9]+$/.test( value ); 
      }, "Por Favor Ingresar una Contraseña Válida!");


    if($nuevo.length){
        $nuevo.validate({
            rules:{
             nuevoNombre:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                nuevoUsuario:{
                    required: true,
                    noSpace: true,
                    validaUsuario: true
                },

                nuevoPassword:{
                    required: true,
                    noSpace: true,
                    validaPass: true
                },

                nuevoPerfil:{
                    required: true
                }

            },
            messages:{
             nuevoNombre:{
                 required: 'Debes Ingresar un Nombre!'
             },
             nuevoUsuario:{
                required: 'Debes Ingresar un Usuario!'
             },
             nuevoPassword:{
                required: 'Debes Ingresar una Contraseña!'
             },
             nuevoPerfil:{
                 required: 'Seleccione Un Perfil'
             }

            },
       })  
     }
 })

 $(function(){
    var $nuevo = $("#form_editar_usuario");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaUsuario", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9]+$/.test( value ); 
      }, "Por Favor Ingresar un Usuario Válido!");

      jQuery.validator.addMethod("validaPass", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9]+$/.test( value ); 
      }, "Por Favor Ingresar una Contraseña Válida!");


    if($nuevo.length){
        $nuevo.validate({
            rules:{
             editarNombre:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                editarUsuario:{
                    required: true,
                    noSpace: true,
                    validaUsuario: true
                },

                editarPassword:{
                   
                    noSpace: true
                },

                editarPerfil:{
                    required: true
                }

            },
            messages:{
             editarNombre:{
                 required: 'Debes Ingresar un Nombre!'
             },
             editarUsuario:{
                required: 'Debes Ingresar un Usuario!'
             },
        
             editarPerfil:{
                 required: 'Seleccione Un Perfil'
             }

            },
       })  
     }
 })


 $(function(){
    var $nuevo = $("#form_nuevo_proveedor");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");


      jQuery.validator.addMethod("validaCiudad", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar una Ciudad Válida!");

      jQuery.validator.addMethod("validaNro", function(value, element) { 
        return this.optional( element ) || /^[0-9]+$/.test( value ); 
      }, "Por Favor Ingresar una N° De Cuenta Válida!");

      jQuery.validator.addMethod("validaBanco", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Banco Válida!");

      jQuery.validator.addMethod("validaTelefono", function(value, element) { 
        return this.optional( element ) || /^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/.test( value ); 
      }, "Por Favor Ingresar una N° De Teléfono Válido!");

      jQuery.validator.addMethod("validaEmail", function(value, element) { 
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
      }, "Por Favor Ingresar una Email Válido!");


    if($nuevo.length){
        $nuevo.validate({
            rules:{
                nuevoProveedor:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                nuevoRutId:{
                    required: true,
                    noSpace: true,
                    validaRut: true
                },

                nuevaCiudad:{
                    required: true,
                    noSpace: true,
                    validaCiudad: true
                },

                nuevoNroCuenta:{
                    required: true,
                    noSpace: true,
                    validaNro: true
                },
                nuevoBanco:{
                    required: true,
                    noSpace: true,
                    validaBanco: true
                },
                nuevoTelefono:{
                    required: true,
                    noSpace: true,
                    validaTelefono: true
                },
                nuevoEmail:{
                    required: true,
                    noSpace: true,
                    validaEmail: true
                }

            },
            messages:{
                nuevoProveedor:{
                 required: 'Debes Ingresar un Nombre!'
             },
             nuevoRutId:{
                required: 'Debes Ingresar un Rut!'
             },
        
             nuevaCiudad:{
                 required: 'Debes Ingresar Una Ciudad'
             },
             nuevoNroCuenta:{
                 required: 'Debes Ingresar Un N° De Cuenta'
             },
             nuevoBanco:{
                 required: 'Debes Ingresar un Banco'
             },
             nuevoTelefono:{
                 required: 'Debes Ingresar Un N° Teléfono'
             },
             nuevoEmail:{
                 required: 'Debes Ingresar Un Email'
             }

            },
       })  
     }
 })

 $(function(){
    var $nuevo = $("#form_editar_proveedor");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaRut", function(value, element) { 
        return this.optional( element ) || /^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( value ); 
      }, "Por Favor Ingresar un Rut Válido!");

      jQuery.validator.addMethod("validaCiudad", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar una Ciudad Válida!");

      jQuery.validator.addMethod("validaNro", function(value, element) { 
        return this.optional( element ) || /^[0-9]+$/.test( value ); 
      }, "Por Favor Ingresar una N° De Cuenta Válida!");

      jQuery.validator.addMethod("validaBanco", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Banco Válida!");

      jQuery.validator.addMethod("validaTelefono", function(value, element) { 
        return this.optional( element ) || /^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/.test( value ); 
      }, "Por Favor Ingresar una N° De Teléfono Válido!");

      jQuery.validator.addMethod("validaEmail", function(value, element) { 
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
      }, "Por Favor Ingresar una Email Válido!");


    if($nuevo.length){
        $nuevo.validate({
            rules:{
                editarProveedor:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                editarRutId:{
                    required: true,
                    noSpace: true,
                    validaRut: true
                },

                editarCiudad:{
                    required: true,
                    noSpace: true,
                    validaCiudad: true
                },

                editarNroCuenta:{
                    required: true,
                    noSpace: true,
                    validaNro: true
                },
                editarBanco:{
                    required: true,
                    noSpace: true,
                    validaBanco: true
                },
                editarTelefono:{
                    required: true,
                    noSpace: true,
                    validaTelefono: true
                },
                editarEmail:{
                    required: true,
                    noSpace: true,
                    validaEmail: true
                }

            },
            messages:{
                editarProveedor:{
                 required: 'Debes Ingresar un Nombre!'
             },
             editarRutId:{
                required: 'Debes Ingresar un Rut!'
             },
        
             editarCiudad:{
                 required: 'Debes Ingresar Una Ciudad'
             },
             editarNroCuenta:{
                 required: 'Debes Ingresar Un N° De Cuenta'
             },
             editarBanco:{
                 required: 'Debes Ingresar un Banco'
             },
             editarTelefono:{
                 required: 'Debes Ingresar Un N° Teléfono'
             },
             editarEmail:{
                 required: 'Debes Ingresar Un Email'
             }

            },
       })  
     }
 })



 $(function(){
    var $nuevo = $("#form_nuevo_producto");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaPrecio", function(value, element) { 
        return this.optional( element ) || /^[0-9,.]+$/.test( value ); 
      }, "Por Favor Ingresar un Precio Válido!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
                nuevaCategoria:{
                    required: true
                   
                },
                nuevoProveedor:{
                    required: true                
                },

                nuevaDescripcion:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },

                nuevoStock:{
                    required: true,
                    noSpace: true
                   
                },
                nuevoPrecioCompra:{
                    required: true,
                    noSpace: true,
                    validaPrecio: true
                },
                nuevoPrecioVenta:{
                    required: true,
                    noSpace: true,
                    validaPrecio: true
                }

            },
            messages:{
                nuevaCategoria:{
                 required: 'Selecciona una Categoria!'
             },
             nuevoProveedor:{
                required: 'Selecciona un Proveedor!'
             },
        
             nuevaDescripcion:{
                 required: 'Debes Ingresar Un Producto'
             },
             nuevoStock:{
                 required: 'Debes Ingresar Un Stock'
             },
             nuevoPrecioCompra:{
                 required: 'Debes Ingresar un Precio de Compra'
             },
             nuevoPrecioVenta:{
                 required: 'Debes Ingresar Un Precio de Venta'
             }

            },
       })  
     }
 })


 $(function(){
    var $nuevo = $("#form_editar_producto");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaPrecio", function(value, element) { 
        return this.optional( element ) || /^[0-9,.]+$/.test( value ); 
      }, "Por Favor Ingresar un Precio Válido!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
                editarCategoria:{
                    required: true
                   
                },
                editarProveedor:{
                    required: true                
                },

                editarDescripcion:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },

                editarStock:{
                    required: true,
                    noSpace: true
                   
                },
                editarPrecioCompra:{
                    required: true,
                    noSpace: true,
                    validaPrecio: true
                },
                editarPrecioVenta:{
                    required: true,
                    noSpace: true,
                    validaPrecio: true
                }

            },
            messages:{
                editarCategoria:{
                 required: 'Selecciona una Categoria!'
             },
             editarProveedor:{
                required: 'Selecciona un Proveedor!'
             },
        
             editarDescripcion:{
                 required: 'Debes Ingresar Un Producto'
             },
             editarStock:{
                 required: 'Debes Ingresar Un Stock'
             },
             editarPrecioCompra:{
                 required: 'Debes Ingresar un Precio de Compra'
             },
             editarPrecioVenta:{
                 required: 'Debes Ingresar Un Precio de Venta'
             }

            },
       })  
     }
 })


 
 $(function(){
    var $nuevo = $("#form_nuevo_cliente");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaPrecio", function(value, element) { 
        return this.optional( element ) || /^[0-9,.]+$/.test( value ); 
      }, "Por Favor Ingresar un Precio Válido!");

      jQuery.validator.addMethod("validaRut", function(value, element) { 
        return this.optional( element ) || /^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( value ); 
      }, "Por Favor Ingresar un Rut Válido!");

      jQuery.validator.addMethod("validaEmail", function(value, element) { 
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
      }, "Por Favor Ingresar una Email Válido!");

      jQuery.validator.addMethod("validaTelefono", function(value, element) { 
        return this.optional( element ) || /^[0-9]+$/.test( value ); 
      }, "Por Favor Ingresar una N° De Teléfono Válido!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
                nuevoCliente:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                nuevoRutId:{
                    required: true, 
                    noSpace: true,
                    validaRut: true             
                },

                nuevoEmail:{
                    required: true,
                    noSpace: true,
                    validaEmail: true
                },

                nuevoTelefono:{
                    required: true,
                    noSpace: true,
                    validaTelefono: true
                   
                },
                nuevaDireccion:{
                    required: true,
                    noSpace: true
                }

            },
            messages:{
                nuevoCliente:{
                 required: 'Debes Ingresar Un Cliente!'
             },
             nuevoRutId:{
                required: 'Debes Ingresar Un Rut!'
             },
        
             nuevoEmail:{
                 required: 'Debes Ingresar Un Email'
             },
             nuevoTelefono:{
                 required: 'Debes Ingresar Un N° de Teléfono'
             },
             nuevaDireccion:{
                 required: 'Debes Ingresar una Dirección'
             }

            },
       })  
     }
 })



 $(function(){
    var $nuevo = $("#form_editar_cliente");
    $.validator.addMethod("noSpace", function(value, element){
        return value == '' || value.trim().length != 0
    }, "No Hagas Espacios");

    jQuery.validator.addMethod("validaNombre", function(value, element) { 
        return this.optional( element ) || /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/.test( value ); 
      }, "Por Favor Ingresar un Nombre Válido!");

      jQuery.validator.addMethod("validaPrecio", function(value, element) { 
        return this.optional( element ) || /^[0-9,.]+$/.test( value ); 
      }, "Por Favor Ingresar un Precio Válido!");

      jQuery.validator.addMethod("validaRut", function(value, element) { 
        return this.optional( element ) || /^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( value ); 
      }, "Por Favor Ingresar un Rut Válido!");

      jQuery.validator.addMethod("validaEmail", function(value, element) { 
        return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
      }, "Por Favor Ingresar una Email Válido!");

      jQuery.validator.addMethod("validaTelefono", function(value, element) { 
        return this.optional( element ) || /^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/.test( value ); 
      }, "Por Favor Ingresar una N° De Teléfono Válido!");

    if($nuevo.length){
        $nuevo.validate({
            rules:{
                editarCliente:{
                    required: true,
                    noSpace: true,
                    validaNombre: true
                },
                editarRutId:{
                    required: true, 
                    noSpace: true,
                    validaRut: true             
                },

                editarEmail:{
                    required: true,
                    noSpace: true,
                    validaEmail: true
                },

                editarTelefono:{
                    required: true,
                    noSpace: true,
                    validaTelefono: true
                   
                },
                nuevaDireccion:{
                    required: true,
                    noSpace: true
                }

            },
            messages:{
                editarCliente:{
                 required: 'Debes Ingresar Un Cliente!'
             },
             editarRutId:{
                required: 'Debes Ingresar Un Rut!'
             },
        
             editarEmail:{
                 required: 'Debes Ingresar Un Email'
             },
             editarTelefono:{
                 required: 'Debes Ingresar Un N° de Teléfono'
             },
             editarDireccion:{
                 required: 'Debes Ingresar una Dirección'
             }

            },
       })  
     }
 })


