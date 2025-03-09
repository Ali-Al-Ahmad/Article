<?php
require_once "../../../connection/connection.php";
require_once "../../../models/User.php";
require_once "../../../utils/utils.php";


if (!isset($data["id"]) || !isset($data["email"]) || !isset($data["full_name"])) {

  die(responseError("Missing Fields!"));
}

$user = new User($conn);
$response = $user->updateUser($data["id"], $data["full_name"], $data["email"]);

echo $response;
