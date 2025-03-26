<?PHP
#memanggil fail header.php
include('header.php');
?>
<!-- antara muka untuk daftar masuk/login -->
<div class="container w3-margin-bottom">
  <img src="images/b12.png" alt="Login" style="width:132%;" class="w3-round-xlarge w3-card">
  <a href="#about" class="btn">LOGIN</a>
</div>
<div class="w3-row" id="about">
<div class="w3-col w3-container w3-margin-top" style="width:30%;scroll-behavior: smooth;" >
<br>
<br>
<br>
<table width ='100%' class='w3-table-all w3-card'>
	<tr>
		<td align='center' width='32%'>
			<p style='font-size: 25px;color:#000000'> Login Pengguna </p>
			<form action='login.php' method='POST'>
            
			
			<div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-id-card-o">
			</i></div>
			<div class="w3-rest">
			    <input class="w3-input w3-animate-input w3-border w3-round-large" name='nokp' placeholder='04050301xxxx' type="text" style="width:50%">
                </div>
            </div> 

			<div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i style="color:#5390D9" class="w3-xxlarge fa fa-unlock-alt">
			</i></div> 
			<div class="w3-rest">
			    <input class="w3-input w3-animate-input w3-border w3-round-large" name='katalaluan' placeholder='Katalaluan' type='password' style="width:50%">
                </div>
            </div> 
			
			<input type ='radio' class="w3-radio"  name='jenis' value='murid' checked>
			<label style='font-size: 20px;color:#5E60CE'><b> Murid </b></label>

			<input type ='radio' class="w3-radio"  name='jenis' value='guru'> 
			<label style='font-size: 20px;color:#5E60CE'><b> Guru </b></label>
			
			<nobr> <button style="background-color:#56CFE1;color:#ffffff" class="w3-margin-top w3-margin-bottom w3-button w3-border w3-round-xlarge w3-card" type='submit' title='Login'>Login <i class=" fa fa-sign-in" aria-hidden="true"></i></button>
			<a style="background-color:#56CFE1;color:#ffffff" class="w3-margin-top w3-margin-bottom w3-button w3-border w3-round-xlarge w3-card" href='signup.php'>Daftar Murid Baru <i class="fa fa-user-plus" aria-hidden="true"></i></a> </nobr>
		
		    </form>
      </header>
			<!-- pautan untuk mendaftar murid baru-->
		</td>
		<td>
		</tr>
    </table>
  </div>


  <div class="w3-col w3-container w3-margin-top" style="width:70%">
  <!DOCTYPE html>
  <html>
  <title>Mindbend Portal Matematik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    .mySlides {display: ''}
    body 
    {
        font-family: 'Quicksand', sans-serif;
        font-size: 20px;
        
    }
    </style>
    <body>

    <div class="w3-content w3-section w3-margin-top w3-margin-bottom" style="max-width:420px">
    <img class="mySlides w3-animate-fading  w3-image"    src="images/p1.png"    style="width:100%">
    <img class="mySlides w3-animate-fading  w3-image"    src="images/p2.png"    style="width:100%">
    <img class="mySlides w3-animate-fading  w3-image"    src="images/p3.png"    style="width:100%">
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

   </body>
   </html>
  </div>

</div>
<?php
#memanggil fail footer.php
include('top.php');
include('footer.php');
?>