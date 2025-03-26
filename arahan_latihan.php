<?PHP
# memanggil fail header.php dan fail connection.php dari folder luaran 
include ('../header.php'); 
include('../connection.php');

# Menguji kewujudan data GET 
if(empty($_GET))
{
    # Menghenti aturcara jika data get tidak wujud 
    die("<script>alert('Akses tanpa kebenaran'); 
    window.location.href='pilih_latihan.php';</script>");
}

# arahan untuk memilih set_soalan berdasarkan no_set soalan 
$arahan_pilih_set   =   "select* from set_soalan where no_set='".$_GET['no_set']."'";

# Melaksanakan arahan untuk memilih 
$laksana            =    mysqli_query($condb, $arahan_pilih_set); 

# Pembolehubah data mengambil data yang ditemui 
$data               = mysqli_fetch_array($laksana) 
?>


<div class="w3-margin-top w3-row">
  <div class="w3-quarter w3-container">
    
  </div>
  <div class="w3-half w3-container w3-white w3-center w3-card">
    
    <!-- Memaparkan arahan untuk menjawap soalan--> 
    <p class='w3-text-deep-purple'>Arahan</p> 
    <hr> 
    <?PHP echo $data['arahan']; ?><br>
    <a style='background-color:#56CFE1;color:#ffffff' class='w3-margin-bottom w3-margin-top w3-button w3-border w3-round-large w3-block w3-card' href='jawap_soalan.php?no_set=<?PHP echo $_GET['no_set']; ?>&masa=<?PHP echo $data['masa']; ?>&jenis=<?PHP echo $data['jenis']; ?>'>Mula</a>
  </div>
  <div class="w3-quarter w3-container">
    
  </div>
</div>


<?PHP include ('../footer.php'); ?>