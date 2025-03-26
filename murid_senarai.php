<?PHP 
# Memanggil fail header_guru.php 
include('header_guru.php');

# menyemak kewujudan data POST bagi mendaftar murid baru 
if(!empty($_POST))
{
    # mengambil data murid baru yang dihantar melalui borang pada senarai 
    $nama           =    mysqli_real_escape_string($condb,$_POST['nama_baru']);
    $nokp           =    mysqli_real_escape_string($condb,$_POST['nokp_baru']);
    $katalaluan     =    mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
    $id_kelas       =    $_POST['id_kelas'];
    
    # menyemak kewujudan data yang dihantar 
    if (empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas ))
    {
        # jika ada 1 data yang tidak diisi, aturcara akan terhenti disini 
        die("<script>alert('Sila lengkapkan maklumat'); 
        window.history.back();</script>");
    }

    # had atas, had bawah. data validation untuk nokp murid 
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        die("<script>alert('Ralat No K/P.'); 
        window.history.back();</script>");
    }
    
    # arahan untuk menyimpan data murid 
    $arahan_simpan="insert into murid
           (nama_murid, nokp_murid, katalaluan_murid, id_kelas) 
           values 
           ('$nama', '$nokp', '$katalaluan', '$id_kelas')";

    #Melaksanakan arahan simpan data murid 
    if (mysqli_query($condb, $arahan_simpan))
    {
        # data berjaya disimpan 
        echo "<script>alert('Pendaftaran BERJAYA.'); 
        window.location.href='murid_senarai.php'; 
        </script>";
    }
    else
    {
        # data gagal disimpan 
        echo "<script>alert('Pendaftaran GAGAL.'); 
        window.location.href='murid_senarai.php'; 
        </script>";
    }

}
?>

<!-- jadual untuk memaparkan senarai murid --> 
<div class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>
<b style='font-size:22px' class='w3-margin-left'>Senarai Murid</b>
</div>


<!-- link untuk membesarkan saiz tulisan bagi aspek kepelbagaian pengguna--> 
<?PHP include ('../butang_saiz.php'); ?>
<a class='w3-margin-left w3-round-xxlarge w3-button w3-card w3-border-amber' style='font-size:16px; background-color:#FFC300' href='murid_upload.php'> [+] Upload Data Murid </a>
<div class='w3-responsive'>
<table width='90%' border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'> 
    <tr style='background-color:#5E60CE' class='w3-text-white'>
        <td width='18%'>Nama Murid</td> 
        <td width='22%'>No Kad Pengenalan Murid</td> 
        <td width='18%'>Katalaluan Murid</td> 
        <td class='w3-center' width='20%'>Kelas</td>
        <td class='w3-center'>Tindakan</td> 
    </tr> 
    <tr>
    <!-- borang untuk mendaftar murid baru--> 
        <form action='' method='POST'>
            <td><input class="w3-input w3-border w3-round-large"   type='text'     placeholder='Nama Baharu'         name='nama_baru'></td> 
            <td><input class="w3-input w3-border w3-round-large"   type='text'     placeholder='No K/P Baharu'       name='nokp_baru'></td> 
            <td><input class="w3-input w3-border w3-round-large"   type='password' placeholder='Katalaluan Baharu'   name='katalaluan_baru'></td> 
            <td> 
            <select class="w3-select w3-border w3-round-large" name='id_kelas'>
                <option value selected disable>Pilih</option> 

<?PHP 
# arahan untuk mencari semua data dari jadual kelas 
$sql="select* from kelas";

# Melaksanakan arahan mencari data 
$laksana_arahan_cari=mysqli_query($condb,$sql);

# pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris 
while ($rekod_bilik=mysqli_fetch_array($laksana_arahan_cari))
{
    #memaparkan data yang ditemui dalam element <option></option> 
    echo "<option value=".$rekod_bilik['id_kelas']."> 
    ".$rekod_bilik['ting']." ".$rekod_bilik['nama_kelas']."</option>";
}

?>
            </select> 
            </td>
            <td><input style='background-color:#56CFE1;color:#ffffff' class='w3-block w3-button w3-round-xlarge w3-card' type='submit' value='SIMPAN'></td> 
        </form> 
    </tr>

<?PHP 
# arahan untuk mencari semua data murid yang berdaftar 
$arahan_cari_murid="select* from murid, kelas 
where 
murid.id_kelas        =        kelas.id_kelas 
order by kelas.ting, kelas.nama_kelas, murid.nama_murid ASC";

#melaksanakan arahan untuk mencari 
$laksana_cari_murid=mysqli_query($condb,$arahan_cari_murid);

# pembolehubah $data mengambil semua data yang ditemui
while ($data=mysqli_fetch_array($laksana_cari_murid))
{
    #Mengumpukan data murid kedalam tatasusunan data_murid
    $data_murid=array(
        'nama_murid'              =>         $data['nama_murid'],
        'nokp_murid'              =>         $data['nokp_murid'],
        'katalaluan_murid'        =>         $data['katalaluan_murid'],
    );
    # memaparkan data murid baris demi baris 
    echo "
    <tr>
        <td>".$data['nama_murid']."</td>
        <td>".$data['nokp_murid']."</td>
        <td>".$data['katalaluan_murid']."</td>
        <td>".$data['ting']." ".$data['nama_kelas']."</td>
        <td class='w3-center'>
        <a href='murid_kemaskini.php?".http_build_query($data_murid)."' title='Kemaskini' ><i style='color:#FFC300' class='w3-xxlarge fa fa-edit' aria-hidden='true'></i></a>
        <a href='padam.php?jadual=murid&medan=nokp_murid&kp=".$data['nokp_murid']." 'onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam' ><i style='color:#ff3333' class='w3-xxlarge fa fa-trash-o' aria-hidden='true'></i></a> 
        </td>
    </tr>";
}

?> 
</table> 
<?PHP include('footer_guru.php'); ?>

