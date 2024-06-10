<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudMarcas.php';

class MarcasTest extends TestCase
{

    public function testObtenerMarcas()
    {
        $resultado = Obtener::ObtenerMarca();
        $this->assertEquals(0, $resultado);
    }

    public function testObtenerMarcaPorId()
    {
        $id = 1;
        $resultado = Obtener::ObtenerById($id);
        $this->assertEquals(0, $resultado);
    }

    public function testGuardarMarca()
    {
        $data = [
            'nombre' => 'Nueva Marca',
            'descripcion' => 'Descripción de la nueva marca',
            'pais' => 'USA',
            'area' => 'mobiliario'
        ];

        $resultado = Guardar::GuardarMarca(json_encode($data));
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarMarca()
    {
        $id = 4;
        $data = [
            'nombre' => 'MSI',
            'descripcion' => 'Descripción actualizada',
            'pais' => 'USA',
            'area' => 'tecnologico'
        ];

        $resultado = Actualizar::ActualizarMarca($id, json_encode($data));
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarMarca()
    {
        $id = 9999;

        $resultado = Eliminar::BorrarMarca($id);
        $this->assertEquals(1, $resultado);
    }
}
?>