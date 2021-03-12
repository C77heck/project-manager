<?php


require '../includes/init.php';

$db = require '../includes/db.php';


// get req json data(id)
$data = json_decode(file_get_contents("php://input"));

// delete the project
Project::delete($db, $data->id);


