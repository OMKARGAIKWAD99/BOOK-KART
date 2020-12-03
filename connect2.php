<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "signup";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}

$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Firstname = $_POST['Firstname'];
  $Lastname = $_POST['Lastname'];
  $Password = $_POST['Password'];
  $Email = $_POST['Email'];
  
 
  

  

  if(empty($Firstname) || empty($Lastname) || empty($Password)||empty($Email)) {
    echo "All fields are compulsory.";
  } else {
    if(strlen($Password) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $Password)) {
      echo "Please enter a valid Password";
    } else if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      echo "Please enter a valid Username";
    }  else {

      $sql = "INSERT INTO sign (Firstname,Lastname, Password,Email) VALUES (:Firstname, :Lastname,:Password,:Email)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['Firstname' => $Firstname, 'Lastname' => $Lastname ,'Password' => $Password , 'Email' => $Email ]);

     
    }
  }
}
?>
