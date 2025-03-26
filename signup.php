<?PHP 
# memanggil fail header.php dan connection.php 
include('header.php'); 
include('connection.php');

# menguji kewujudan data POST yang dihantar oleh bahagian borang di bawah 
if(!empty($_POST))
{
           # mengambil dan menapis data POST 
           $nama                 =     mysqli_real_escape_string($condb, $_POST['nama']); 
           $nokp                 =     mysqli_real_escape_string($condb, $_POST['nokp']); 
           $katalaluan           =     mysqli_real_escape_string($condb, $_POST['katalaluan']); 
           $id_kelas             =     $_POST['id_kelas']; 


           # menyemak kewujudan data yang dimasukkan. 
           if(empty($nama)   or   empty($nokp)   or   empty($katalaluan)   or   empty($id_kelas))
           {
           die("<script>alert('Sila lengkapkan maklumat'); 
           window.history.back(); </script>");
           }
           #had atas dan had bawah    :     sebagai data validation kepada nokp 
           if(strlen($nokp)!=12 or !is_numeric($nokp) )
           {
                die("<script>alert('Ralat No K/P.'); 
                window.history.back();</script>");
           }
            # arahan untuk menyimpan data murid yang dimasukkan 
           $arahan_simpan="insert into murid 
           (nama_murid, nokp_murid, katalaluan_murid,id_kelas) 
           values 
           ('$nama', '$nokp', '$katalaluan', '$id_kelas')";

           #laksanakan arahan dalam block if 
           if(mysqli_query($condb, $arahan_simpan))
           {
               #data berjaya disimpan. papar popup 
               echo "<script>alert('Pendaftaran BERJAYA.'); 
               window.location.href='index.php';</script>";

           } 
           else
           {
                         # data gagal disimpan papar popup 
                         echo "<script>alert('Pendaftaran GAGAL.'); 
                         window.history.back();</script>";
           }  
}
?>

<div class="w3-row w3-white w3-margin-top w3-margin-bottom w3-round-xlarge">
  <div class="w3-third w3-container">
    
 <!-- Bahagian borang untuk mendaftar murid baru --> 
<p style='color:#5E60CE;font-size:24px' >Pendaftaran Murid Baru</p> 
<form action='' method='POST'> 
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-user-circle-o">
			</i></div>
			<div class="w3-rest">
			    <input class="w3-input w3-animate-input w3-border w3-round-large" type='text' name='nama' placeholder='Nama' style="width:50%">
                </div>
            </div> 
            
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-id-card-o">
			</i></div>
			<div class="w3-rest">
			    <input class="w3-input w3-animate-input w3-border w3-round-large" name='nokp' placeholder='04050301xxxx' type='text' style="width:50%">
                </div>
            </div> 
            
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-unlock-alt">
			</i></div> 
			<div class="w3-rest">
			    <input class="w3-input w3-animate-input w3-border w3-round-large" name='katalaluan' placeholder='Katalaluan' type='password' style="width:50%">
                </div>
            </div>
            
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-id-badge">
			</i></div> 
                <select class="w3-select w3-border w3-round-large" name='id_kelas' style="width:44%">
                <option value selected disable> Pilihan Kelas </option>

<?PHP 
# arahan untuk mencari semua data dari jadual kelas 
$sql="select* from kelas";

# Melaksanakan arahan mencari data 
$laksana_arahan_cari = mysqli_query($condb, $sql);

# pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris 
while  ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari))
{
# memaparkan data yang ditemui dalam element <option></option> 
echo "<option value=".$rekod_bilik['id_kelas'].">".$rekod_bilik['ting']." 
".$rekod_bilik['nama_kelas']."</option>";
}
?>

</select> 
<br><input style="background-color:#56CFE1;color:#ffffff" class="w3-margin-top w3-button w3-border w3-round-xlarge w3-card" type='submit' value='Daftar' i class="fa fa-sign-in" aria-hidden="true"></i>
<a style="background-color:#56CFE1;color:#ffffff" class="w3-margin-top w3-button w3-border w3-round-xlarge w3-card" href='index.php'>Kembali ke Laman Log Masuk</a> 
</form>

</div>
<div class="w3-row w3-center w3-padding-64 w3-display-right w3-twothird w3-container">

    <br><img src='images/s4.png'  class='image'  style="width:74%">

</div>
</div>


<?PHP 
mysqli_close($condb); 
include ('footer.php'); 
?>
         
