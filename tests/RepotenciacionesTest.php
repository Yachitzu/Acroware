<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudRepotenciaciones.php';

class CrudRepotenciacionesTest extends TestCase
{

    public function testObtenerRepotenciaciones()
    {
        $resultado = Obtener::ObtenerRepotenciacion();
        $this->assertEquals(0, $resultado);
    }

    public function testObtenerRepotenciacionPorId()
    {
        $id = 1; // Asume que existe una repotenciación con este ID
        $resultado = Obtener::ObtenerById($id);
        $this->assertEquals(0, $resultado);
    }

    public function testGuardarRepotenciacion()
    {
        $data = [
            'id_componente' => 1,
            'nombre' => 'Nueva Repotenciación',
            'serie' => 'ABC123',
            'codigo_adi_uta' => 'REP001',
            'detalle_repotenciacion' => 'Detalles de la nueva repotenciación',
        ];

        $resultado = Guardar::GuardarRepotenciacion($data);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarRepotenciacion()
    {
        $data = [
            'id' => 1,
            'id_componente' => 2,
            'nombre' => 'Repotenciación Actualizada',
            'serie' => 'DEF456',
            'codigo_adi_uta' => 'REP002',
            'detalle_repotenciacion' => 'Detalles actualizados de la repotenciación',
        ];

        $resultado = Actualizar::ActualizarRepotenciacion($data);
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarRepotenciacion()
    {
        $id = 9999;
        $componente = 9999; 

        $resultado = Eliminar::BorrarRepotenciacion($id, $componente);
        $this->assertEquals(1, $resultado);
    }
}
?>