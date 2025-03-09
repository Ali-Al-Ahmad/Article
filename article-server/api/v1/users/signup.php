<?php
require_once "../../../connection/connection.php";
require_once "../../../models/User.php";
require_once "../../../utils/utils.php";
require_once "../../../database/migrations/usersMigrations.php";
require_once "../../../database/migrations/questionsMigrations.php";
require_once "../../../database/seeds/seeds.php";

if (!isset($data["full_name"]) || !isset($data["email"]) || !isset($data["password"])) {

  die(responseError("Missing Fields!"));
}

$user = new User($conn, null, $data["full_name"], $data["email"], $data["password"]);
$response = $user->signUp();

echo $response;
