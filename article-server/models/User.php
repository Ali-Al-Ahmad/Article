<?php
require_once 'UserSkeleton.php';

class User extends UserSkeleton
{
  private $conn;

  public function __construct($conn, $id = null, $full_name = "", $email = "", $password = "")
  {
    parent::__construct($id, $full_name, $email, $password);
    $this->conn = $conn;
  }

  // Get all users
  public static function getAllUsers($conn)
  {
    $query = $conn->prepare("SELECT id, full_name, email FROM users ORDER BY id DESC");
    $query->execute();
    $result = $query->get_result();
    $users = [];

    while ($user = $result->fetch_assoc()) {
      $users[] = $user;
    }
    return responseSuccess("All Users", $users);
  }

  // Get user by ID
  public static function getUserById($conn, $id)
  {
    $query = $conn->prepare("SELECT id, full_name, email FROM users WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
      return responseError("User not found");
    }
    return responseSuccess("User found", $result->fetch_assoc());
  }

  // User SignUp
  public function signUp()
  {
    $query = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
    $query->bind_param("s", $this->email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
      return responseError("User already exists");
    }

    $hashedPassword = hashPassword($this->password);

    $query = $this->conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $this->full_name, $this->email, $hashedPassword);

    if ($query->execute()) {
      return responseSuccess(
        "User added successfully",
        [
          "id" => $this->conn->insert_id,
          "full_name" => $this->full_name,
          "email" => $this->email
        ]
      );
    }

    return responseError("Failed to signup user");
  }

  // User Login
  public function login()
  {
    $query = $this->conn->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
    $query->bind_param("s", $this->email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
      return responseError("User not found");
    }

    $user = $result->fetch_assoc();

    if (!(hashPassword($this->password) === $user['password'])) {
      return responseError("Incorrect password");
    }

    return responseSuccess("Login successful", $user);
  }

  // Update user
  public function updateUser($id, $full_name, $email)
  {
    $query = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $query->bind_param("si", $email, $id);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
      return responseError("Email is already used by another user");
    }

    $query = $this->conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
    $query->bind_param("ssi", $full_name, $email, $id);

    if ($query->execute()) {
      return responseSuccess("User updated successfully");
    }

    return responseError("Failed to update user");
  }

  // Delete user
  public function deleteUser($id)
  {
    $query = $this->conn->prepare("DELETE FROM users WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
      return responseSuccess("User deleted successfully");
    }
    return responseError("Failed to delete user");
  }
}
