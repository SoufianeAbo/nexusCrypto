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
    $this->db->query('INSERT INTO nexus.users (FirstName, LastName, DateOfBirth, Email, PasswordHash) VALUES(:first_name, :last_name, :DateOfBirth, :email, :password)');
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
    $this->db->query('SELECT * FROM nexus.users WHERE Email = :email');
    $this->db->bind(':email', $email);
    // echo $email;


    $row = $this->db->single();
    // Assuming you have a single method in your database class
      $hashed_password = $row->PasswordHash;


      if (password_verify($password, $hashed_password)) {

        return $row;
      } else {
        // Password is incorrect
        return false;
      }
    }


  // Find user by email
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM nexus.users WHERE Email = :email');
    // Bind value
    $this->db->bind(':email', $email);

     $this->db->single();

    // Check row
      if($this->db->rowCount() > 0){
          return true;
      }else{
          return false ;
      }
  }

  // Get User by ID
  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM nexus.users WHERE UserID = :id');
    // Bind value
    $this->db->bind(':id', $id);

      return $this->db->single();
  }
}
