<?PHP
#memulakan fungsi session_start bg membolehkan pemboleh ubah super global 
# session digunakan 
session_start();
$a="";
$urls=$_SERVER['PHP_SELF'];
if(strpos($urls,"/murid/") !==false){   $a="../";}
?>

<!doctype HTML>
<html>
  <head>
    <title>Mindbend Portal Matematik</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
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
        background:  linear-gradient(0deg,rgba(128, 255, 219, 1) 0% , rgba(105, 48, 195, 1) 100%);
      }

      ::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 6px;
        box-shadow: 0px 0px 0px 100000vh lightgray;
      }
      .container {
      position: relative;
      width: 100%;
      max-width: 1000px;
      }

      .container img {
      width: 100%;
      height: 100%;
      }

      .container .btn {
      position: absolute;
      top: 50%;
      left: 65%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color:#fff;
      color: black;
      font-size: 18px;
      padding: 12px 24px;
      border: none;
      cursor: pointer;
      border-radius: 30px;
      text-align: center;
      opacity:0.7;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      text-decoration: none;
      scroll-behavior: smooth;
      }
 
      .container .btn:hover {
      background:#faeb92;
      }
     
    </style>
  </head>
  <body background='<?=$a?>images/t21.png' style='width:100%'>

  <!-- header -->
  <div class="w3-container w3-center" style='height: 60px;background:linear-gradient(to left,rgba(128, 255, 219, 1) 0% , rgba(105, 48, 195, 1) 100%)'>  
        <b style='font-size: 37px' class="w3-text-white">Mindbend Portal Matematik</b>
    </div>

  <!-- menu -->
  <div style='width:100%;font-size: 19px;height:40px;color:#000000;background:linear-gradient(to right,rgba(225, 231, 236, 1) 0% , rgba(248, 250, 251, 1) 100%)' class="w3-bar">
  <!-- Menu bahagian Murid -->
  <?PHP if (!empty ($_SESSION) and basename($_SERVER[ 'PHP_SELF' ]) != 'index.php' ) { ?>
    <?PHP echo "<span style='height:40px;background:linear-gradient(0deg,rgba(250, 235, 146, 1) 0% , rgba(255, 145, 153, 1) 100%);font-size: 19px;opacity:0.8;border-radius:15px' class='w3-bar-item w3-text-white'>Nama Murid : ".$_SESSION['nama_murid']." <i class='fa fa-child fa-lg' aria-hidden='true'></i></span>" ;?>
    <a class="w3-bar-item w3-round-xxlarge w3-button w3-hover-light-gray w3-text-white " style='height:40px;color:#64DFDF;font-size:19px' href='pilih_latihan.php'> <i class="fa fa-home"></i> LAMAN UTAMA</a> 
    <a class="w3-bar-item w3-round-xxlarge w3-button w3-hover-light-gray w3-text-white w3-right" style='height:40px;color:#64DFDF;font-size:19px' href='../logout.php'>LOGOUT <i class="fa fa-sign-out"></i></a>
  
  <?PHP }
  else
  echo "<span style='width:100%;font-size: 19px;height:40px;color:#000000;background:linear-gradient(to right,rgba(225, 231, 236, 1) 0% , rgba(248, 250, 251, 1) 100%)' class='move w3-bar-item'><marquee direction='right'>SELAMAT DATANG! SILA KLIK PADA BUTANG LOGIN😊.</marquee></span>"; 
  ?>
  </div>
  <!-- isi kandungan -->
  <div class='w3-container'>
  <br>
  
  

