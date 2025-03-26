<?PHP
#memulakan fungsi session_start bg membolehkan pemboleh ubah super global 
# session digunakan 
session_start();?>

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
  <body background='images/t2.png'>

  <!-- header -->
    <div align='center'>    
      <b style='font-size: 36px' class="w3-text-white w3-center">Mindbend Portal Matematik</b>
    </div>
  <!-- menu -->
  <div class="w3-bar">
  <!-- Menu bahagian Murid -->
  <?PHP if (!empty ($_SESSION) and basename($_SERVER[ 'PHP_SELF' ]) != 'index.php') { ?>
  <?PHP echo "<span class='w3-bar-item'>Nama Murid : ". $_SESSION['nama_murid']."</span>"; ?> 
  <a class="w3-bar-item w3-button w3-hover-none w3-border-white w3-bottombar w3-hover-border-light-gray" href='pilih_latihan.php'>Laman Utama</a> 
  <a class="w3-bar-item w3-button w3-hover-none w3-border-white w3-bottombar w3-hover-border-pale-red" href='../logout.php'>Logout</a>
  
  <?PHP }
  else
  echo "<span class='w3-bar-item'>Selamat Datang.Sila Log Masuk</span>"; 
  ?>
  </div>
  <!-- isi kandungan -->
  <div class='w3-container'>

    Isi Kandungan


  </div>

  <!-- footer -->
  <div class='w3-container w3-center' style="background-color:#ecf7f9">
    <!-- Gunakan ayat yang lebih sesuai pada bahagian ini --> 
    <p>Hakcipta &copy 2020-2021 : Cargas solution</p>
    <p>Penafian : Pihak admin tidak bertanggungjawab atas kehilangan akibat penggunaan data yang terkandung dalam sistem ini</p>
  </div>
  </body>
</html>



<td>
		<!--Senarai set latihan terkini-->
		<p style='font-size: 25px' class="w3-text-black">Senarai Latihan Terkini</p>
		<table border='1' class='w3-margin-bottom w3-table-all w3-hoverable'>
		<tr style='background-color:#5E60CE' class='w3-text-white'>
			<td>Topik</td>
			<td>Kelas</td>
			<td>Nama Guru</td>
		</tr> 
		<?php
		#memanggil fail connection.php
		include('connection.php');

		#arahan sql untuk mencari data set soalan yang terkini
		$arahan_latihan="SELECT* FROM set_soalan,guru,kelas
		WHERE
		         set_soalan.nokp_guru = guru.nokp_guru
		AND      kelas.nokp_guru      = guru.nokp_guru
		ORDER BY  topik ASC LIMIT 10";
		
		#melaksanakan arahan SQL diatas
		$laksana_latihan=mysqli_query($condb,$arahan_latihan);

		#mengambil dan memaparkan senarai set soalan,tingkatan yang terlibat dan guru
		while($rekod=mysqli_fetch_array($laksana_latihan))
		{
			echo "<tr>
			<td>".$rekod['topik']."</td>
			<td>".$rekod['ting']." ".$rekod['nama_kelas']."</td>
			<td>".$rekod['nama_guru']."</td>
			</tr>";
		}

		
		mysqli_close($condb);
        ?>
          </table>
		</td>




    <div class="w3-center w3-container w3-padding-large" style="width:100%;">
      <img alt="front" class="w3-image w3-margin-top w3-margin-bottom" src="images/b1.jpg" style="display:block;margin:auto;max-width:100%">
      <a href="#about" style="border-radius:25px" class="w3-btn w3-white w3-text-black w3-padding-large w3-large w3-opacity w3-hover-opacity-off">LOGIN</a>   
  </div>