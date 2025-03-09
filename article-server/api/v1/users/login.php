<?php
require_once "../../../connection/connection.php";
require_once "../../../models/User.php";
require_once "../../../utils/utils.php";


if (!isset($data["email"]) || !isset($data["password"])) {

  die(responseError("Email and Password are required!"));
}

$user = new User($conn, null, "", $data["email"], $data["password"]);
$response = $user->login();

echo $response;
