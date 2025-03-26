<?PHP
#Memulakan fungsi session_start
session_start();

#Menyemak kewujudan data GET
if(!empty($_GET))
{
    #Memanggil fail connection dari folder utama
    include('../connection.php');

    #Mengambil data yang dihantar
    $jadual   =    $_GET['jadual'];
    $medan    =    $_GET['medan'];
    $kp       =    $_GET['kp'];
    
    #arahan untuk memadam rekod di dalam jadual
    $arahan_padam="delete from $jadual where $medan='$kp'";

    #melaksanakan arahan untuk memadam rekod
    if(mysqli_query($condb,$arahan_padam))
    {
        #Data berjaya disimpan
        echo"<script>alert ('Data BERJAYA dipadam');
        window.history.back();</script>";
    }
    else
    {
        #Data berjaya disimpan
        echo"<script>alert ('Data BERJAYA dipadam');
        window.history.back();</script>";
    }
}
else
{
    die("<script>alert('Akses fail tanpa kebenaran');
    window.history.back();</script>");
}
?>