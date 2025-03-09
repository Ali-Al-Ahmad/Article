<?php
require_once "../../../connection/connection.php";
require_once "../../../models/Question.php";
require_once "../../../utils/utils.php";


if (!isset($data["question"]) || !isset($data["answer"])) {

  die(responseError("Missing Fields!"));
}

$question = new Question($conn, null, $data["question"], $data["answer"]);
$response = $question->createQuestion();

echo $response;
