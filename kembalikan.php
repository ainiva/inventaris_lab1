<?php 
include "koneksi.php";
$ambildata = mysqli_query($koneksi, "select * from peminjaman where id_peminjaman='$_GET[id_peminjaman]'");
if (is_iterable($ambildata)) {
foreach ($ambildata as $kembali) {
  $id_peminjaman = $kembali ['id_peminjaman'];
  $id_barang = $kembali ['id_barang'];
  $jumlah_barang = $kembali ['jumlah_barang'];
	$id_member = $kembali ['id_member'];
  $tanggal_pinjam = $kembali ['tanggal_pinjam'];
  $tanggal_kembali = strtotime ($kembali ['tanggal_kembali']);

  $selSto =mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
  $sto    =mysqli_fetch_array($selSto);
  $stok    =$sto['jumlah_barang'];
  $kembali    =$stok + $jumlah_barang;

  $upstok= mysqli_query($koneksi, "UPDATE barang SET jumlah_barang='$kembali' WHERE id_barang='$id_barang'");

  $tgl_hari_ini = date('Y-m-d');
  $tanggal = strtotime($tgl_hari_ini);
  $selisih = $tanggal - $tanggal_kembali;
  $terlambat = $selisih /60/60/24;
  $jumlah_denda = $terlambat * 1000;

  $kembali = mysqli_query($koneksi, "insert into pengembalian set
  id_peminjaman = '$id_peminjaman',
  jumlah_barang = '$jumlah_barang',
  id_barang = '$id_barang',
  id_member = '$id_member',
  tanggal_pinjam = '$tanggal_pinjam',
  tanggal_kembali = '$tgl_hari_ini',
  terlambat = '$terlambat',
  jumlah_denda = '$jumlah_denda'
  ");

  $hapus_peminjaman = mysqli_query($koneksi, "delete from peminjaman where id_peminjaman='$_GET[id_peminjaman]'");
  header("location:datapengembalian.php");
}
}
?>