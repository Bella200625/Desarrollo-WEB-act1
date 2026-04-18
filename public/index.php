<?php

declare(strict_types=1);

// --- GUARDIA DE SEGURIDAD: BLOQUEAR ACCESO DIRECTO ---
(function (): void {
    $requestPath = rtrim(
        (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), 
        PHP_URL_PATH), '/'
        );
    $publicBase = rtrim(dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php')), '/');

    if ($requestPath !== $publicBase && !str_starts_with($requestPath, $publicBase . '/')) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $dest = isset($_SESSION['auth']['id']) ? 'home' : 'home';
        header('Location: ' . $publicBase . '/index.php?route=' . $dest);
        exit;
    }
})();

// --- CARGA DE DEPENDENCIAS ---
require_once dirname(__DIR__) . '/src/Common/ClassLoader.php';
require_once dirname(__DIR__) . '/src/Common/DependencyInjection.php';
require_once dirname(__DIR__) . '/src/Infrastructure/Entrypoints/Web/Presentation/View.php';
require_once dirname(__DIR__) . '/src/Infrastructure/Entrypoints/Web/Presentation/Flash.php';


DependencyInjection::boot();

try {
    $pdo = DependencyInjection::getConnection()->createPdo();
    // Si llega aquí, la conexión funciona
} catch (\PDOException $e) {
    echo "<div style='background:red; color:white; padding:20px;'>";
    echo "<h1>¡Error de Conexión!</h1>";
    echo "Tu código no pudo entrar a MySQL. El error es: " . $e->getMessage();
    echo "</div>";
    exit;
}

Flash::start();

// --- HELPERS DE AUTENTICACIÓN ---
function isLoggedIn(): bool
{
    return isset($_SESSION['auth']['id']);
}

function requireAuth(): void
{
    if (!isLoggedIn()) {
        Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
        View::redirect('auth.login');
    }
}

function getLoggedUser(): array
{
    return is_array($_SESSION['auth'] ?? null) ? $_SESSION['auth'] : array();
}

// --- ENRUTAMIENTO (ROUTING) ---
$route = isset($_GET['route']) ? trim((string) $_GET['route']) : 'home';
$routes = WebRoutes::routes();

if (!isset($routes[$route])) {
    http_response_code(404);
    View::render('home', buildHomeViewData('Ruta no encontrada.'));
    exit;
}

$definition = $routes[$route];
$httpMethod = strtoupper((string) $_SERVER['REQUEST_METHOD']);

if ($httpMethod !== $definition['method']) {
    http_response_code(405);
    View::render('home', buildHomeViewData('Método HTTP no permitido.'));
    exit;
}

// Control de acceso público/privado
$publicActions = array('home', 'login', 'authenticate', 'logout', 'forgot', 'forgot.send', 'create', 'store');
if (!in_array($definition['action'], $publicActions, true) && !isLoggedIn()) {
    Flash::setMessage('Debes iniciar sesión para acceder a esta sección.');
    View::redirect('auth.login');
}

// --- PROCESAMIENTO DE ACCIONES ---
try {
    switch ($definition['action']) {
        case 'home':
            View::render('home', buildHomeViewData());
            break;

        case 'create':
            View::render('users/create', buildCreateUserViewData());
            break;

        case 'store':
            $controller = DependencyInjection::getUserController();
            $form = getCreateUserFormData();
            $form['id'] = generateUuid4();
            $errors = validateCreateUserForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                View::redirect('users.create');
            }

            $request = new CreateUserWebRequest(
                $form['id'],
                $form['name'],
                $form['email'],
                $form['password'],
                $form['role']
            );

            $controller->store($request);
            Flash::setSuccess('Usuario registrado correctamente.');
            View::redirect('users.index');
            break;

        case 'index':
            $controller = DependencyInjection::getUserController();
            $users = $controller->index();
            View::render('users/list', buildListUsersViewData($users));
            break;

        case 'show':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $user = $controller->show($id);
            View::render('users/show', array(
                'pageTitle' => 'Detalle de usuario',
                'user' => $user,
                'message' => Flash::message(),
            ));
            break;

        case 'edit':
            $controller = DependencyInjection::getUserController();
            $id = isset($_GET['id']) ? trim((string) $_GET['id']) : '';
            $user = $controller->show($id);
            View::render('users/edit', buildEditUserViewData($user));
            break;

        case 'update':
            $controller = DependencyInjection::getUserController();
            $form = getUpdateUserFormData();
            $errors = validateUpdateUserForm($form);

            if (!empty($errors)) {
                Flash::setOld($form);
                Flash::setErrors($errors);
                Flash::setMessage('Corrige los errores del formulario.');
                header('Location: ?route=users.edit&id=' . urlencode($form['id']));
                exit;
            }

            $request = new UpdateUserWebRequest(
                $form['id'],
                $form['name'],
                $form['email'],
                $form['password'],
                $form['role'],
                $form['status']
            );

            $controller->update($request);
            Flash::setSuccess('Usuario actualizado correctamente.');
            View::redirect('users.index');
            break;

        case 'delete':
            $controller = DependencyInjection::getUserController();
            $id = isset($_POST['id']) ? trim((string) $_POST['id']) : '';
            $controller->delete($id);
            Flash::setSuccess('Usuario eliminado correctamente.');
            View::redirect('users.index');
            break;

        case 'login':
            if (isLoggedIn()) {
                View::redirect('home');
            }
            View::render('auth/login', array(
                'pageTitle' => 'Iniciar sesión',
                'message' => Flash::message(),
                'errors' => Flash::errors(),
                'old' => Flash::old(),
            ));
            break;

        case 'authenticate':

            $email = trim(strtolower((string) ($_POST['email'] ?? '')));
            $password = (string) ($_POST['password'] ?? '');
            $authErrors = array();

            if ($email === '') {
                $authErrors['email'] = 'El correo es obligatorio.';
            }
            if ($password === '') {
                $authErrors['password'] = 'La contraseña es obligatoria.';
            }

            if (!empty($authErrors)) {
                Flash::setErrors($authErrors);
                Flash::setOld(array('email' => $email));
                View::redirect('auth.login');
            }

            $loginUseCase = DependencyInjection::getLoginUseCase();
            $command = new LoginCommand($email, $password);
            $user = $loginUseCase->execute($command);

            $_SESSION['auth'] = array(
                'id' => $user->id()->value(),
                'name' => $user->name()->value(),
                'email' => $user->email()->value(),
                'role' => $user->role(),
            );

            Flash::setSuccess('Bienvenido/a, ' . $user->name()->value() . '.');
            View::redirect('home');
            break;

        case 'logout':
            session_destroy();
            header('Location: ?route= home ');
            exit;

        case 'forgot':
            View::render('auth/forgot-password', array(
                'pageTitle' => 'Recuperar contraseña',
                'message' => Flash::message(),
                'success' => Flash::success(),
                'errors' => Flash::errors(),
                'old' => Flash::old(),
            ));
            break;

        case 'forgot.send':
            $forgotEmail = trim(strtolower((string) ($_POST['email'] ?? '')));

            if ($forgotEmail === '' || !filter_var($forgotEmail, FILTER_VALIDATE_EMAIL)) {
                Flash::setErrors(array('email' => 'Introduce un correo electrónico válido.'));
                Flash::setOld(array('email' => $forgotEmail));
                View::redirect('auth.forgot');
            }

            $repository = DependencyInjection::getUserRepository();
            $foundUser = $repository->getByEmail(new UserEmail($forgotEmail));

            if ($foundUser !== null && $foundUser->status() === UserStatusEnum::ACTIVE) {
                $tempPassword = bin2hex(random_bytes(5));
                $newPassword = UserPassword::fromPlainText($tempPassword);
                $updatedUser = $foundUser->changePassword($newPassword);
                $repository->update($updatedUser);

                sendPasswordRecoveryEmail(
                    $foundUser->email()->value(),
                    $foundUser->name()->value(),
                    $tempPassword
                );
            }

            Flash::setSuccess('Si el correo está registrado, recibirás un mensaje con tu contraseña temporal.');
            View::redirect('auth.forgot');
            break;

            case 'gastos.index':
                if (!isset($_SESSION['auth'])) {
                    header('Location: ?route=login');
                    exit;
                }

                $controller = DependencyInjection::getGastoController();
                
                try {
                    $gastosResponse = $controller->index();
                    $gastos = array_map(fn($g) => $g->toArray(), $gastosResponse);
                } catch (Throwable $e) {
                    $gastos = []; 
                }

                View::render('gastos/board', [
                    'pageTitle' => 'Mis Gastos',
                    'gastos'    => $gastos,
                    'authUser'  => $_SESSION['auth']
                ]);
                exit;
            break;

                case 'gastos.delete':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller = DependencyInjection::getGastoController();
                
                $controller->delete((string)$id);
                Flash::setSuccess("Gasto eliminado correctamente.");
            }
            header('Location: ?route=gastos.index');
            exit;
            break;

            case 'gastos.create':
            View::render('gastos/create', array(
                'pageTitle' => 'Registrar Nuevo Gasto',
                'authUser'  => $_SESSION['auth'] ?? null,
                'errors'    => Flash::errors(),
                'old'       => Flash::old(),
            ));
            break;

            case 'gastos.edit':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    header('Location: ?route=gastos.index');
                    exit;
                }

                $controller = DependencyInjection::getGastoController();
                // Usamos el show($id) que ya tienes en tu controlador para traer el gasto
                $gastoResponse = $controller->show((string)$id); 

                View::render('gastos/edit', [
                    'pageTitle' => 'Editar Gasto',
                    'gasto'     => $gastoResponse->toArray(),
                    'authUser'  => $_SESSION['auth']
                ]);
                exit;
            break;

           case 'gastos.update':
    try {
        $controller = DependencyInjection::getGastoController();
        
       
        $request = new UpdateGastoWebRequest(
            (string)$_POST['id'],
            (string)$_POST['fecha'],
            (string)$_POST['tipo_servicio'],
            (float)$_POST['monto_sin_iva'],
            (string)$_POST['lugar'],
            (string)($_POST['descripcion'] ?? '')
        );

        $controller->update($request);
        
        Flash::setSuccess("¡Gasto actualizado!");
        header('Location: ?route=gastos.index');
    } catch (Exception $e) {
        Flash::setMessage("Error: " . $e->getMessage());
        header('Location: ?route=gastos.index');
    }
    exit;
break;

            case 'gastos.store':
                $controller = DependencyInjection::getGastoController();

                // 1. Capturamos y formateamos (aseguramos el formato Y-m-d)
                $rawFecha = $_POST['fecha'] ?? '';
                $fechaValida = date("Y-m-d", strtotime(str_replace('/', '-', $rawFecha)));

                // 2. Creamos el WebRequest respetando el orden de tu constructor
                $request = new CreateGastoWebRequest(
                    (string)uniqid(),
                    $fechaValida,
                    (string)($_POST['tipo_servicio'] ?? ''),
                    (float)($_POST['monto_sin_iva'] ?? 0),
                    (string)($_POST['lugar'] ?? ''),
                    (string)($_POST['descripcion'] ?? '')
                );

                $controller->store($request);
                
                header('Location: index.php?action=gastos.index');
                
            break;
                        

        default:
            throw new RuntimeException('Acción no soportada.');
    }
} catch (Throwable $exception) {
    $msg = $exception->getMessage();
    Flash::setMessage($msg);

    if ($definition['action'] === 'authenticate') {
        View::redirect('auth.login'); 
    }

    switch ($route) {
        
        case 'users.store':
            Flash::setOld(getCreateUserFormData());
            View::redirect('users.create');
            break;
        
        case 'users.update':
            $updateId = trim((string) ($_POST['id'] ?? ''));
            Flash::setOld(getUpdateUserFormData());
            header('Location: ?route=users.edit&id=' . urlencode($updateId));
            exit;
       
        case 'auth.authenticate':
            Flash::setOld(array('email' => trim(strtolower((string) ($_POST['email'] ?? '')))));
            View::redirect('auth.login');
            break;
        default:
            View::render('home', buildHomeViewData($msg));
            break;
    }
}

// --- HELPER DE EMAIL ---
function sendPasswordRecoveryEmail(string $email, string $name, string $tempPassword): void 
{
$templateFile = dirname(__DIR__) . '/src/Infrastructure/Entrypoints/Web/Presentation/Views/email/forgot-password.php';    ob_start();
    
        if (!file_exists($templateFile)) {
        return; // Por si acaso, para que no se rompa la pantalla si falla la ruta
    }

    ob_start();

    extract(array('email' => $email, 'name' => $name, 'tempPassword' => $tempPassword), EXTR_SKIP);
    require $templateFile;
    $htmlBody = (string) ob_get_clean();





    $subject = '=?UTF-8?B?' . base64_encode('Recuperación de contraseña') . '?=';
    $headers = implode("\r\n", array(
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: CRUD Usuarios <no-reply@crud-usuarios.local>',
        'X-Mailer: PHP/' . PHP_VERSION,
    ));

    mail($email, $subject, $htmlBody, $headers);
}

// --- VIEW-DATA BUILDERS ---
function buildListUsersViewData(array $users): array
{
    return array(
        'pageTitle' => 'Lista de usuarios',
        'users' => $users,
        'message' => Flash::message(),
        'success' => Flash::success(),
    );
}

function buildHomeViewData(string $message = ''): array
{
    return array(
        'pageTitle' => 'Menú principal',
        'message' => $message,
        'success' => Flash::success(),
    );
}

function buildCreateUserViewData(): array
{
    ClassLoader::loadClass('UserRoleEnum');
    return array(
        'pageTitle' => 'Registrar usuario',
        'roleOptions' => UserRoleEnum::values(),
        'message' => Flash::message(),
        'success' => Flash::success(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

function buildEditUserViewData(UserResponse $user): array
{
    return array(
        'pageTitle' => 'Editar usuario',
        'user' => $user,
        'roleOptions' => UserRoleEnum::values(),
        'statusOptions' => UserStatusEnum::values(),
        'message' => Flash::message(),
        'errors' => Flash::errors(),
        'old' => Flash::old(),
    );
}

// --- UTILIDADES VARIAS ---
function generateUuid4(): string
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function getCreateUserFormData(): array
{
    return array(
        'name'     => isset($_POST['name']) ? trim((string) $_POST['name']) : '',
        'email'    => isset($_POST['email']) ? trim((string) $_POST['email']) : '',
        'password' => isset($_POST['password']) ? trim((string) $_POST['password']) : '',
        'role'     => !empty($_POST['role']) ? trim((string) $_POST['role']) : 'MEMBER',);
}

function getUpdateUserFormData(): array
{
    return array(
        'id' => isset($_POST['id']) 
            ? trim((string) $_POST['id']) : '',
        
        'name' => isset($_POST['name']) 
            ? trim((string) $_POST['name']) : '',
        
        'email' => isset($_POST['email']) 
            ? trim((string) $_POST['email']) : '',
        
        'password' => isset($_POST['password']) 
            ? (string) $_POST['password'] : '',
        
        'role' => isset($_POST['role']) 
            ? trim((string) $_POST['role']) : '',
        
        'status' => isset($_POST['status']) 
            ? trim((string) $_POST['status']) : '',
    );
}

function validateCreateUserForm(array $form): array
{
    $errors = array();
    if ($form['name'] === '') $errors['name'] = 'El nombre es obligatorio.';
    
    if ($form['email'] === '') {
        $errors['email'] = 'El correo es obligatorio.';
    } 
    elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El correo no tiene un formato válido.';
    }
    if ($form['password'] === '') {
        $errors['password'] = 'La contraseña es obligatoria.';
    } 
    
    elseif (strlen($form['password']) < 8) {
        $errors['password'] = 'La contraseña debe tener al menos 8 caracteres.';
    
    }
    if ($form['role'] === '') $errors['role'] = 'El rol es obligatorio.';
    return $errors;
}

function validateUpdateUserForm(array $form): array
{
    $errors = array();
    if ($form['name'] === '') $errors['name'] = 'El nombre es obligatorio.';
    
    if ($form['email'] === '') {
        $errors['email'] = 'El correo es obligatorio.';
    } 
    
    elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El correo no tiene un formato válido.';
    }
    
    if ($form['password'] !== '' && strlen($form['password']) < 8) {
        $errors['password'] = 'La contraseña debe tener al menos 8 caracteres si deseas cambiarla.';
    }
    
    if ($form['role'] === '') 
        $errors['role'] = 'El rol es obligatorio.';
    
    if ($form['status'] === '') 
        $errors['status'] = 'El estado es obligatorio.';
    
    return $errors;
}