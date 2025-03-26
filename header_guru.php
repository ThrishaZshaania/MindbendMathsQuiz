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
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Quicksand', sans-serif;
        font-size: 18px;
      }
      
      ::-webkit-scrollbar {
        width: 12px;
      }

      ::-webkit-scrollbar-track {
        background:  linear-gradient(0deg,rgba(128, 255, 219, 1) 20% , rgba(105, 48, 195, 1) 80%);
      }

      ::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 6px;
        box-shadow: 0px 0px 0px 100000vh lightgray;
      }
    </style>
  </head>
<body background='../images/t21.png'>

<!-- header -->
<div class="w3-container w3-center" style='height: 60px;background:linear-gradient(to left,rgba(128, 255, 219, 1) 0% , rgba(105, 48, 195, 1) 100%)'>   
        <b style='font-size: 35px' class="w3-text-white">Bahagian Administrator/Guru</b>
        <i style="color:white" class="fa fa-user-circle-o fa-2x"></i>
</div>


<!-- menu -->
<div class="w3-bar" style='width:100%;height:40px;background:linear-gradient(to right,rgba(225, 231, 236, 1) 0% , rgba(248, 250, 251, 1) 100%)'>
    <a href='index.php'     class="w3-bar-item w3-round-xxlarge w3-button w3-hover-white" style="color:white" > <i class="fa fa-home "></i> LAMAN UTAMA </a>
    <a href='../logout.php' class="w3-bar-item w3-round-xxlarge w3-button w3-right w3-hover-white" style="color:white" >LOGOUT  <i class="fa fa-sign-out"></i> </a>

    <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
    <div class="w3-dropdown-hover">
        <button class="w3-button w3-round-xxlarge w3-hover-white" style="color:white">ADMINISTRATOR <i class='fa fa-user-circle' aria-hidden='true'></i></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href='guru_senarai.php'  class="w3-bar-item w3-round-xxlarge w3-button w3-hover-light-gray" style='font-size: 17px'>Maklumat Guru</a>
            <a href='murid_senarai.php' class="w3-bar-item w3-round-xxlarge w3-button w3-hover-light-gray" style='font-size: 17px'>Pengurusan Murid</a>
            <a href='senarai_kelas.php' class="w3-bar-item w3-round-xxlarge w3-button w3-hover-light-gray" style='font-size: 17px'>Pengurusan Kelas</a>
        </div>
    </div>
    <?PHP } ?>


    <div class="w3-dropdown-hover">
        <button class="w3-button w3-round-xxlarge w3-hover-white" style="color:white">GURU <i class="fa fa-street-view"></i> </button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href='soalan_set.php' class="w3-bar-item w3-button w3-round-xxlarge w3-hover-light-gray" style='font-size: 17px'>Pengurusan Soalan</a>
            <a href='analisis.php'   class="w3-bar-item w3-button w3-round-xxlarge w3-hover-light-gray" style='font-size: 17px'>Analisis Prestasi</a>
        </div>
    </div>
</div>
<div class='w3-container'>
