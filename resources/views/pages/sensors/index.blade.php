<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
</head>

<body style="background: #1b1e23; color: white; font-family: sans-serif;">
 <div class="row justify-content-center my-3 ">
  <div class="col-md-10">
   <canvas id="myChart"></canvas>
   <input id="humidity" type="text" class="form-control custom-input" style="width: 25%;">
  </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
      gridLines: {
       color: "#49514C"
      },
      ticks: {
       fontColor: "white",
       fontSize: 16,
       stepSize: 10,
       beginAtZero: true,
      }
     }],
     xAxes: [{
      gridLines: {
       color: "#49514C"
      },
      ticks: {
       fontColor: "#aeaeae",
       fontSize: 18,
       stepSize: 1,
       beginAtZero: true
      }
     }]
    }
   }
  });
 </script>
 <script type="text/javascript">
  const no = document.getElementById('humidity');

  const pusher = new Pusher('3bc63e149da851d2361f', {
   cluster: 'ap1',
   encrypted: true,
  });

  const channel = pusher.subscribe('sensor-channel');
  channel.bind('sensor-event', function(data) {
   no.value = data.data.humidity;
  });
 </script>
</body>

</html>