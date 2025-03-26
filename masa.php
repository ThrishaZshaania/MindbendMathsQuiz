
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=">
   <style>
      body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    #clock {
      height: 40px;
      width: 30%;
      background: linear-gradient(0deg,rgba(250, 235, 146, 1) 0% , rgba(255, 145, 153, 1) 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      border-radius: 35px;
      text-align: center;
      opacity:0.8;
    }
  </style>
</head>

<body>
  <div id="clock">
  </div>
  <script>
      function clock() {
      let date = new Date();
      let hrs = date.getHours();
      let mins = date.getMinutes();
      let secs = date.getSeconds();
      let weekday = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'][date.getDay()];
      let month = date.getMonth();
      let tarikh =date.getDate();
      let tahun = date.getYear();
      let period = "AM";
    
      if (hrs == 0) hrs = 12;
      if (hrs > 12) {
        hrs = hrs - 12;
        period = "PM";
      }
    
      hrs = hrs < 10 ? `0${hrs}` : hrs;
      mins = mins < 10 ? `0${mins}` : mins;
      secs = secs < 10 ? `0${secs}` : secs;
      
      let time = `⏰ ${hrs}:${mins}:${secs} ${period} 📅 ${tarikh}/${month+1}/${tahun-100} ${weekday} `;
      setInterval(clock, 1000);
      document.getElementById("clock").innerText = time;
    }
    
    clock();
   </script>
</body>

</html>