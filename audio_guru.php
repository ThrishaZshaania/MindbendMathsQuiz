<!DOCTYPE html>
<html>
<body>

<audio autoplay id="myAudio">
    <source src="../audio/song02.mp3" type="audio/mpeg"/> 
</audio>


<button class='w3-right w3-margin-left w3-margin-bottom w3-round-xxlarge w3-card w3-border-amber' style='font-size:20px; background-color:#FFC300' onclick="playAudio()" type="button">🎵</button>
<button class='w3-right w3-round-xxlarge w3-card w3-border-amber' style='font-size:20px; background-color:#FFC300' onclick="pauseAudio()" type="button">🔇</button> 

<script>
var x = document.getElementById("myAudio"); 

function playAudio() { 
  x.play(); 
} 

function pauseAudio() { 
  x.pause(); 
} 
</script>

</body>
</html>