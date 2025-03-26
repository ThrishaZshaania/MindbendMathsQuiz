<?PHP

#Memulakan fungsi session\
session_start();
#Memanggil fail guard_guru.php
include('guard_guru.php');
#Memanggil fail connection dari folder utama
include('../connection.php');
#Menguj1 pembolehubah session tahap mempunyai nilal atau tidak
if(empty($_SESSION['tahap']))

{
    #proses untuk mendapatkan tahap pengguna yang sedang login samada admin atau guru
    $arahan_semak_tahap="select* from guru where 
    nokp_guru = '".$_SESSION['nokp_guru']."'
    limit 1";
    $laksana_semak_tahap=mysqli_query($condb, $arahan_semak_tahap);
    $data=mysqli_fetch_array($laksana_semak_tahap);
    $_SESSION['tahap']=$data['tahap'];
}
?>

<!doctype HTML>
<html>
  <head>
    <title>Mindbend Portal Matematik</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Quicksand', sans-serif;
        font-size: 20px;
        
      }
    </style>
  </head>
<body background='../images/t2.png'>


<!-- header -->
<div class="w3-container">
    <b style='font-size: 35px' class="w3-text-white w3-center">Bahagian Guru/Administator</b>
    <i style="color:white" class="fa fa-user-circle-o fa-2x"></i>
</div>

<!-- menu -->
<div class="w3-bar">
    <a href='index.php'     class="w3-bar-item w3-button" style="color:white" >Laman Utama</a>
    <a href='../logout.php' class="w3-bar-item w3-button w3-right" style="color:white" >Logout</a>

    <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
    <div class="w3-dropdown-hover">
        <button class="w3-button" style="color:white">Administator</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href='guru_senarai.php'  class="w3-bar-item w3-button" style='font-size: 17px'>Maklumat Guru</a>
            <a href='murid_senarai.php' class="w3-bar-item w3-button" style='font-size: 17px'>Pengurusan Murid</a>
            <a href='senarai_kelas.php' class="w3-bar-item w3-button" style='font-size: 17px'>Pengurusan Kelas</a>
        </div>
    </div>
    <?PHP } ?>


    <div class="w3-dropdown-hover">
        <button class="w3-button" style="color:white">Guru</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href='soalan_set.php' class="w3-bar-item w3-button" style='font-size: 17px'>Pengurusan Soalan</a>
            <a href='analisis.php'   class="w3-bar-item w3-button" style='font-size: 17px'>Analisis Prestasi</a>
        </div>
    </div>
</div>


<!-- isi kandungan -->
<div class="w3-container">
  <p>Isi Kandungan</p>
  </div>

<?PHP include ('../iklan_bawah.php'); ?>
<!-- footer -->
<div class="w3-container w3-center"  style="background-color:#ecf7f9">
    <p  style='font-size: 12px'>Hakcipta &copy 2020-2021 : Thrisha Thirumorthy
    <br style='font-size: 12px'>Mindbend Portal Matematik ini dioptimumkan bagi tujuan pembelajaran atas talian sahaja.Hak cipta terpelihara.
    </p>
</div>
<?PHP mysqli_close($condb);?>

</body>
</html>