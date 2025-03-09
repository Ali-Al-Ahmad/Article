<?php
require_once 'QuestionSkeleton.php';


class Question extends QuestionSkeleton
{
  private $conn;

  public function __construct($conn, $id = null, $question = "", $answer = "")
  {
    parent::__construct($id, $question, $answer);
    $this->conn = $conn;
  }

  // Get all Questions
  public static function getAllQuestions($conn)
  {
    $query = $conn->prepare("SELECT * FROM questions ORDER BY id DESC");
    $query->execute();
    $result = $query->get_result();
    $questions = [];

    while ($question = $result->fetch_assoc()) {
      $questions[] = $question;
    }
    return responseSuccess("All Questions", $questions);
  }

  // Get Question by ID
  public static function getQuestionById($conn, $id)
  {
    $query = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
      return responseError("Question not found");
    }
    return responseSuccess("Question found", $result->fetch_assoc());
  }

  // Create Question
  public function createQuestion()
  {
    $query = $this->conn->prepare("SELECT id FROM questions WHERE question = ?");
    $query->bind_param("s", $this->question);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
      return responseError("Question already exists");
    }
    $query = $this->conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
    $query->bind_param("ss", $this->question, $this->answer);

    if ($query->execute()) {
      return responseSuccess(
        "Question added successfully",
        [
          "question" => $this->question,
          "answer" => $this->answer
        ]
      );
    }

    return responseError("Failed to Add Question");
  }


  // Update Question
  public function updateQuestion($id, $question, $answer)
  {

    $query = $this->conn->prepare("UPDATE questions SET question = ?, answer = ? WHERE id = ?");
    $query->bind_param("ssi", $question, $answer, $id);

    if ($query->execute()) {
      return responseSuccess("Question updated successfully");
    }

    return responseError("Failed to update Question");
  }

  // Delete Question
  public function deleteQuestion($id)
  {
    $query = $this->conn->prepare("DELETE FROM questions WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
      return responseSuccess("Question deleted successfully");
    }
    return responseError("Failed to delete Question");
  }
}
