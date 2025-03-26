<?PHP
#memanggil fail header.php dan connection.php dari folder luaran 
include ('../header.php'); 
include ('../connection.php'); 

#menyemak kewujudan data GET dan session[nama murid] 
if (empty($_GET) or empty($_SESSION['nama_murid']))
{
    # jika tidak wujud. aturcara akan dihentikan 
    die("<script>alert('Akses tanpa kebenaran'); 
    window.location.href='pilih_latihan.php';</script>");
}

# memecahkan data GET 
$pecahkanbaris = explode("|",$_GET['kumpul']);

# mengumpukkan data yang dipecahkan kepada pembolehubah 
list($bil_betul, $bil_soalan, $peratus , $bil_jawapan) = $pecahkanbaris;

# arahan untuk mencari jawapan pelajar berdasarkan nokp_murid dan no set soalan 
$arahan_carian="SELECT* 
from set_soalan, soalan, jawapan_murid, murid 
where 
    set_soalan.no_set         =          soalan.no_set
AND soalan.no_soalan          =          jawapan_murid.no_soalan 
AND murid.nokp_murid          =          jawapan_murid.nokp_murid
AND murid.nokp_murid          =          '".$_SESSION['nokp_murid']."'
AND soalan.no_set             =          '".$_GET['no_set']."'
";

# melaksanakan arahan mencari jawapan pelajar 
$laksana_carian=mysqli_query($condb,$arahan_carian);

# memaparkan tajuk ulang kaji, skor dan markah 
echo " 
<div class='w3-row w3-margin-top w3-margin-bottom'>
  <div class='w3-quarter w3-container'>
    

  </div>
  <div class='w3-white w3-half w3-container w3-card'>";
  echo "
  <p style='color:#5E60CE' class= 'w3-center' > Bahagian Ulangkaji <i style='font-size:25px' class='fa fa-pencil-square' aria-hidden='true'></i></p> 
  <p style='color:#5E60CE' class= 'w3-center' >Syabas! Anda telah selesai menjawab soalan dalam latihan/kuiz ini <i style='color:#ffcc00; font-size:20px' class='fa fa-star' aria-hidden='true'></i></p>
  
  Topik : ".$_GET['topik']."<br class='w3-text-amber'>
  
  Skor  : ".$bil_betul." / ".$bil_soalan."<br>
  
  Peratus : ".$peratus."
  
  <hr>";
  
  $bil=0;
  
  # mengambil data jawapan pelajar yang ditemui 
  while($rekod=mysqli_fetch_array($laksana_carian))
  {
      # menguji soalan yang tidak dijawab 
      if($rekod['jawapan']!="tidak jawab")
      {
          $nilai_jawapan=$rekod[$rekod['jawapan']];
      }
      else
      {
          $nilai_jawapan= 'Tidak Jawab';
      }
  
      # memaparkan soalan dan jawapan bagi soalan 
      echo" 
      No Soalan : ".++$bil."<br> 
  
      ".$rekod['soalan']."<br>
  
      <img src='".$rekod['gambar']."'><br>
  
      <li>".$rekod['jawapan_a']." <br> 
      <li>".$rekod['jawapan_b']."<br> 
      <li>".$rekod['jawapan_c']."<br> 
      <li>".$rekod['jawapan_d']."<br><br>
  
      Jawapan Sebenar : ".$rekod['jawapan_a']."<br>
      
      Jawapan anda : ".$nilai_jawapan."<br>
  
      Status  :  ".$rekod['catatan']."
  
  <hr>";
  } 







echo "
<br><button onclick='window.print()' title='Cetak Keputusan' style='background-color:#56CFE1;color:#ffffff' class='w3-block w3-margin-bottom w3-button w3-round-xlarge' >Cetak Keputusan <i class='w3-xlarge fa fa-print' aria-hidden='true'></i></button> 
  </div>
  <div class='w3-quarter w3-container'>
    
  
  </div>
</div>

";



mysqli_close($condb);
?>
<?PHP include('../top.php');
include ('../footer.php'); ?>

