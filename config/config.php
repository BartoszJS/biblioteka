<?php
define('DEV',    true);                
define('DOMAIN', 'http://localhost:8888');  
$this_folder   = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])); 
$parent_folder = dirname($this_folder);          
define("DOC_ROOT", $parent_folder . '/public/'); 


$type     = 'mysql';                
$server   = 'localhost';            
$db       = 'biblioteka';             
$port     = '3306';                    
$charset  = 'utf8mb4';              
$username = 'userphpbook';      
$password = 'phpbook';        

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset"; 


$email_config = [
    'server'      => '',
    'port'        => '',
    'username'    => '',
    'password'    => '',
    'security'    => '',
    'admin_email' => '',
    'debug'       => (DEV) ? 2 : 0,
];

define('UPLOADS', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR); 
define('MEDIA_TYPES', ['image/jpeg', 'image/png', 'image/gif',]); // Allowed file types
define('FILE_EXTENSIONS', ['jpeg', 'jpg', 'png', 'gif',]);       // Allowed file extensions
define('MAX_SIZE', '5242880');                                    // Max file size