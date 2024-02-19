<?php
//include database connection file
include_once("koneksi.php");

//Get id from URL to delete that user 
$id_barang = $_GET['id_barang'];
$hasil="delete from barang where id_barang = '$id_barang'";
$query=mysqli_query($koneksi,$hasil);
//Delete user row from table based on given id
if ($query)
{
    header ("location:databarang.php");
}
else{
    "<script>alert('Data Gagal di Hapus');history.go(-1);</script>";
}
?>