<?php

class UserSkeleton
{
  protected $id;
  protected $full_name;
  protected $email;
  protected $password;

  public function __construct($id = null, $full_name = "", $email = "", $password = "")
  {
    $this->id = $id;
    $this->full_name = $full_name;
    $this->email = $email;
    $this->password = $password;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getFullName()
  {
    return $this->full_name;
  }

  public function setFullName($full_name)
  {
    $this->full_name = $full_name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }
}
