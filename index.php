<?PHP

# memanggil faill header.php
include ('header_guru.php');
#Memaparkan nama guru dah tahap
echo "

<div class='w3-panel w3-center w3-topbar w3-bottombar w3-border-gray w3-white'>
     Nama Guru:".$_SESSION ['nama_guru']." (".$_SESSION['tahap'].")
</div>

";
?>
<?PHP include ('audio_guru.php'); ?>
<?PHP include('../masa.php'); ?>
<!-- Memaparkan senarai latihan terkini -->
<!-- antara muka untuk daftar masuk/login -->
<table width ='100%' class='w3-table-all w3-card'>
	<tr>
		<td align='center' width='32%'>
            <div class="w3-content w3-section w3-middle" style="max-width:15900px">
                <img class="mySlides w3-animate-fading  w3-image"    src="../images/g1.png"    style="width:100%">
                <img class="mySlides w3-animate-fading  w3-image"    src="../images/g2.png"    style="width:100%">
                <img class="mySlides w3-animate-fading  w3-image"    src="../images/g3.png"    style="width:100%">
            </div>
		   
            <script>
            var myIndex = 0;
            carousel();

            function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 5000);    
            }
            </script>
			<!-- pautan untuk mendaftar murid baru-->
		</td>
		<td>
		<!--Senarai set latihan terkini-->
		<p style='font-size: 25px' class="w3-center w3-text-black">Senarai Latihan Terkini</p>
		<table border='1' class='w3-margin-bottom w3-table-all w3-hoverable'>
		<tr style='background-color:#5E60CE' class='w3-text-white'>
			<td>Topik</td>
			<td>Kelas</td>
			<td>Nama Guru</td>
		</tr> 
		<?php
    # Arahan untuk mencari data guru, kelas dan set_soalan
    $arahan_latihan="SELECT* FROM set_soalan,guru,kelas
    WHERE
              set_soalan.nokp_guru     =     guru.nokp_guru
    AND       kelas.nokp_guru          =     guru.nokp_guru
    ORDER BY  topik ASC";

    # Melaksanakan arahan carian di atas
    $laksana_latihan=mysqli_query($condb, $arahan_latihan) ;

    #mengambil data dan memaparkan semula data tersebut
    while($rekod=mysqli_fetch_array($laksana_latihan))
    {
    echo "
        <tr>
           <td>".$rekod['topik']."</td>
           <td>".$rekod['ting']." ".$rekod['nama_kelas']."</td> 
           <td>".$rekod['nama_guru']."</td>  
        </tr>";

    }
    ?>
          </table>
		</td>	
	</tr>
</table>
</div>
<?PHP include('footer_guru.php'); ?>







