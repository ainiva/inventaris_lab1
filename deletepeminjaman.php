<?php
//include database connection file
include_once("koneksi.php");

//Get id from URL to delete that user 
$id_peminjaman = $_GET['id_peminjaman'];
$hasil="delete from peminjaman where id_peminjaman = '$id_peminjaman'";
$query=mysqli_query($koneksi,$hasil);
//Delete user row from table based on given id
if ($query)
{
    header ("location:datapeminjaman.php");
}
else{
    "<script>alert('Data Gagal di Hapus');history.go(-1);</script>";
}
?>