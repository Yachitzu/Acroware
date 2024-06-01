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

    $("#eliminarComponente").click(function(){
        $("#modalCrudEliminarComponente").modal('show');
    });

    $("#agregarBien").click(function(){
        $("#modalCrudAgregar").modal('hide');
        $("#modalQR").modal('show');
    });

    $("#editarBien").click(function(){
        $("#modalCrud").modal('hide');
        $("#modalQREditar").modal('show');
    });

});