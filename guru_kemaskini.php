<?PHP
#Memanggil fail header_guru.php
include('header_guru.php');

#menyemak kewujudan data GET untuk mengelak fail diakses tanpa data GET
if(empty($_GET))
{
    die("<script>alert ('Akses tanpa kebenaran.');
    window.location.href='murid_senarai.php';</script>");
}
if(!empty($_POST))
{
    #mengambil data baru yang diubah suai melalui borang di bawah 
    $nama       =       mysqli_real_escape_string($condb,$_POST['nama_baru']);
    $nokp       =       mysqli_real_escape_string($condb,$_POST['nokp_baru']);
    $katalaluan =       mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
    $tahap      =       $_POST['tahap'];

    #menyemak kewujudan data yang diambil
    if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($tahap))
    {
        #jika data tidak wujud,aturcara akan terhenti disini.
        die("<script>alert('Sila lengkapkan maklumat');
        window.history.back(); </script> ");
    }
    #had atas &  had bawah.data validation bagi nokp_guru
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        die("<script>alert('Ralat No K/P.');
        window.history.back(); </script>");   
    }

#arahan untuk mengemaskini data guru
    $arahan_kemaskini= "updata guru set
    nama_guru            =     '$nama',
    nokp_guru            =     '$nokp',
    katalaluan_guru      =     '$katalaluan',
    tahap                =     '$tahap',
    where
    nokp_guru            =     '".$_GET['nokp_guru']."'";

    #melaksanakan arahan untuk mengemaskini data guru ke dalam jadual
    if(mysqli_query($condb,$arahan_kemaskini))
    {
        #data berjaya kemaskini
        echo"<script>alert('Kemaskini BERJAYA.');
        window.location.href='guru_senarai.php'; </script>";

    }
    else
    {
        #data gagal kemaskini
        echo"<script>alert('Kemaskini GAGAL.');
        window.location.href='guru_senarai.php'; </script>";
    }  
}
?>

<!--Bahagian untuk memaparkan senarai guru-->
<div class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>
<b style='font-size:22px' class='w3-margin-left'>Kemaskini Maklumat Guru</b>
</div>
<?PHP include ('../butang_saiz.php'); ?>
<div class='w3-responsive'>
<table width='90%' border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'>
    <tr style='background-color:#5E60CE' class='w3-text-white'>
        <td width='18%'>Nama Admin/Guru</td>
        <td width='22%'>No Kad Pengenalan</td>
        <td width='18%'>Katalaluan</td>
        <td class='w3-center' width='20%'>Tahap</td>
        <td class='w3-center'>Tindakan</td>
    </tr>
    <tr>
    <!--Borang untuk mendaftar guru baru-->
        <form action= '' method='POST'>
<td><input type= 'text'     class="w3-input w3-border w3-round-large"   placeholder='Nama Baharu'  name='nama_baru'       value='<?PHP echo $_GET['nama_guru'];?> '></td>
<td><input type= 'text'     class="w3-input w3-border w3-round-large"   placeholder='No K/P Baharu'  name='nokp_baru'       value='<?PHP echo $_GET['nokp_guru'];?> '></td>
<td><input type= 'password' class="w3-input w3-border w3-round-large"   placeholder='Katalaluan Baharu'  name='katalaluan_baru' value='<?PHP echo $_GET['katalaluan_guru'];?> '></td>

         <td>
             <select class="w3-select w3-border w3-round-large" name='tahap'>
                 <option value selected disabled>Pilih</option>
                 <option value ='GURU' >GURU</option>
                 <option value ='ADMIN'>ADMIN</option>
             </select>
         </td>
         <td><input style='background-color:#56CFE1;color:#ffffff' class='w3-block w3-button w3-round-xlarge w3-card' type='submit' value='KEMASKINI'></td>
        </form>
    </tr>
<?PHP
#arahan SQL untuk memilih data dari jadual guru
$arahan_cari_guru="select*from guru order by tahap ASC";

#melaksanakan arahan SQL di atas
$laksana_cari_guru=mysqli_query($condb,$arahan_cari_guru);

#mengambil semua data yang ditemui
while($data=mysqli_fetch_array($laksana_cari_guru))
{
    #umpuk data ke dalam tatasusunan
    $data_guru=array(
        'nama_guru'          =>     $data['nama_guru'],
        'nokp_guru'          =>     $data['nokp_guru'],
        'katalaluan_guru'    =>     $data['katalaluan_guru']
    );

    #memaparkan data dalam bentuk jadual baris demi baris
    echo"<tr>
         <td>".$data['nama_guru']."</td>
         <td>".$data['nokp_guru']."</td>
         <td>".$data['katalaluan_guru']."</td>
         <td class='w3-center'>".$data['tahap']."</td>
         <td class='w3-center'>
    
         <a href='guru_kemaskini.php?".http_build_query($data_guru)."'title='Kemaskini' ><i style='color:#FFC300' class='w3-xxlarge fa fa-pencil-square-o' aria-hidden='true'></i></a>
         <a href='padam.php?jadual=guru&medan=nokp_guru&kp=".$data['nokp_guru']."'title='Padam' ><i style='color:#ff3333' class='w3-xxlarge fa fa-trash-o' aria-hidden='true'></i></a> 
         </td>
    </tr>";
}
?>
</table>
