<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
        font-family: 'Quicksand', sans-serif;
        font-size: 18px;
      }

  #myBtn { 
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color:#5E60CE;
  color: white;
  cursor: pointer;
  padding: 10px;
  border-radius: 20px;
  }

  #myBtn:hover {
  background-color: #64DFDF;
  }
</style>
</head>
<body>

<button onclick="topFunction()" id="myBtn" title="Go to top"> Top </button>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</body>
</html>