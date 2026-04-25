<?php
use PHPUnit\Framework\TestCase;

// Incluir la clase User
require_once __DIR__ . '/../models/User.php';

class UserGettersSettersTest extends TestCase
{
    private $user;
    
    // Se ejecuta ANTES de cada prueba
    protected function setUp(): void
    {
        $this->user = new User();
        // Llamamos al constructor sin parámetros
        $this->user->__construct0();
    }
    
    /** @test */
    public function testSetAndGetRolCode()
    {
        // Arrange: Preparamos el dato de prueba
        $expected = 'ADMIN';
        
        // Act: Ejecutamos los métodos
        $this->user->setRolCode($expected);
        $result = $this->user->getRolCode();
        
        // Assert: Verificamos
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserName()
    {
        $expected = 'Juan Perez';
        
        $this->user->setUserName($expected);
        $result = $this->user->getUserName();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserLastName()
    {
        $expected = 'Gomez';
        
        $this->user->setUserLastName($expected);
        $result = $this->user->getUserLastName();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserEmail()
    {
        $expected = 'juan@test.com';
        
        $this->user->setUserEmail($expected);
        $result = $this->user->getUserEmail();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserPass()
    {
        $expected = 'secreto123';
        
        $this->user->setUserPass($expected);
        $result = $this->user->getUserPass();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserCode()
    {
        $expected = 'USR001';
        
        $this->user->setUserCode($expected);
        $result = $this->user->getUserCode();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserId()
    {
        $expected = '12345678';
        
        $this->user->setUserId($expected);
        $result = $this->user->getUserId();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetUserState()
    {
        $expected = 'ACTIVO';
        
        $this->user->setUserState($expected);
        $result = $this->user->getUserState();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test */
    public function testSetAndGetRolName()
    {
        $expected = 'Administrador';
        
        $this->user->setRolName($expected);
        $result = $this->user->getRolName();
        
        $this->assertEquals($expected, $result);
    }
    
    /** @test - Versión compacta: probar todos juntos */
    public function testTodosLosGettersYSetters()
    {
        // Datos de prueba
        $datos = [
            'rol_code' => 'ROL001',
            'rol_name' => 'Administrador',
            'user_code' => 'USR999',
            'user_name' => 'Maria',
            'user_lastname' => 'Gomez',
            'user_id' => '87654321',
            'user_email' => 'maria@test.com',
            'user_pass' => 'miclave123',
            'user_state' => 'ACTIVO'
        ];
        
        // Asignar todos los valores
        $this->user->setRolCode($datos['rol_code']);
        $this->user->setRolName($datos['rol_name']);
        $this->user->setUserCode($datos['user_code']);
        $this->user->setUserName($datos['user_name']);
        $this->user->setUserLastName($datos['user_lastname']);
        $this->user->setUserId($datos['user_id']);
        $this->user->setUserEmail($datos['user_email']);
        $this->user->setUserPass($datos['user_pass']);
        $this->user->setUserState($datos['user_state']);
        
        // Verificar todos
        $this->assertEquals($datos['rol_code'], $this->user->getRolCode());
        $this->assertEquals($datos['rol_name'], $this->user->getRolName());
        $this->assertEquals($datos['user_code'], $this->user->getUserCode());
        $this->assertEquals($datos['user_name'], $this->user->getUserName());
        $this->assertEquals($datos['user_lastname'], $this->user->getUserLastName());
        $this->assertEquals($datos['user_id'], $this->user->getUserId());
        $this->assertEquals($datos['user_email'], $this->user->getUserEmail());
        $this->assertEquals($datos['user_pass'], $this->user->getUserPass());
        $this->assertEquals($datos['user_state'], $this->user->getUserState());
    }
}