<?php
session_start();
if (!isset($_SESSION["id_petugas"])){
  header("location:login.php");
}else{
?>
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
 <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle"
    href="#"
    id="navbarDropdown"
    role="button"
    data-mdb-toggle="dropdown"
    aria-expanded="false">
    Master Data
  </a>
  <!--Dropdown menu-->
  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li>
      <a class="dropdown-item" href="databarang.php">Data Barang </a>
</li>
<li>
  <a class="dropdown-item" href="datamember.php">Data Member </a>
</li>
</ul>
</li>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle"
    href="#"
    id="navbarDropdown"
    role="button"
    data-mdb-toggle="dropdown"
    aria-expanded="false">
    Transaksi
  </a>
  <!--Dropdown menu-->
  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li>
      <a class="dropdown-item" href="datapeminjaman.php">Data Peminjaman </a>
</li>
<li>
  <a class="dropdown-item" href="datapengembalian.php">Data Pengembalian </a>
</li>
 </ul>
 <li class="nav-item active">
  <a class="nav-link" href="logout.php">Logout</a>
 </div>
</nav>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
        <h1> Data Alat Praktik </h1>
        <form action="" method="post">
          Cari Berdasarkan 
          <select name="pilih">
            <option value="id_barang">Id Barang</option>
            <option value="nama_barang">Nama Barang</option>
            <option value="jumlah_barang">Jumlah Barang</option>
            <option value="jenis_barang">Jenis Barang</option>
            <option value="kondisi">Kondisi</option>
</select>
<input  type="text" name="tekscari" size="24">
<input  type="submit" name="cari" value="cari">
<input  type="submit" name="semua" value="Tampilkan semua">
</form>
<br>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Id Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Kondisi</th>
                <th>Deskripsi</th>
                <th th colspan ="2">Aksi</th>
</tr>
<?php
   include"koneksi.php";
   $tampil="";
   if (isset($_POST['cari'])){
       $pilih = $_POST['pilih'];
       $tekscari = $_POST['tekscari'];
       $tampil = mysqli_query($koneksi, "select * from barang where $pilih like '%$tekscari%'");
   }else {
    $tampil = mysqli_query($koneksi, "select * from barang");
   }
  foreach($tampil as $row){
   ?>
<tr>
                <td><?php echo "$row[id_barang]"; ?></td>
                <td><?php echo "$row[nama_barang]"; ?></td>
                <td><?php echo "$row[jumlah_barang]"; ?></td>
                <td><?php echo "$row[jenis_barang]"; ?></td>
                <td><?php echo "$row[kondisi]"; ?></td>
                <td><?php echo "$row[deskripsi]"; ?></td>
                <td><button type="button" class="btn btn-block btn-default btn-sm"><?php echo"<a href='updatebarang.php?id_barang=$row[id_barang]'>Update</a>";?></button></td>
                <td><button type="button" class="btn btn-block btn-default btn-sm"><?php echo"<a href='deletebarang.php?id_barang=$row[id_barang]'>Delete</a>"; ?></button></td>
</tr>
<?php
   }
?>
</table>
<a href="tambahbarang.php">+ Tambahkan data barang +</a>
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
<?php
}
?>