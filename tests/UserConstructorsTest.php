<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/User.php';

class UserConstructorsTest extends TestCase
{
    /**
     * PRIMERA FORMA: Constructor con 2 parámetros
     * Se usa para LOGIN (email y password)
     * 
     * @test
     */
    public function testConstructorCon2Parametros()
    {
        // Arrange: Datos de prueba
        $email = 'juan.perez@ejemplo.com';
        $password = 'miClaveSecreta123';
        
        // Act: Crear objeto con constructor de 2 parámetros
        $user = new User($email, $password);
        
        // Assert: Verificar que los datos se asignaron correctamente
        $this->assertEquals($email, $user->getUserEmail(), 'El email no coincide');
        $this->assertEquals($password, $user->getUserPass(), 'La contraseña no coincide');
        
        // Verificar que otros atributos permanecen vacíos
        $this->assertNull($user->getUserName(), 'El nombre debería estar vacío');
        $this->assertNull($user->getRolCode(), 'El rol debería estar vacío');
    }
    
    /**
     * SEGUNDA FORMA: Constructor con 8 parámetros
     * Se usa para crear usuario COMPLETO sin nombre de rol
     * 
     * @test
     */
    public function testConstructorCon8Parametros()
    {
        // Arrange: Datos de prueba
        $rolCode = 'ROL001';
        $userCode = 'USR999';
        $userName = 'Carlos';
        $userLastName = 'Lopez';
        $userId = '12345678';
        $userEmail = 'carlos@ejemplo.com';
        $userPass = 'secreto456';
        $userState = 'ACTIVO';
        
        // Act: Crear objeto con 8 parámetros
        $user = new User(
            $rolCode,
            $userCode,
            $userName,
            $userLastName,
            $userId,
            $userEmail,
            $userPass,
            $userState
        );
        
        // Assert: Verificar cada atributo
        $this->assertEquals($rolCode, $user->getRolCode(), 'Código de rol incorrecto');
        $this->assertEquals($userCode, $user->getUserCode(), 'Código de usuario incorrecto');
        $this->assertEquals($userName, $user->getUserName(), 'Nombre incorrecto');
        $this->assertEquals($userLastName, $user->getUserLastName(), 'Apellido incorrecto');
        $this->assertEquals($userId, $user->getUserId(), 'Identificación incorrecta');
        $this->assertEquals($userEmail, $user->getUserEmail(), 'Email incorrecto');
        $this->assertEquals($userPass, $user->getUserPass(), 'Contraseña incorrecta');
        $this->assertEquals($userState, $user->getUserState(), 'Estado incorrecto');
        
        // El rol_name NO debe estar seteado (constructor8 no lo recibe)
        $this->assertNull($user->getRolName(), 'Rol name debería ser null');
    }
    
    /**
     * TERCERA FORMA: Constructor con 9 parámetros
     * Se usa para crear usuario COMPLETO CON nombre de rol
     * 
     * @test
     */
    public function testConstructorCon9Parametros()
    {
        // Arrange: Datos incluyendo nombre del rol
        $rolCode = 'ROL002';
        $rolName = 'Administrador';
        $userCode = 'USR888';
        $userName = 'Ana';
        $userLastName = 'Martinez';
        $userId = '87654321';
        $userEmail = 'ana@ejemplo.com';
        $userPass = 'claveAna789';
        $userState = 'INACTIVO';
        
        // Act: Crear objeto con 9 parámetros
        $user = new User(
            $rolCode,
            $rolName,
            $userCode,
            $userName,
            $userLastName,
            $userId,
            $userEmail,
            $userPass,
            $userState
        );
        
        // Assert: Verificar TODO incluyendo rol_name
        $this->assertEquals($rolCode, $user->getRolCode(), 'Código de rol incorrecto');
        $this->assertEquals($rolName, $user->getRolName(), 'Nombre de rol incorrecto');
        $this->assertEquals($userCode, $user->getUserCode(), 'Código de usuario incorrecto');
        $this->assertEquals($userName, $user->getUserName(), 'Nombre incorrecto');
        $this->assertEquals($userLastName, $user->getUserLastName(), 'Apellido incorrecto');
        $this->assertEquals($userId, $user->getUserId(), 'Identificación incorrecta');
        $this->assertEquals($userEmail, $user->getUserEmail(), 'Email incorrecto');
        $this->assertEquals($userPass, $user->getUserPass(), 'Contraseña incorrecta');
        $this->assertEquals($userState, $user->getUserState(), 'Estado incorrecto');
    }
    
    /**
     * CUARTA FORMA: Constructor sin parámetros (__construct0)
     * Se usa para crear objeto VACÍO y luego llenarlo con setters
     * 
     * @test
     */
    public function testConstructorSinParametros()
    {
        // Act: Crear objeto vacío
        $user = new User();
        $user->__construct0();  // Llamada explícita al constructor0
        
        // Assert: Verificar que todos los atributos están null
        $this->assertNull($user->getRolCode(), 'Rol code debería ser null');
        $this->assertNull($user->getRolName(), 'Rol name debería ser null');
        $this->assertNull($user->getUserCode(), 'User code debería ser null');
        $this->assertNull($user->getUserName(), 'User name debería ser null');
        $this->assertNull($user->getUserLastName(), 'User lastname debería ser null');
        $this->assertNull($user->getUserId(), 'User id debería ser null');
        $this->assertNull($user->getUserEmail(), 'User email debería ser null');
        $this->assertNull($user->getUserPass(), 'User pass debería ser null');
        $this->assertNull($user->getUserState(), 'User state debería ser null');
        
        // Verificar que podemos asignar valores después
        $user->setUserName('Luis');
        $this->assertEquals('Luis', $user->getUserName());
    }
    
    /**
     * PRUEBA AVANZADA: Verificar que los constructores son independientes
     * Cada constructor debe crear un objeto con los atributos correctos
     * 
     * @test
     */
    public function testConstructoresNoSeMezclan()
    {
        // Crear usuario con constructor 2 parámetros
        $userLogin = new User('login@test.com', 'pass123');
        
        // Crear usuario con constructor 8 parámetros
        $userCompleto = new User(
            'ROL999', 'USR123', 'Pedro', 'Garcia',
            '11111111', 'pedro@test.com', 'passPedro', 'ACTIVO'
        );
        
        // Crear usuario con constructor 9 parámetros
        $userConRol = new User(
            'ROL888', 'SuperAdmin', 'USR456', 'Lucia', 'Fernandez',
            '22222222', 'lucia@test.com', 'passLucia', 'INACTIVO'
        );
        
        // Verificar que cada objeto tiene SOLO sus datos
        $this->assertNull($userLogin->getUserName(), 'Login no debe tener nombre');
        $this->assertEquals('Pedro', $userCompleto->getUserName());
        $this->assertEquals('Lucia', $userConRol->getUserName());
        $this->assertNull($userCompleto->getRolName(), 'Constructor8 no asigna rol_name');
        $this->assertEquals('SuperAdmin', $userConRol->getRolName());
    }
    
    /**
     * PRUEBA DE INTEGRACIÓN: Constructor + Métodos de negocio
     * Crear usuario con constructor2 y luego hacer login
     * 
     * @test
     */
    public function testConstructor2FuncionaConLogin()
    {
        // Arrange: Crear usuario con constructor2 (email y pass)
        $email = 'login_test@ejemplo.com';
        $password = 'test123456';
        $user = new User($email, $password);
        
        // Este test NO ejecuta login real (necesitaríamos mock de BD)
        // Solo verifica que los datos se almacenaron correctamente para el login
        
        $this->assertEquals($email, $user->getUserEmail());
        $this->assertEquals($password, $user->getUserPass());
        
        // Verificar que la contraseña NO está hasheada todavía
        // (El hashing ocurre dentro del método login, no en constructor)
        $this->assertNotEquals(sha1($password), $user->getUserPass());
    }
    
    /**
     * PRUEBA DE BORDE: ¿Qué pasa con tipos de datos incorrectos?
     * 
     * @test
     */
    public function testConstructorMantieneTiposDeDatos()
    {
        // Los parámetros deberían mantenerse como strings
        $user = new User('ROL001', 'ROL_NAME', 'USR001', 'Juan', 
                         'Perez', '12345678', 'email@test.com', 'pass', 'ACTIVO');
        
        $this->assertIsString($user->getRolCode());
        $this->assertIsString($user->getUserName());
        $this->assertIsString($user->getUserId());  // Aunque sea número, es string
    }
}