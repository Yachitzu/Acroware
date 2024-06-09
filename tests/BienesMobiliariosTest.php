<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudBienes_Mobiliarios.php';

class BienesMobiliariosTest extends TestCase
{
    private $crudBienesMobiliarios;

    public function setUp(): void
    {
        $this->crudBienesMobiliarios = new AccionesBienes_mobiliarios();
    }

    public function testListarBienesMobiliarios()
    {
        $resultado = $this->crudBienesMobiliarios->listarBienes_mobiliarios();
        $this->assertIsArray($resultado);
    }

    public function testInsertarBienMobiliario()
    {
        $codigo_uta = 'BM001';
        $nombre = 'Silla';
        $serie = 'ABC123';
        $id_marca = 1;
        $modelo = 'Modelo X';
        $color = 'Rojo';
        $material = 'Plástico';
        $dimensiones = '60x60x90';
        $condicion = 'Nuevo';
        $custodio = 'Juan Pérez';
        $valor = 100.00;
        $id_area_per = 2;
        $id_ubi_per = 1;

        $resultado = $this->crudBienesMobiliarios->insertarBienes_mobiliarios(
            $codigo_uta,
            $nombre,
            $serie,
            $id_marca,
            $modelo,
            $color,
            $material,
            $dimensiones,
            $condicion,
            $custodio,
            $valor,
            $id_area_per,
            $id_ubi_per
        );
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarBienMobiliario()
    {
        $id = 2; // Asume que existe un bien mobiliario con este ID
        $codigo_uta = 'BM002';
        $nombre = 'Mesa';
        $serie = 'DEF456';
        $id_marca = 1;
        $modelo = 'Modelo Y';
        $color = 'Blanco';
        $material = 'Madera';
        $dimensiones = '120x80x75';
        $condicion = 'Usado';
        $custodio = 'María Rodríguez';
        $valor = 200.00;
        $id_area_per = 1;
        $id_ubi_per = 1;

        $resultado = $this->crudBienesMobiliarios->actualizarBienes_mobiliarios(
            $id,
            $codigo_uta,
            $nombre,
            $serie,
            $id_marca,
            $modelo,
            $color,
            $material,
            $dimensiones,
            $condicion,
            $custodio,
            $valor,
            $id_area_per,
            $id_ubi_per
        );
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarBienMobiliario()
    {
        $id = 9999; // Asume que existe un bien mobiliario con este ID

        $resultado = $this->crudBienesMobiliarios->eliminarBienes_mobiliarios($id);
        $this->assertEquals(0, $resultado);
    }
}
?>