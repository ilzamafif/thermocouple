<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>

<body style="background: #5C5C5C; color: white; font-family: sans-serif;">
 <canvas id="myChart"></canvas>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
 <script>
  var ctx = document.getElementById("myChart").getContext('2d');


  var myChart = new Chart(ctx, {
   type: 'line',
   data: {
    labels: [1, 2, 3, 4, 5, 6, 7, 8],
    datasets: [{
     label: 'Contoh', // Name the series
     data: [1, 2, 3, 4, 5, 6, 7, 23], // Specify the data values array
     fill: false,
     borderColor: '#00ffff', // Add custom color border (Line)
     backgroundColor: '#00ffff', // Add custom color background (Points and Fill)
     borderWidth: 1, // Specify bar border width,

    }]
   },
   options: {
    responsive: true, // Instruct chart js to respond nicely.
    maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height 
    legend: {
     labels: {
      fontColor: "#000",
      fontSize: 18
     }
    },
    scales: {
     yAxes: [{
      ticks: {
       fontColor: "white",
       fontSize: 11,
       stepSize: 10,
       beginAtZero: true
      }
     }],
     xAxes: [{
      ticks: {
       fontColor: "#fff",
       fontSize: 14,
       stepSize: 1,
       beginAtZero: true
      }
     }]
    }
   }
  });
 </script>
</body>

</html>