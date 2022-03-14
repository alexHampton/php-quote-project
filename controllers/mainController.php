<!-- 

// Database
require('config/Database.php');

// Connect to Database
$database = new Database();
$db = $database->connect();

// Views
include_once('views/head.php');
include_once('views/search.php');

// Subcontroller
if (array_key_exists("postQuery", $_GET)) include_once('controllers/queryController.php');


// View
include_once('views/foot.php'); -->
