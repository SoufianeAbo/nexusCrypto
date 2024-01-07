<?php

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
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
    $this->db->query('INSERT INTO users (FirstName, LastName, DateOfBirth, Email, PasswordHash, NexusID) VALUES(:first_name, :last_name, :DateOfBirth, :email, :password, :NexusID)');
  // Bind values
    $this->db->bind(':first_name', $data['FirstName']);
    $this->db->bind(':last_name', $data['LastName']);
    $this->db->bind(':DateOfBirth', $data['DateOfBirth']);
    $this->db->bind(':email', $data['Email']);
    $this->db->bind(':password', $data['PasswordHash']);
    $this->db->bind(':NexusID', $data['NexusID']);

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
  // Find user by email
  public function findUserByNexusID($NexusID)
  {
    $this->db->query('SELECT * FROM users WHERE NexusID = :NexusID');
    // Bind value
    $this->db->bind(':NexusID', $NexusID);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      echo "KAYN NEXUS";
      return $row;
    } else {
      echo "nope MAKAYNCH NEXUS";
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

//   public function saveRegisterVerification($email, $registerverification) {
//     $this->db->query('UPDATE users SET register_verification = :registerverification WHERE Email = :email');
//     $this->db->bind(':registerverification', $registerverification);
//     $this->db->bind(':email', $email);

//     return $this->db->execute();
// }

  public function saveVerificationCode($email, $verificationCode) {
    $this->db->query('UPDATE users SET verification_code = :verificationCode WHERE Email = :email');
    $this->db->bind(':verificationCode', $verificationCode);
    $this->db->bind(':email', $email);

    return $this->db->execute();
}

private function configureMailer(PHPMailer $mail, $email) {
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eytchcreations@gmail.com';
        $mail->Password = 'hibabeghdi0658144394';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('hibabeg@gmail.com', 'BEGHDI');
        $mail->addAddress($email);
        $mail->isHTML(true);

        return true;
    } catch (Exception $e) {
        // Handle exceptions (log or display an error message)
        return false;
    }
}

public function sendVerificationEmail($email) {
    $mail = new PHPMailer(true);

    if ($this->configureMailer($mail, $email)) {
        try {
            // Générer un code de vérification
            $verificationCode = mt_rand(100000, 999999);

            // Sauvegarder le code dans la base de données
            $this->saveVerificationCode($email, $verificationCode);

            // Configurer le courriel
            $mail->Subject = 'Verification Email';
            $mail->Body = 'Your verification code is: ' . $verificationCode;

            // Envoyer le courriel
            $mail->send();

            $mail->SMTPDebug = 1;

          //   if (!$mail->send()) {
          //     throw new Exception('Error sending verification email: ' . $mail->ErrorInfo);
          // }

            return $verificationCode; // Retourner le code de vérification
        } catch (Exception $e) {
            // Handle exceptions (log or display an error message)
            error_log('Error sending verification email: ' . $e->getMessage());
            return false;
        }
    }

    return false;
}

public function verifyUserByCode($verificationCode) {
    // Query the database to find the user by verification code
    $this->db->query('SELECT * FROM users WHERE verification_code = :verificationCode');
    $this->db->bind(':verificationCode', $verificationCode);
    
    // Fetch the result as an associative array
    $user = $this->db->single();
    
    if ($user && $this->isVerificationCodeValid($user, $verificationCode)) {
        // Update the user's status as verified (optional)
        $userId = isset($user['id']) ? $user['id'] : null;
        // $this->updateVerificationStatus($userId);
    
        return $user;
    }
    
    // try {
    //   // Fetch the result as an associative array
    //   $user = $this->db->single();

    //   if ($user && $this->isVerificationCodeValid($user, $verificationCode)) {
    //       // Update the user's status as verified (optional)
    //       $userId = isset($user['id']) ? $user['id'] : null;
    //       // Uncomment this line if you want to update the user status
    //       // $this->updateVerificationStatus($userId);

    //       return $user;
    //   }

    //   } catch (Exception $e) {
    //       // Handle exceptions (log or display an error message)
    //       error_log('Error verifying user by code: ' . $e->getMessage());
    //   }

    return false;
}

private function isVerificationCodeValid($user, $providedCode) {
    // Implement any additional validation logic for verification codes here
    // This could include checking the expiration time or other criteria
    
    // For simplicity, this example assumes a direct string match
    return $user['verification_code'] === $providedCode;
}
// private function updateVerificationStatus($userId) {
//     $this->db->query('UPDATE users SET verified = :status WHERE UserID = :userId');
//     $this->db->bind(':status', USER_VERIFIED);
//     $this->db->bind(':userId', $userId);
//     $this->db->execute();
// }
}


