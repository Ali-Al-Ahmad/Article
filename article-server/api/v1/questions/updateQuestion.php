<?php
require_once "../../../connection/connection.php";
require_once "../../../models/Question.php";
require_once "../../../utils/utils.php";


if (!isset($data["id"]) || !isset($data["question"]) || !isset($data["answer"])) {

  die(responseError("Missing Fields!"));
}

$question = new Question($conn);
$response = $question->updateQuestion($data["id"], $data["question"], $data["answer"]);

echo $response;
