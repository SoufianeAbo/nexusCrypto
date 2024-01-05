<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Regsiter user
  public function register($data)
  {
    $this->db->query('INSERT INTO users (FirstName, LastName, DateOfBirth, Email, PasswordHash) VALUES(:first_name, :last_name, :DateOfBirth, :email, :password)');
    // Bind values
    $this->db->bind(':first_name', $data['FirstName']);
    $this->db->bind(':last_name', $data['LastName']);
    $this->db->bind(':DateOfBirth', $data['DateOfBirth']);
    $this->db->bind(':email', $data['Email']);
    $this->db->bind(':password', $data['PasswordHash']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Login User
  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM users WHERE Email = :email');
    $this->db->bind(':email', $email);
    // echo $email;

    $this->db->execute();
    $row = $this->db->single(); // Assuming you have a single method in your database class

    if ($row) {
      $hashed_password = $row['password'];
      if (password_verify($password, $hashed_password)) {
        // Password is correct, return user data
        unset($row['password']); // Remove the hashed password from the returned user data
        return $row;
      } else {
        // Password is incorrect
        return false;
      }
    } else {
      // User not found
      return false;
    }
  }

  // Find user by email
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM users WHERE Email = :email');
    // Bind value
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      echo "loool foudn";
      return $row;
    } else {
      echo "nope not found";
      return false;
    }
  }

  // Get User by ID
  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM users WHERE UserID = :id');
    // Bind value
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }
}
