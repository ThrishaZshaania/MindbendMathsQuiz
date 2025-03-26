<?PHP 
# memanggil fail header.php , guard_murid.php dan fail connection.php
include('../header.php'); 
include('guard_murid.php'); 
include('../connection.php');

# fungsi untuk mengira skor berdasarkan noset soalan 
function skor($no_set, $bil_soalan)
{
    # memanggil fail connection.php dari folder utama 
    include ('../connection.php');

    # arahan untuk mendapatkan data jawapan murid 
    $arahan_skor="SELECT * 
    FROM set_soalan, soalan, jawapan_murid 
    WHERE 
        set_soalan.no_set             =    soalan.no_set 
    AND soalan.no_soalan              =    jawapan_murid.no_soalan
    AND set_soalan.no_set             =    '$no_set' 
    AND jawapan_murid.nokp_murid      =    '".$_SESSION['nokp_murid']."' ";

  # melaksanakan arahan untuk mendapatkan data jawapan 
    $laksana_skor=mysqli_query($condb,$arahan_skor);

    #mengira bilangan jawapan
    $bil_jawapan=mysqli_num_rows($laksana_skor);
    $bil_betul=0;

    # pembolehubah rekod mengambil data yang ditemui senasa laksanakan arahan 
    while($rekod=mysqli_fetch_array($laksana_skor))
    {
        # mengira jawapan yang betul 
        switch($rekod['catatan'])
        {
            case 'BETUL': $bil_betul++; break; 
            default: break;
        }
    }

    # mengira peratus jawapan betul 
    $peratus=$bil_betul/$bil_soalan*100;

    # Memaparkan skor dan markah dalam % 
    echo"   <td class='w3-center' align='right'>$bil_betul/$bil_soalan</td>
            <td class='w3-center' align='right'>".number_format($peratus,0)."%</td>";
            $kumpul=$bil_betul."|".$bil_soalan."|".$peratus."|".$bil_jawapan;
    # memulangkan nilai bil betul, bil soalan, peratus dan bilangan jawapan 
    return $kumpul;
    
}
?>

<!-- memanggil fail butang saiz dari folder luaran utk membesarkan saiz tulisan --> 
<?PHP include ('../butang_saiz.php'); ?>

<!-- bahagian memaparkan maklumat set soalan --> 
<table border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top w3-card'> 
<tr style='background-color:#5E60CE' class='w3-text-white'>
    <td class='w3-center' >Bil</td> 
    <td class='w3-center' >Topik</td> 
    <td class='w3-center' >Jenis Latihan</td> 
    <td class='w3-center' >Bil Soalan</td> 
    <td class='w3-center' >Skor</td> 
    <td class='w3-center' >Peratus</td>
    <td class='w3-center' >Jawab</td> 
</tr>

<?PHP 
# Arahan untuk mendapatkan maklumat murid berdasarkan data session[nokp_murid] 
$arahan_cari="select*from murid 
where 
nokp_murid='".$_SESSION['nokp_murid']."' ";

# Laksanakan arahan di atas 
$laksana_cari=mysqli_query($condb,$arahan_cari);

# Mengambil data yang ditemui 
$data_murid=mysqli_fetch_array($laksana_cari);

# Arahan untuk mencari data set soalan 
$arahan_pilih_latihan ="SELECT
set_soalan.no_set, 
COUNT(soalan.no_soalan) AS bil_soalan, 
topik, jenis 
FROM set_soalan, soalan, guru,kelas 
WHERE
            set_soalan.no_set        =     soalan.no_set
AND         set_soalan.nokp_guru     =     guru.nokp_guru
AND         kelas.nokp_guru          =     guru.nokp_guru
AND         kelas.id_kelas           =     '".$data_murid['id_kelas']."'
GROUP BY    topik";

# Melaksanakan arahan untuk mencari data set soalan 
$laksana=mysqli_query($condb,$arahan_pilih_latihan); 
$i=0;

# pembolehubah data mengambil setiap data yang ditemui 
while ($data=mysqli_fetch_array($laksana))
{
    #memaparkan data set soalan yang ditemui 
    echo"<tr> 
    <td  class='w3-center' >".++$i."</td> 
    <td>".$data['topik']."</td> 
    <td>".$data['jenis']."</td> 
    <td  class='w3-center' align='center'>".$data['bil_soalan']."</td>";
        
        # Memanggil fungsi skor dengan menghantar no set soalan dan bilangan soalan 
        $kumpul=skor($data['no_set'],$data['bil_soalan']);

        # menerima dan memecahkan data yang diterima kembali dari fungsi skor 
        $pecahkanbaris = explode("|",$kumpul);

        # umpukkan kepada penbolehubah dibawah 
        list($bil_betul,$bil_soalan,$peratus, $bil_jawapan) = $pecahkanbaris;

        # menguji bilangan jawapan yang ditemui 
        if ($bil_jawapan<=0)
        {
            # jika bil jawapan <=0 bermaksud murid belum menjawap soalan 
            echo "<td class='w3-center'><a style='background-color:#56CFE1;color:#ffffff'  class='w3-block w3-button w3-round-xlarge w3-card' href='arahan_latihan.php?no_set=".$data['no_set']."'>Pilih</a></td>";
        }
        else
        {
            # jika tidak, murid hanya boleh mengulangkaji senula soalan yang telah dijawap
            echo"<td class='w3-center'><a style='background-color:#56CFE1;color:#ffffff'  class='w3-block w3-button w3-round-xlarge w3-card' href='ulangkaji.php?no_set=".$data['no_set']."&topik=".$data['topik']."&kumpul=".$kumpul."'>Ulangkaji</a></td>";


        }

echo "</tr>";
}
?>
</table> 
<?PHP 
include ('../footer.php'); 
?>



