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
<?php
include "koneksi.php";
if(isset($_POST["ok"]))
{
    $id_peminjaman=$_POST['id_peminjaman'];
    $jumlah_barang=$_POST['jumlah_barang'];
    $tanggal_pinjam=$_POST['tanggal_pinjam'];
    $tanggal_kembali=$_POST['tanggal_kembali'];
    $id_member=$_POST['id_member'];
    $id_petugas=$_POST['id_petugas'];
    $id_barang=$_POST['id_barang'];
    
    $selSto =mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['jumlah_barang'];
    $sisa    =$stok-$jumlah_barang;

    $simpan=mysqli_query($koneksi, "insert into peminjaman set
    id_peminjaman='$id_peminjaman',
    jumlah_barang='$jumlah_barang',
    tanggal_pinjam='$tanggal_pinjam',
    tanggal_kembali='$tanggal_kembali',
    id_member='$id_member',
    id_petugas='$id_petugas',
    id_barang='$id_barang'");
    
  
    $upstok= mysqli_query($koneksi, "UPDATE barang SET jumlah_barang='$sisa' WHERE id_barang='$id_barang'");
                
    if($simpan)
    {
        echo "<div class='alert alert-success' > Sukses menambahkan data baru!</div> ";
    } else {
        echo "<div class='alert alert-danger' > Gagal menambahkan data baru!</div> ";
    }

}
?>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
            <h2>Form Input Data Peminjaman</h2>
       <form method="post" action="">
        <div class="form-group">
            <label><b>Id Peminjaman</b></label>
            <input type="text" class="form-control" placeholder="id peminjaman" name="id_peminjaman">
        </div>
        <div class="form-group">
            <label><b>Jumlah Barang</b></label>
            <input type="text" class="form-control" placeholder="jumlah barang" name="jumlah_barang">
        </div>
        <div class="form-group">
            <label><b>Tanggal Pinjam</b></label>
            <input type="date" class="form-control" placeholder="tanggal pinjam" name="tanggal_pinjam">
        </div>
        <div class="form-group">
            <label><b>Tanggal Kembali</b></label>
            <input type="date" class="form-control" placeholder="tanggal kembali" name="tanggal_kembali">
        </div>
        <div class="form-group">
            <label><b>Id Member</b></label>
            <select name="id_member" class="form-control">
            <option>Pilih</option>
              <?php
              $t_member = mysqli_query($koneksi, "select id_member, nama from member");
              foreach ($t_member as $member){
                echo "<option value=$member[id_member]>$member[nama]</option>";
              }
              ?>
              </select>
        </div>
        <div class="form-group">
            <label><b>Id Petugas</b></label>
            <select name="id_petugas" class="form-control">
            <option>Pilih</option>
            <?php
              $t_petugas = mysqli_query($koneksi, "select id_petugas, nama_petugas from petugas");
              foreach ($t_petugas as $petugas){
                echo "<option value=$petugas[id_petugas]>$petugas[nama_petugas]</option>";
              }
              ?>
              </select>
        </div>
        <div class="form-group">
            <label><b>Id Barang</b></label>
            <select name="id_barang" class="form-control">
            <option>Pilih</option>
            <?php
              $t_barang = mysqli_query($koneksi, "select id_barang, nama_barang from barang");
              foreach ($t_barang as $barang){
                echo "<option value=$barang[id_barang]>$barang[nama_barang]</option>";
              }
              ?>
              </select>
        </div>
        <br>
        <button type="submit" name="ok" class="btn btn-primary">SIMPAN </button>
        <button type="reset" class=" btn btn-danger">CANCEL</button>
</form>
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