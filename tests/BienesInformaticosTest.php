<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudBienes_Informaticos.php';

class BienesInformaticosTest extends TestCase
{
    private $crudBienesInformaticos;

    public function setUp(): void
    {
        $this->crudBienesInformaticos = new AccionesBienes_Informaticos();
    }

    public function testListarBienesInformaticos()
    {
        $resultado = $this->crudBienesInformaticos->listarBienes_Informaticos();
        $this->assertEquals(0,$resultado['codigo']);
    }

    public function testInsertarBienInformatico()
    {
        $codigo_uta = 'BI001';
        $nombre = 'Computadora';
        $serie = 'ABC123';
        $id_marca = 1;
        $modelo = 'Modelo X';
        $id_area_per = 999;
        $id_ubi_per = 999;
        $ip = '192.168.0.1';

        $resultado = $this->crudBienesInformaticos->insertarBienes_Informaticos(
            $codigo_uta,
            $nombre,
            $serie,
            $id_marca,
            $modelo,
            $id_area_per,
            $id_ubi_per,
            $ip
        );
        $this->assertEquals(2, $resultado);
    }

    public function testActualizarBienInformatico()
    {
        $id = 3;
        $codigo_uta = 'BI002';
        $nombre = 'Laptop';
        $serie = 'DEF456';
        $id_marca = 1;
        $modelo = 'Modelo Y';
        $id_area_per = 1;
        $id_ubi_per = 1;
        $ip = '192.168.0.2';

        $resultado = $this->crudBienesInformaticos->actualizarBienes_Informaticos(
            $id,
            $codigo_uta,
            $nombre,
            $serie,
            $id_marca,
            $modelo,
            $id_area_per,
            $id_ubi_per,
            $ip
        );
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarBienInformatico()
    {
        $id = 9999;

        $resultado = $this->crudBienesInformaticos->eliminarBienes_Informaticos($id);
        $this->assertEquals(0, $resultado);
    }
}