<?php
use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudAreas.php';

class AreasTest extends TestCase{
    
    private $crudAreas;

    public function setUp(): void
    {
        $this->crudAreas = new AccionesAreas();
    }

    public function testListarAreas()
    {
        $resultado = $this->crudAreas->listarAreas();
        $this->assertIsArray($resultado);
    }

    public function testInsertarArea0()
    {
        $nombre = 'Área de Prueba';
        $descripcion = 'Descripción de prueba';
        $piso = '1';
        $id_bloque_per = '1';
        $id_usu_encargado = '1';

        $resultado = $this->crudAreas->insertarAreas($nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado);
        $this->assertEquals(0, $resultado);
    }

    public function testInsertarArea1()
    {
        $nombre = 'Área de Prueba';
        $descripcion = 'Descripción de prueba';
        $piso = '1';
        $id_bloque_per = '1';
        $id_usu_encargado = '1';

        $resultado = $this->crudAreas->insertarAreas($nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado);
        $this->assertEquals(1, $resultado);
    }

    public function testActualizarArea()
    {
        $id = 3; // Asume que existe un área con este ID
        $nombre = 'Área Actualizada';
        $descripcion = 'Descripción actualizada';
        $piso = '2';
        $id_bloque_per = '1';
        $id_usu_encargado = '1';

        $resultado = $this->crudAreas->actualizarArea($id, $nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado);
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarArea()
    {
        $id = 5; // Asume que existe un área con este ID

        $resultado = $this->crudAreas->eliminarArea($id);
        $this->assertEquals(0, $resultado);
    }
}

?>