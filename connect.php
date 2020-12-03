<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}

$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];
  

  if(empty($Username) || empty($Password) ) {
    echo "All fields are compulsory.";
  } else {
    if(strlen($Password) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $Password)) {
      echo "Please enter a valid Password";
    } else if(!filter_var($Username, FILTER_VALIDATE_EMAIL)) {
      echo "Please enter a valid Username";
    } else {

      $sql = "INSERT INTO loginpage (Username, Password) VALUES (:Username, :Password)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['Username' => $Username, 'Password' => $Password ]);

     
    }
  }

}

?>
