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
    <div class="col-md-9 mt-3">
      <h1 class="ms-4 ">TEMP : <span id="data" style=" color: #00ffff;">0</span> °C</h1>
      <canvas id="myChart"></canvas>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var initialData = Array.from({
      length: 8
    }, () => 0);

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: Array.from({
          length: 8
        }, (_, i) => ''),
        datasets: [{
          label: '',
          data: initialData,
          fill: false,
          borderColor: '#00ffff',
          backgroundColor: '#00ffff',
          borderWidth: 1,

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
    const pusher = new Pusher('3bc63e149da851d2361f', {
      cluster: 'ap1',
      encrypted: true,
    });

    const channel = pusher.subscribe('sensor-channel');
    channel.bind('sensor-event', function(data) {
      console.log(data)
      myChart.data.labels.push(new Date().toLocaleTimeString());
      myChart.data.datasets[0].data.push(data.data);
      // play mp3 where data > 90 in javascript

      if (data.data > 32.5) {
        var audio = new Audio("{{ asset('audio/alaram.mp3') }}");
        audio.play();
      }
      document.getElementById("data").innerHTML = data.data;

      if (myChart.data.labels.length > 8) {
        myChart.data.labels.shift();
        myChart.data.datasets[0].data.shift();
      }

      myChart.update();
    });
  </script>

</body>

</html>