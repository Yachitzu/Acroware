<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudComponentes.php';

class ComponentesTest extends TestCase
{

    public function testObtenerComponentePorId()
    {
        $id = 1;
        $componente = Obtener::ObtenerById($id);
        $this->assertEquals(0, $componente);
    }

    public function testObtenerNombres()
    {
        $nombres = Obtener::ObtenerNombres();
        $this->assertEquals(0, $nombres);
    }

    public function testGuardarComponente()
    {
        $data = [
            'nombre' => 'Componente de prueba',
            'descripcion' => 'Descripción de prueba',
            'serie' => '12345',
            'codigo_adi_uta' => 'UTA_2024_04',
            'id_bien_infor_per' => 1,
            'repotenciado' => 'no'
        ];

        $resultado = Guardar::GuardarComponente($data);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarComponente()
    {
        $id = 2; 
        $data = [
            'id' => $id,
            'nombre' => 'Componente actualizado',
            'descripcion' => 'Descripción actualizada',
            'serie' => '54321',
            'codigo_adi_uta' => 'UTA_2024_05',
            'id_bien_infor_per' => 3,
            'repotenciado' => 'no'
        ];

        $resultado = Actualizar::ActualizarComponente($id,$data);
        $this->assertEquals(0, $resultado);
    }

    public function testBorrarComponente()
    {
        $id = 9999; 
        $resultado = Eliminar::BorrarComponente($id);
        $this->assertEquals(1, $resultado);
    }
}
?>