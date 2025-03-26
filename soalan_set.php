<?PHP
#Memanggil header_guru.php
include('header_guru.php');

#-------bahagian untuk menyimpan data set_soalan baru

# Menyemak kewujudan data POST 
if(!empty($_POST))
{
    #Mengambil data POST 
    $topik   =   mysqli_real_escape_string($condb,$_POST['topik']);
    $arahan  =   mysqli_real_escape_string($condb,$_POST['arahan']);
    $jenis   =   $_POST['jenis'];
    $tarikh  =   $_POST['tarikh'];

    #Menetapkan masa kuiz
    if($jenis =='Latihan')
    $masa   =   "Tiada";
    else
    $masa   =   mysqli_real_escape_string($condb, $_POST['masa']);

    # menyemak kewujudan data yang diambil 
    if (empty($topik) or empty($arahan) or empty($jenis)or empty($tarikh) or empty($masa))
    {
        #jika terdapat pembolehubah yang tidak mempunyai nilai, aturcara akan dihentikan 
        die("<script>alert('Sila lengkapkan maklumat'); 
        window.location.href='soalan_set.php';</script>");
    }
    #Arahan untuk menyimpan data set_soalan baru 
    $arahan_simpan="insert into set_soalan
        (topik, arahan, jenis, tarikh, masa, nokp_guru) 
        values 
        ('$topik', '$arahan', '$jenis', '$tarikh', '$masa','".$_SESSION['nokp_guru']."')";

    #Melaksanakan arahan untuk menyimpan data 
    if (mysqli_query($condb, $arahan_simpan))
    {
        #data berjaya disimpan 
        echo "<script>alert('Pendaftaran BERJAYA.'); 
        window.location.href='soalan_set.php'; </script>";
    }
    else
    {
        #data gagal disimpan 
        echo "<script>alert('Pendaftaran GAGAL.'); 
        window.location.href='soalan_set.php'; 
        </script>";
    }
}

?>

<!-- bahagian untuk memaparkan senarai set soalan -->
<div class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>
<b style='font-size:22px' class='w3-margin-left'>Senarai Set Soalan</b>
</div> 
<?PHP include ('../butang_saiz.php'); ?> 
<div class='w3-responsive'>
<table width='90%' border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'> 
    <tr style='background-color:#5E60CE' class='w3-text-white'>
        <td>Topik</td> 
        <td>Arahan</td> 
        <td>Jenis</td> 
        <td>Tarikh</td> 
        <td>Masa</td>
        <td></td> 
    </tr> 
    <tr> 
    <!-- bahagian borang untuk mendaftar set soalan yang baru --> 
        <form action='' method='POST'>
            <td><textarea class="w3-input w3-border w3-round-large" name='topik' rows="2" cols="25"  placeholder='Topik Baharu'></textarea></td> 
            <td><textarea class="w3-input w3-border w3-round-large" name='arahan' rows="2" cols="10" placeholder='Arahan bagi soalan'></textarea></td> 
            <td> 
                <select class="w3-select w3-border w3-round-large" name='jenis'>
                    <option value selected disabled>Pilih</option> 
                    <option value='Latihan'>Latihan</option>
                    <option value='Kuiz'>Kuiz</option> 
                </select> 
            </td> 
            <td><input class="w3-input w3-border w3-round-large" type='date'   name='tarikh'></td> 
            <td><input class="w3-input w3-border w3-round-large" type='number' name='masa' placeholder='(Minit)'></td>
            <td><input style='background-color:#56CFE1;color:#ffffff' class='w3-block w3-button w3-round-xlarge w3-card' type='submit' value='SIMPAN'></td> 
        </form> 
    </tr> 
<?PHP 
# arahan untuk memilih data dari jadual set soalan 
$arahan_set = "select* from set_soalan order by no_set DESC";

# melaksanakan arahan untuk memilih data 
$laksana_set = mysqli_query($condb, $arahan_set);

# pembolehubah $data mengambil data yang ditemui 
while ($data=mysqli_fetch_array($laksana_set))
{
    # mengumpukkan data yang ditemui ke dalam tatasusunan $data get 
    $data_get=array( 
        'no_set'         =>    $data['no_set'],
        'topik'          =>    $data['topik'],
        'arahan'         =>    $data['arahan'],
        'jenis'          =>    $data['jenis'],
        'tarikh'         =>    $data['tarikh'],
        'masa'           =>    $data['masa'],
        'nokp_guru'      =>    $data['nokp_guru']
    );

    # Memaparkan data yang diambil baris demi baris 
    echo "
    <tr>
        <td> ".$data['topik']." </td> 
        <td> ".$data['arahan']." </td> 
        <td> ".$data['jenis']." </td> 
        <td class='w3-center'> ".$data['tarikh']." </td> 
        <td class='w3-center'> ".$data['masa']." </td> 
        <td class='w3-center' width='15%'>
        <a href='soalan_daftar.php?no_set=".$data['no_set']."&topik=".$data['topik']."'title='Soalan Tambahan' ><i style='color:#6666ff' class='w3-xxlarge fa fa-file-text-o' aria-hidden='true'></i></a>  
        <a href='soalan_set_kemaskini.php?".http_build_query($data_get)."'title='Kemaskini Soalan' ><i style='color:#FFC300' class='w3-xxlarge fa fa-pencil-square-o' aria-hidden='true'></i></a>
        <a href='padam.php?jadual=set_soalan&medan=no_set&kp=".$data['no_set']."'onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam Soalan' ><i style='color:#ff3333' class='w3-xxlarge fa fa-trash-o' aria-hidden='true'></i></a> 

        </td> 
    </tr>";
}

?>
</table> 
<?PHP include('footer_guru.php'); ?>
