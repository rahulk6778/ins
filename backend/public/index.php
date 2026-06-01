<?php

// CodeIgniter 4 Front Controller
// This file serves as the main entry point for all requests to your application.

// Define ENVIRONMENT
defined('ENVIRONMENT') || define('ENVIRONMENT', 'development');

/*
 *---------------------------------------------------------------
 * ERROR AND EXCEPTION HANDLING
 *---------------------------------------------------------------
 * This file lets us hook into PHPs error handlers (as well as
 * catching exceptions thrown by the framework itself) so that we can
 * display errors in the format some of the end users will expect.
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', '1');
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', '0');
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
$systemPath = __DIR__ . '/../../system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 * If you want this front controller to use a different "app"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you, for example,
 * want to keep your application files in the root of your web server,
 * with this front controller at public/index.php, then change the path below.
 */
$appPath = __DIR__ . '/../app';

/*
 *---------------------------------------------------------------
 * WRITABLE DIRECTORY NAME
 *---------------------------------------------------------------
 * If you want the writable directory renamed, or if you've moved
 * the writable directory outside of the /app directory, change the
 * value below
 */
$writablePath = __DIR__ . '/../writable';

/*
 * -------------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * -------------------------------------------------------------------
 */
if ($realpath = realpath($systemPath)) {
    $systemPath = $realpath . DIRECTORY_SEPARATOR;
} else {
    // Ensure there is a trailing slash
    $systemPath = strtr($systemPath, '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if (!is_dir($systemPath)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . basename(__FILE__);
    exit(3);
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the constant
 * -------------------------------------------------------------------
 */
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSPATH', $systemPath);
define('APPPATH', $appPath . DIRECTORY_SEPARATOR);
define('WRITEPATH', $writablePath . DIRECTORY_SEPARATOR);

// Load the framework bootstraps
require_once SYSPATH . 'Config/Constants.php';
require_once SYSPATH . 'bootstrap.php';

// Launch the application
$app = new CodeIgniter\CodeIgniter(new CodeIgniter\Config\DotEnv(ROOTPATH));
$app->run();
