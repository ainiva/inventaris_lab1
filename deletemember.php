<?php
//include database connection file
include_once("koneksi.php");

//Get id from URL to delete that user 
$id_member = $_GET['id_member'];
$hasil="delete from member where id_member = '$id_member'";
$query=mysqli_query($koneksi,$hasil);
//Delete user row from table based on given id
if ($query)
{
    header ("location:datamember.php");
}
else{
    "<script>alert('Data Gagal di Hapus');history.go(-1);</script>";
}
?>