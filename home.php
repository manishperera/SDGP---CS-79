<?php 
  session_start();
  include 'app/db.conn.php';

  include 'app/helpers/user.php';
  $username = "";
  if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $_SESSION['username'] = $username;
    $user = getUser($username, $conn);
} else if (isset($_SESSION['username'])) {
    $user = getUser($_SESSION['username'], $conn);

} else {
    header("Location: index.php");
    exit;
}

$sql  = "SELECT * FROM 
               users WHERE username=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$user['username']]);

      if($stmt->rowCount() === 1){
        $user = $stmt->fetch();

        if ($user['username'] === $username) {
           
          


            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_id'] = $user['user_id'];

            header("Location: ../../home.php");

          
       
      }}
   