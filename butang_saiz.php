<br> 
<!-- fungsi mengubah saiz tulisan bagi kepelbagaian pengguna--> 
<script> 
function resizeText(multiplier) {

            var elem = document.getElementById("besar"); 
            var currentSize = elem.style.fontSize || 1; 
            if(multiplier ==2)
            {
                elem.style.fontSize = "1em";
            }
            else
            {
                elem.style.fontSize = ( parseFloat(currentSize) + (multiplier * 0.2)) + "em";
            }
}
</script>

<!-- Kod untuk butang mengubah saiz tulisan -->
<b class='w3-wide' style='font-size:16px'>UBAH SAIZ TULISAN</b>
<br>
<input class='w3-margin-right w3-round-xxlarge w3-card w3-border-amber w3-wide' style='font-size:20px; background-color:#FFC300' name='reSize1' type='button'  value=' reset ' onclick="resizeText(2)" />
<button class='w3-margin-right w3-round-xxlarge w3-card w3-border-amber' style='font-size:20px; background-color:#FFC300' value='&nbsp;-&nbsp;' onclick="resizeText(+1)"> <i class="fa fa-search-plus"></i></button>
<button class='w3-round-xxlarge w3-card w3-border-amber' style='font-size:20px; background-color:#FFC300' value='&nbsp;-&nbsp;' onclick="resizeText(-1)"> <i class="fa fa-search-minus"></i></button>

