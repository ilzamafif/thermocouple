  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Thermocouple</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
      <meta http-equiv="Cross-Origin-Opener-Policy" content="same-origin">
      <meta http-equiv="Cross-Origin-Embedder-Policy" content="require-corp">
      <style>
          @media only screen and (min-width: 1201px) {

              /* TV and extra large screens */
              .colom-1 {
                  border: 7px solid #00ffff;
                  border-radius: 50%;
                  min-height: 254px;
                  max-width: 254px;
                  padding-top: 70px;
              }
          }

          @media only screen and (max-width: 1200px) and (min-width: 1025px) {

              /* Large screens and desktops */
              .colom-1 {
                  border: 7px solid #00ffff;
                  border-radius: 50%;
                  min-height: 254px;
                  max-width: 254px;
                  padding-top: 70px;
              }
          }

          @media only screen and (max-width: 1024px) and (min-width: 769px) {

              /* Laptops and small screen */
              .colom-1 {
                  border: 7px solid #00ffff;
                  border-radius: 50%;
                  min-height: 254px;
                  max-width: 254px;
                  padding-top: 70px;
                  margin-bottom: 100px;
              }

              body {
                  margin-top: 80px;
              }

              .baris-3 {
                  margin-top: 80px;
              }

              .table {
                  font-size: 45px;
              }
          }

          @media only screen and (max-width: 768px) and (min-width: 481px) {

              /* iPads and tablets */
              .colom-1 {
                  border: 7px solid #00ffff;
                  border-radius: 50%;
                  min-height: 254px;
                  max-width: 254px;
                  padding-top: 70px;
              }

              body {
                  margin-top: 70px;
              }

              .baris-3 {
                  margin-top: 60px;
              }

              .table {
                  font-size: 45px;
              }

          }

          @media only screen and (max-width: 480px) and (min-width: 320px) {

              /* mobile device */
              .colom-1 {
                  border: 5px solid #00ffff;
                  border-radius: 50%;
                  min-height: 170px;
                  max-width: 170px;
                  padding-top: 20px;
              }

              body {
                  margin-top: 30px;
              }

              .baris-3 {
                  margin-top: 0px;
              }
          }

          body {
              background: #1b1e23;
              color: white;
              font-family: sans-serif;
          }

          .subtitle {
              color: #00ffff;
              font-size: 50px;
          }
      </style>
  </head>

  <body>
      <div class="row justify-content-center my-3 mt-4">
          <div class="col-lg-4 col-md-6 colom-1">
              <h1 class="text-center">TEMP </h1>
              <h1 class="text-center" style="font-size: 40px;"><span id="data" class="subtitle">0</span> <span style="content: ' \2103';">&#8451;</span></h1>
          </div>
      </div>
      <div class="row justify-content-center my-3 mt45 baris-2">
          <div class="col-md-9 mt-2">
              <canvas id="myChart"></canvas>
          </div>
      </div>

      <div class="row justify-content-center">
          <div class="col-md-9 baris-3">
              <button class="btn btn-primary my-1 ms-2" id="authorize_button" onclick="handleAuthClick()"
                  value="Authorize">Simpan ke Google Drive</button>
                  <!--<a href="https://stackoverflow.com/questions/57000915/error-adb-exited-with-exit-code-1-performing-streamed-install">drive</a>-->
                  <!--<a href="https://iot.wyasaaplikasi.com/">drive</a>-->

                  <table class="table table-striped table-hover table-light ms-2">
                  <thead>
                      <tr class="text-center">
                          <th scope="col">Waktu</th>
                          <th scope="col">Suhu</th>
                      </tr>
                  </thead>
                  <tbody id="tableBody" class="text-center">
                  </tbody>
              </table>
          </div>

      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>
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
                      backgroundColor: '#00ffff',
                      pointBorderColor: '#fff'
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: true,
                  legend: {
                      display: false,
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
                              fontSize: 14,
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
                              fontSize: 13,
                              stepSize: 1,
                              beginAtZero: true
                          }
                      }]
                  }
              }
          });

          const pusher = new Pusher('3bc63e149da851d2361f', {
              cluster: 'ap1',
              encrypted: true,
          });

          const channel = pusher.subscribe('sensor-channel');
          let fileContent = '';
          channel.bind('sensor-event', function(data) {

              const options = {
                  hour12: false,
                  hour: "2-digit",
                  minute: "2-digit",
                  second: "2-digit"
              };
              myChart.data.labels.push(new Date().toLocaleTimeString("pt-BR", options));
              myChart.data.datasets[0].data.push(data.data);
              fileContent += `${new Date().toLocaleTimeString("pt-BR")} - Suhu: ${data.data} °C\n`;

              if (data.alarm == 1) {
                  var audio = new Audio("{{ asset('audio/alarm.mp3') }}");
                  audio.play();
              }
              document.getElementById("data").innerHTML = data.data;

              // Create a new row in the table
              var tableBody = document.getElementById("tableBody");
              var newRow = tableBody.insertRow();
              var cell2 = newRow.insertCell(0);
              var cell3 = newRow.insertCell(1);
              cell2.textContent = new Date().toLocaleTimeString("pt-BR", options);
              cell3.textContent = data.data + " °C"; // Temperature

              // Remove the first row if there are more than 5 rows
              if (tableBody.rows.length > 5) {
                  tableBody.deleteRow(0);
              }

              if (myChart.data.labels.length > 8) {
                  myChart.data.labels.shift();
                  myChart.data.datasets[0].data.shift();
              }

              myChart.update();
          });
      </script>
      <script>
          // TODO: Set the below credentials
          const CLIENT_ID = '812976116770-7q6pr2ebj481dk1t5necb64d510n7ot3.apps.googleusercontent.com';
          const API_KEY = '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';

          // Discovery URL for APIs used by the quickstart
          const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

          // Set API access scope before proceeding authorization request
          const SCOPES = 'https://www.googleapis.com/auth/drive.file';
          let tokenClient;
          let gapiInited = false;
          let gisInited = false;

          function gapiLoaded() {
              gapi.load('client', initializeGapiClient);
          }

          async function initializeGapiClient() {
              await gapi.client.init({
                  apiKey: API_KEY,
                  discoveryDocs: [DISCOVERY_DOC],
              });
              gapiInited = true;
              maybeEnableButtons();
          }

          function gisLoaded() {
              tokenClient = google.accounts.oauth2.initTokenClient({
                  client_id: CLIENT_ID,
                  scope: SCOPES,
                  callback: '', // defined later
              });
              gisInited = true;
              maybeEnableButtons();
          }

          function maybeEnableButtons() {
              if (gapiInited && gisInited) {
                  document.getElementById('authorize_button').style.visibility = 'visible';
              }
          }

          function handleAuthClick() {
              // Save fileContent to localStorage
              localStorage.setItem('fileContent', fileContent);

              const redirectUri = `${window.location.origin}/redirect`; // Replace with your actual redirect URI
              const authUrl = `https://accounts.google.com/o/oauth2/v2/auth?response_type=token&client_id=${CLIENT_ID}&scope=${SCOPES}&redirect_uri=${redirectUri}`;

              // Open the URL in a new tab
              window.open(authUrl, '_blank');
          }
      </script>
      <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
      <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
  </body>

  </html>