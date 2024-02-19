<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Peminjaman Alat</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body>
    <!-- Start your project here-->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning mb-3">
 <a class="navbar-brand" href="#"> Lab RPL AKSATA</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" datatarget="#navbarNavDropdown" aria-controls="navbarNavDropdown" ariaexpanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
 <ul class="navbar-nav">
 <li class="nav-item active">
 <a class="nav-link" href="index.html">Home</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="login.php">Login</a>
 </li>
 </ul>
 </div>
</nav>
<?php
    include "koneksi.php";
    if(isset($_POST["submit"])){
        session_start();
        $_SESSION["id_petugas"]=$_POST["id_petugas"];
        $_SESSION["password"]=$_POST["password"];

         $id_petugas=$_SESSION["id_petugas"];
         $password=$_SESSION["password"];
         $login=mysqli_query($koneksi,"select * from petugas where
         id_petugas='$id_petugas'AND
         password='$password'");
         $cek=mysqli_num_rows($login);

         if($cek==1)
    
    {
        header('location:dashboard.php');
    } else {
   echo"<div class='alert alert-danger'> Anda bukan Admin !</div>";
    }
    }
    ?>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
          <form method="post" action="">
            Username<br>
            <input type="text" name="id_petugas"><br>
            Password<br>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="submit">
</form>
        </div>
      </div>
    </div>
   
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
