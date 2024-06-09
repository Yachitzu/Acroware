<?php

use PHPUnit\Framework\TestCase;
include_once __DIR__ . '/../Acciones/crudUsuarios.php';

class UsuariosTest extends TestCase
{

    public function testObtenerUsuarios()
    {
        $resultado = Obtener::ObtenerUsuarios();
        $this->assertEquals(0, $resultado);
    }

    public function testObtenerUsuarioPorId()
    {
        $id = 1; 
        $resultado = Obtener::ObtenerById($id);
        $this->assertEquals(0, $resultado);
    }

    public function testGuardarUsuario()
    {
        $data = [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'cedula' => '123456789',
            'email' => 'juan@uta.edu.ec',
            'rol' => 'laboratorista',
            'psswd' => 'Password123'
        ];

        $resultado = Guardar::GuardarUsuario($data);
        $this->assertEquals(0, $resultado);
    }

    public function testActualizarUsuario()
    {
        $id = 3; 
        $data = [
            'id' => $id,
            'nombre' => 'Juan Actualizado',
            'apellido' => 'Pérez',
            'cedula' => '123456789',
            'email' => 'juan@uta.edu.ec',
            'rol' => 'admin',
            'psswd' => 'password'
        ];

        $resultado = Actualizar::ActualizarUsuario($id,$data);
        $this->assertEquals(0, $resultado);
    }

    public function testBorrarUsuario()
    {
        $id = 9999; 
        $resultado = Eliminar::BorrarUsuario($id);
        $this->assertEquals(1, $resultado);
    }
}
?>