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

<div class="w3-content w3-section w3-margin-top w3-margin-bottom" style="max-width:400px">
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