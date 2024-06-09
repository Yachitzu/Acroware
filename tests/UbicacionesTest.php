<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudUbicaciones.php';

class UbicacionesTest extends TestCase
{
    private $crudUbicaciones;

    public function setUp(): void
    {
        $this->crudUbicaciones = new AccionesUbicaciones();
    }

    public function testListarUbicaciones()
    {
        $resultado = $this->crudUbicaciones->listarUbicaciones();
        $this->assertEquals(0,$resultado['codigo']);
    }

    public function testInsertarUbicacion()
    {
        $nombre = 'Ubicación A';
        $descripcion = 'Descripción de la ubicación A';
        $id_area_per = 1;

        $resultado = $this->crudUbicaciones->insertarUbicaciones($nombre, $descripcion, $id_area_per);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarUbicacion()
    {
        $id = 1;
        $nombre = 'Ubicación B';
        $descripcion = 'Descripción actualizada de la ubicación B';
        $id_area_per = 2;

        $resultado = $this->crudUbicaciones->actualizarUbicacion($id, $nombre, $descripcion, $id_area_per);
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarUbicacion()
    {
        $id = 9999;

        $resultado = $this->crudUbicaciones->eliminarUbicacion($id);
        $this->assertEquals(0, $resultado);
    }
}
?>