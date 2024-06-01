(function($) {
    'use strict';

    $(function() {
        var todoListItem = $('.todo-list');
        var todoListInput = $('.todo-list-input');
        var todoListUserId = $('.todo-list-input[name="usuario_id"]').val();

        // Agregar un nuevo recordatorio
        $('.todo-list-add-btn').on("click", function(event) {
            event.preventDefault();
            var item = todoListInput.val();
            var userId = todoListUserId;
            if (item) {
                $.post('http://localhost/Acroware/Acciones/recordatorios/agregar_recordatorio.php', { actividad: item, usuario_id: usuarioId }, function(data) {
                    var response = JSON.parse(data);
                    if (response.id) {
                        todoListItem.append(
                            "<li data-id='" + response.id + "'><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + response.actividad + "<i class='input-helper'></i></label></div><i class='remove ti-close'></i></li>"
                        );
                        todoListInput.val("");
                        $('.no-recordatorios').remove();
                    } else {
                        console.error('Error al agregar el recordatorio:', response.error);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al comunicarse con el servidor:', textStatus, errorThrown);
                });
            }
        });

        todoListItem.on('change', '.checkbox', function() {
            var $this = $(this);
            var id = $this.closest("li").data('id');
            var estado = $this.is(':checked') ? 'finalizado' : 'pendiente';

            $.post('http://localhost/Acroware/Acciones/recordatorios/actualizar_recordatorio.php', { id: id, estado: estado }, function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    $this.closest("li").toggleClass('completed');
                } else {
                    console.error('Error al actualizar el recordatorio:', response.error);
                }
            });
        });

        todoListItem.on('click', '.remove', function() {
            var $this = $(this);
            var id = $this.closest("li").data('id');

            $.post('http://localhost/Acroware/Acciones/recordatorios/eliminar_recordatorio.php', { id: id }, function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    $this.parent().remove();
                } else {
                    console.error('Error al eliminar el recordatorio:', response.error);
                }
            });
        });
    });
})(jQuery);
