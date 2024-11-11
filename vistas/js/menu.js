$(document).ready(function () {
    var url = window.location.href; // Obtener la ruta actual
    console.log("Ruta actual:", url);
    
    // Buscar el enlace que coincide con la URL actual
    var rutaActiva = $('ul.sidebar-menu a').filter(function () {
        return this.href === url;
    });

    // Resaltar la subcategoría activa
    rutaActiva.parent().addClass('active');

     // Rellenar ícono de círculo
    rutaActiva.find('i.fa-circle-o').removeClass('fa-circle-o').addClass('fa-circle');

    // Resaltar la categoría principal
    rutaActiva.closest(".treeview").addClass('active');
});