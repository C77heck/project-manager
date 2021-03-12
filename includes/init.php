<?php

/**
 * Initializations
 *
 * Register an autoloader
 */
spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});


require dirname(__DIR__) . '/config.php';


// we turn errors into exceptions
function errorHandler($level, $message, $file, $line)
{
    throw new ErrorException($message, 0, $level, $file, $line);
}


function exceptionHandler($exception)
{
    // set generic server error code
    http_response_code(500);

    if (SHOW_ERROR_DETAIL) {
        // DEV MODE
        echo "<h1>An error occurred</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>In file '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    } else {
        // PROD MODE
        echo "<h2>An error occurred</h2>";
        echo "<h4>Please try again later.</h4>";
    }

    exit();
}

// set our custom funtions as error handler and exception handler
set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');
