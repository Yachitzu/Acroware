<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudFacultades.php';

class FacultadesTest extends TestCase
{
    private $crudFacultades;

    public function setUp(): void
    {
        $this->crudFacultades = new AccionesFacultades();
    }

    public function testListarFacultades()
    {
        $resultado = $this->crudFacultades->listarFacultades();
        $this->assertEquals(0,$resultado['codigo']);
    }

    public function testInsertarFacultad()
    {
        $nombre = 'Facultad de Ingeniería';
        $descripcion = 'Facultad de Ingeniería y Ciencias Aplicadas';
        $campus = 'Campus Central';

        $resultado = $this->crudFacultades->insertarFacultades($nombre, $descripcion, $campus);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarFacultad()
    {
        $id = 2; // Asume que existe una facultad con este ID
        $nombre = 'Facultad de Ciencias';
        $descripcion = 'Facultad de Ciencias Naturales';
        $campus = 'Campus Norte';

        $resultado = $this->crudFacultades->actualizarFacultades($id, $nombre, $descripcion, $campus);
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarFacultad()
    {
        $id = 2; // Asume que existe una facultad con este ID

        $resultado = $this->crudFacultades->EliminarFacultad($id);
        $this->assertEquals(0, $resultado);
    }
}
?>