<?php
require_once "../../../connection/connection.php";
require_once "../../../models/User.php";
require_once "../../../utils/utils.php";


if (!isset($data["id"])) {

  die(responseError("Id is required!"));
}

$user = new User($conn);
$response = $user->deleteUser($data["id"]);

echo $response;
exit();
