<?php
    session_start();
    $_SESSION["status"]="";
    include('admin/html/connection.php');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
       $password = $_POST['password'];

       $query = "select email , password from users";
       $result = mysqli_query($conn, $query);
       $row = mysqli_fetch_assoc($result);
       if($email == $row['email'] && $password == $row['password']){
        $_SESSION["status"] = true;
    echo "<script>alert('Admin Logged in Successfully');
    window.location.href='admin/html/dashboard.php';
    </script>";
          //  header('location: admin/html/dashboard.php');

       }else{
           $_SESSION["status"] = false;
       
           echo "<script>alert('Wrong Email Or Password Entered');
           window.location.href='admin.php';
           </script>";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
  }
  .login-container {
    width: 300px;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  input[type="text"],
  input[type="password"],
  input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
  }
  input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #0056b3;
  }
  @media only screen and (max-width: 400px) {
    .login-container {
      width: 90%;
    }
  }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form method="post">
      <input type="text" name="email" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="submit" value="Login">
    </form>
  </div>
</body>
</html>