<?PHP 
# memanggil fail header.php dan fail connection.php dari folder utama 
include ('../header.php'); 
include('../connection.php');

# menyemak kewujudan data get 
if(empty($_GET))
{
    # jika data get tidak wujud. aturcara akan dihentikan 
    die("<script>alert('Akses tanpa kebenaran');
    window.location.href='pilih_latihan.php';</script>" );
}
?>

<?PHP
# Menguji data get[jenis]==kuiz 
if($_GET['jenis']== "Kuiz")
{
    # memanggil fail timer2.php 
    include('timer2.php'); 
    # memanggil fungsi timer_kuiz 
    timer_kuiz($_GET['masa']);
}
?>

<!-- Memaparkan latihan untuk dijawap oleh pelajar--> 
<p class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>Soalan Latihan</p> 

<form name='soalan_kuiz' action='jawap_semak.php?no_set=<?PHP echo $_GET['no_set']; ?>' method='POST'> 
<?PHP include ('../audio.php'); ?>
<?PHP include ('../butang_saiz.php'); ?> 

<div class='w3-responsive'>
<table border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'>  
<tr class='w3-deep-purple'>
        <td style="width:5%" class='w3-center' >Bil</td>
        <td  class='w3-center'>Soalan</td> 
</tr>

<?PHP 
# Arahan untuk memilih soalan berdasarkan noset dan menyusun nya secara rawak (rand) 
$arahan_pilih_soalan="select* from soalan where no_set='".$_GET['no_set']."' 
order by rand()";

# melaksanakan arahan untuk memilih soalan 
$laksana=mysqli_query($condb, $arahan_pilih_soalan); 
$i=0;

# pembolehubah data mengambil data yang ditemui 
while ($data=mysqli_fetch_array($laksana))
{
    # memaparkan soalan dan jawapan 
    echo"<tr> 
    <td class='w3-center' >".++$i."</td> 
    <td>";

# mengumpukkan nama medan kepada tatasusunan
    $a=array("jawapan_a", "jawapan_b","jawapan_c","jawapan_d");

    # menjadikan susunan jawapan secara rawak 
    shuffle($a); 
    $xjawap='TIDAK MENJAWAB';

    # jika soalan mempunyai gambar, umpukan nama gambar 
    if ($data['gambar']!=" ")
    {
        $gambar=$data['gambar'];
    }
    else
    {
        $gambar=" ";
    }

        # memaparkan jawapan yang telah disusun secara rawak 
        echo $soalan=str_replace("'"," ",$data['soalan']);

# susunan value yang dihantar. Taip dengan penuh berhati-hati. 
# medan, jawapan, jawapan1, jawapan2, jawapan3, jawapan4, soalan, nilai jawapan_a, gambar
        echo"
        <br><img src='$gambar' width='25%'><br>

<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[0]."|".$data[$a[0]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[0]]."</label><br>
<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[1]."|".$data[$a[1]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[1]]."</label><br>
<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[2]."|".$data[$a[2]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[2]]."</label><br>
<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='".$a[3]."|".$data[$a[3]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'> <label>".$data[$a[3]]."</label><br>
<input class='w3-radio' type='radio' name='s".$data['no_soalan']."' value='tidak jawab|tidak jawab|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."' checked style='visibility: hidden'>

<br>";

echo"</td> 
</tr>";
}
?>

</table>
</div> 
<input style='background-color:#56CFE1;color:#ffffff' class='w3-margin-top w3-button w3-round-xlarge w3-card w3-block' type='submit' value='Hantar'>

</form> 
<?PHP 
include('../top.php');
include('../footer.php'); 
?>

