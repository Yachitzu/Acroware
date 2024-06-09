<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudBloques.php';

class BloquesTest extends TestCase
{
    private $crudBloques;

    public function setUp(): void
    {
        $this->crudBloques = new AccionesBloques();
    }

    public function testListarBloques()
    {
        $resultado = $this->crudBloques->listarBloques();
        $this->assertEquals(0,$resultado['codigo']);
    }

    public function testInsertarBloque()
    {
        $nombre = 'Bloque A';
        $descripcion = 'Bloque principal';
        $id_facultad_per = 1;
        $pisos = 5;

        $resultado = $this->crudBloques->insertarBloques($nombre, $descripcion, $id_facultad_per, $pisos);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarBloque()
    {
        $id = 1; // Asume que existe un bloque con este ID
        $nombre = 'Bloque B';
        $descripcion = 'Bloque secundario';
        $id_facultad_per = 2;
        $pisos = 3;

        $resultado = $this->crudBloques->actualizarBloques($id, $nombre, $descripcion, $id_facultad_per, $pisos);
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarBloque()
    {
        $id = 1; // Asume que existe un bloque con este ID

        $resultado = $this->crudBloques->eliminarBloque($id);
        $this->assertEquals(1, $resultado);
    }
}
?>