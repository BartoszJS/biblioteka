<?php
// UTILITY FUNCTIONS

function pdo(PDO $pdo, string $sql, array $arguments = null)
{
    if (!$arguments) {                   // If no arguments
        return $pdo->query($sql);        // Run SQL and return PDOStatement object
    }
    $statement = $pdo->prepare($sql);    // If arguments prepare statement
    $statement->execute($arguments);     // Execute statement
    return $statement;                   // Return PDOStatement object
}

function html_escape($text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
}

function loggedin($id)
{
    if($id === 0) {                                   // If role is not admin
        header('Location: logowanie.php');                                 // Send to home page
        exit;                                                  // Stop code running
    }
}

function is_member($role)
{
    if ($role !== 'admin' or $role !== 'member') {                                   // If role is not admin
        header('Location: logowanie.php');                                 // Send to home page
        exit;                                                  // Stop code running
    }
}



function is_admin($role)
{
    if ($role !== 'admin') {                                   // If role is not admin
        header('Location: logowanie.php');                       // Send to home page
        exit;                                                  // Stop code running
    }
}






function redirect(string $location, array $parameters = [], $response_code = 302)
{
    $qs = $parameters ? '?' . http_build_query($parameters) : '';  // Create query string
    $location = $location . $qs;                                   // Create new path
    header('Location: ' . DOC_ROOT . $location, $response_code);   // Redirect to new page
    exit;                                                          // Stop code
}

function create_filename(string $filename, string $uploads): string
{
    $basename  = pathinfo($filename, PATHINFO_FILENAME);          // Get basename
    $extension = pathinfo($filename, PATHINFO_EXTENSION);         // Get extension
    $cleanname = preg_replace("/[^A-z0-9]/", "-", $basename);     // Clean basename
    $filename  = $cleanname . '.' . $extension;                   // Destination
    $i         = 0;                                               // Counter
    while (file_exists($uploads . $filename)) {                   // If file exists
        $i        = $i + 1;                                       // Update counter
        $filename = $basename . $i . '.' . $extension;            // New filename
    }
    return $filename;                                             // Return filename
}

function create_seo_name(string $text): string
{
    $text = strtolower($text);                                  // Convert text to lowercase
    $text = trim($text);                                        // Remove spaces from start and end
    if (function_exists('transliterator_transliterate')) { // If transliterator installed
        $text = transliterator_transliterate('Latin-ASCII', $text); // Transliterate
    }
    $text = preg_replace('/ /', '-', $text);                    // Replace spaces with dashes
    $text = preg_replace('/[^-A-z0-9 ]+/', '', $text);          // Remove anything other than a dash, A-z or 0-9
    return $text;                                               // Return the SEO name
}

// ERROR AND EXCEPTION HANDLING FUNCTIONS
// Convert errors to exceptions
function handle_error($error_type, $error_message, $error_file, $error_line)
{
    throw new ErrorException($error_message, 0, $error_type, $error_file, $error_line); // Turn into ErrorException
}

// Handle exceptions - log exception and show error message (if server does not send error page listed in .htaccess)
function handle_exception($e)
{
    error_log($e);                        // Log the error
    http_response_code(500);              // Set the http response code
    echo "<h1>Sorry, a problem occurred</h1>   
          The site's owners have been informed. Please try again later.";
}

// Handle fatal errors
function handle_shutdown()
{
    $error = error_get_last();            // Check for error in script
    if ($error !== null) {                // If there was an error next line throws exception
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        handle_exception($e);             // Call exception handler
    }
}