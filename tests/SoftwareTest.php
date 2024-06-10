<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudSoftware.php';

class SoftwareTest extends TestCase
{
    private $crudSoftware;

    public function setUp(): void
    {
        $this->crudSoftware = new AccionesSoftware();
    }

    public function testListarSoftware()
    {
        $resultado = $this->crudSoftware->listarSoftware();
        $this->assertEquals(0,$resultado['codigo']);
    }

    public function testInsertarSoftware()
    {
        $nombre_software = 'Software X';
        $proveedor = 'Empresa X';
        $activado = 'si';
        $tipo_licencia = 'Licencia anual';
        $fecha_adqui = '2023-05-01';
        $fecha_activacion = '2023-05-15';

        $resultado = $this->crudSoftware->insertarSoftware(
            $nombre_software,
            $proveedor,
            $activado,
            $tipo_licencia,
            $fecha_adqui,
            $fecha_activacion
        );
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarSoftware()
    {
        $id = 2;
        $nombre_software = 'Software Y';
        $proveedor = 'Empresa Y';
        $activado = 'no';
        $tipo_licencia = 'Licencia perpetua';
        $fecha_adqui = '2022-10-01';
        $fecha_activacion = '2022-10-15';

        $resultado = $this->crudSoftware->actualizarSoftware(
            $id,
            $nombre_software,
            $proveedor,
            $activado,
            $tipo_licencia,
            $fecha_adqui,
            $fecha_activacion
        );
        $this->assertEquals(0, $resultado);
    }

    public function testEliminarSoftware()
    {
        $id = 9999;

        $resultado = $this->crudSoftware->eliminarSoftware($id);
        $this->assertEquals(0, $resultado);
    }
}
?>