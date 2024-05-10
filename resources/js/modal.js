$(document).ready(function(){
    
    $("#editar").click(function(){
        $("#modalCrud").modal('show');
    });

    $("#agregar").click(function(){
        $("#modalCrudAgregar").modal('show');
    });

    $("#eliminar").click(function(){
        $("#modalCrudEliminar").modal('show');
    });

});