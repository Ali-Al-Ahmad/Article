<?php
require_once "../../../connection/connection.php";
require_once "../../../models/User.php";
require_once "../../../utils/utils.php";


//check if no id get All Users
if (!isset($data["id"])) {

  $response = User::getAllUsers($conn);
  echo  $response;
  exit();
}

// get user by id if provided
$response = User::getUserById($conn, $data["id"]);
echo  $response;
exit();
