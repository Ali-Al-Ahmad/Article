<?php
require_once "../../../connection/connection.php";
require_once "../../../models/Question.php";
require_once "../../../utils/utils.php";


if (!isset($data["id"])) {

  die(responseError("Id is required!"));
}

$question = new Question($conn);
$response = $question->deleteQuestion($data["id"]);

echo $response;
exit();
