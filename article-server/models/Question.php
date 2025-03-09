<?php

class QuestionSkeleton
{
  protected $id;
  protected $question;
  protected $answer;

  public function __construct($id = null, $question = "", $answer = "")
  {
    $this->id = $id;
    $this->question = $question;
    $this->answer = $answer;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getQuestion()
  {
    return $this->question;
  }

  public function setQuestion($question)
  {
    $this->question = $question;
  }

  public function getAnswer()
  {
    return $this->answer;
  }

  public function setAnswer($answer)
  {
    $this->answer = $answer;
  }
}
