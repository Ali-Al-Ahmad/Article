<?php
require_once "../../../connection/connection.php";
require_once "../../../models/Question.php";
require_once "../../../utils/utils.php";


//check if no id get All Questions
if (!isset($data["id"])) {

  $response = Question::getAllQuestions($conn);
  echo  $response;
  exit();
}

// get Question by id if provided
$response = Question::getQuestionById($conn, $data["id"]);
echo  $response;
exit();
