<?PHP 
# Memanggil fail header_guru.php 
include('header_guru.php');

#-----------bahagian menyimpan data soalan baru
# Menyemak kewujudan data POST 
if(!empty($_POST))
{
    #Mengambil data POST 
    $soalan    =   mysqli_real_escape_string($condb, $_POST['soalan']); 
    $jawapan_a =   mysqli_real_escape_string($condb,$_POST['jawapan_a']);
    $jawapan_b =   mysqli_real_escape_string($condb,$_POST['jawapan_b']);
    $jawapan_c =   mysqli_real_escape_string($condb,$_POST['jawapan_c']);
    $jawapan_d =   mysqli_real_escape_string($condb,$_POST['jawapan_d']);

    #Menguji jika soalan yang dihasilkan mempunyai gambar
    if($_FILES['gambar']['size'] != 0)
    {
        #Bahagian memuatnaik gambar soalan 
        $timestmp           =    date("Y-m-dhisA");
        $saiz_fail         =     $_FILES['gambar']['size'];
        $nama_fail         =     basename($_FILES[ "gambar"]["name"]);
        $jenis_gambar      =     pathinfo($nama_fail, PATHINFO_EXTENSION);
        $lokasi            =     $_FILES['gambar']['tmp_name'];
        $nama_baru_gambar  =     "../images/".$timestmp.".".$jenis_gambar;
        move_uploaded_file($lokasi, $nama_baru_gambar);

        #Arahan untuk menyimpan soalan yang mempunyai gambar 
        $arahan_simpan="insert into soalan 
        (no_set, soalan, gambar, jawapan_a, jawapan_b, jawapan_c, jawapan_d)
        values 
        ('".$_GET['no_set']."','$soalan','$nama_baru_gambar', '$jawapan_a', '$jawapan_b', '$jawapan_c', '$jawapan_d')";
    }
    else
    {
        #arahan untuk menyimpan soalan yang tidak mempunyai gambar 
        $arahan_simpan="insert into soalan 
        (no_set, soalan, gambar, jawapan_a, jawapan_b, jawapan_c, jawapan_d)
        values
        ('".$_GET['no_set']."','$soalan',' ', '$jawapan_a', '$jawapan_b', '$jawapan_c', '$jawapan_d')";
  
    }
    #Menyemak kewujudan data soalan dan jawapan 
    if(empty($soalan) or empty($jawapan_a) or empty($jawapan_b) or empty($jawapan_c)or empty($jawapan_d))
    {
        die("<script>alert('Sila lengkapkan maklumat'); 
        window.history.back();</script>");
    }
    #Melaksanakan arahan untuk menyimpan soalan
    if(mysqli_query($condb, $arahan_simpan))
    {
        #Data soalan berjaya disimpan
        echo "<script>alert('Pendaftaran BERJAYA.'); 
        window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';
        </script>";
    }
    else
    {
        #Data soalan gagal disimpan
        echo "<script>alert('Pendaftaran GAGAL.'); 
        window.location.href='soalan_daftar.php?no_set=".$_GET['no_set']."&topik=".$_GET['topik']."';
        </script>";
    }
}
?>
<!-- Bahagian untuk untuk memaparkan soalan yang telah didaftarkan-->
<div class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>
<b style='font-size:22px' class='w3-margin-left'>Senarai Soalan</b>
</div>
<?PHP include ('audio_guru.php'); ?>
<?PHP include ('../butang_saiz.php'); ?>
<div class='w3-responsive'>
<table width='90%' border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'>
    <tr style='background-color:#5E60CE' class='w3-text-white'>
        <td>Soalan</td> 
        <td>Gambar Soalan</td> 
        <td style='background-color:#00ff00'>Jawapan A (Betul)</td> 
        <td style='background-color:#ff4d4d'>Jawapan B</td> 
        <td style='background-color:#ff4d4d'>Jawapan C</td> 
        <td style='background-color:#ff4d4d'>Jawapan D</td>
        <td></td> 
    </tr> 
    <tr> 
    <!-- Borang untuk mendaftar soalan baru --> 
        <form action='' method='POST' enctype='multipart/form-data'>
            <td><textarea class="w3-input w3-border w3-round-large" name='soalan' rows="4" cols="25"></textarea></td> 
            <td><input type='file' name='gambar'></td> 
            <td style='background-color:#00ff00'> 
            <textarea class="w3-input w3-border w3-round-large" name='jawapan_a' rows="4" cols="25"></textarea> 
            </td> 
            <td style='background-color:#ff4d4d'><textarea class="w3-input w3-border w3-round-large" name='jawapan_b' rows="4" cols="25"></textarea></td> 
            <td style='background-color:#ff4d4d'><textarea class="w3-input w3-border w3-round-large" name='jawapan_c' rows="4" cols="25"></textarea></td> 
            <td style='background-color:#ff4d4d'><textarea class="w3-input w3-border w3-round-large" name='jawapan_d' rows="4" cols="25"></textarea></td>
            <td><input style='background-color:#56CFE1;color:#ffffff' class='w3-block w3-button w3-round-xlarge w3-card' type='submit' value='SIMPAN'>    
            </td> 
        </form> 
    </tr>
<?PHP 
#arahan untuk mencari soalan berdasarkan set soalan 
$arahan_soalan="select* from soalan 
where no_set   = '".$_GET['no_set']."' 
order by no_soalan DESC";

#melaksanakan arahan mencari soalan
$laksana_soalan=mysqli_query($condb,$arahan_soalan);

#Mengambil data soalan yang ditemui 
while ($data=mysqli_fetch_array($laksana_soalan))
{
    #Mengumpukkan data soalan kepada tatasusunan $data_get 
    $data_get=array (
        'no_set'     =>  $data['no_set'],
        'no_soalan'  =>  $data['no_soalan'],
        'topik'      =>  $_GET['topik'],
        'soalan'     =>  $data['soalan'],
        'jawapan_a'  =>  $data['jawapan_a'],
        'jawapan_b'  =>  $data['jawapan_b'],
        'jawapan_c'  =>  $data['jawapan_c'],
        'jawapan_d'  =>  $data['jawapan_d']
    );
    # Memaparkan soalan yang ditemui 
    echo "<tr>
        <td width='25%'>".$data['soalan']."</td> 
        <td><img src='".$data['gambar']."' width='50%'></td> 
        <td>".$data['jawapan_a']."</td> 
        <td>".$data['jawapan_b']."</td> 
        <td>".$data['jawapan_c']."</td> 
        <td>".$data['jawapan_d']."</td> 
        <td class='w3-center'>
        <a href='soalan_kemaskini.php?".http_build_query($data_get)."'title='Kemaskini Soalan' ><i style='color:#FFC300' class='w3-xxlarge fa fa-pencil-square-o' aria-hidden='true'></i></a>
        <a href='padam.php?jadual=soalan&medan=no_soalan&kp=".$data['no_soalan']."' onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\"title='Padam Soalan' ><i style='color:#ff3333' class='w3-xxlarge fa fa-trash-o' aria-hidden='true'></i></a>
        </td>
    </tr>";
}
?>
</table> 
<?PHP include('footer_guru.php'); ?>