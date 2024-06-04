  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Thermocouple</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
              <h1 class="text-center" style="font-size: 40px;"><span id="data" class="subtitle">0</span> <span
                      style="content: ' \2103';">&#8451;</span></h1>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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

          // document.getElementById('authorize_button').style.visibility = 'hidden';
          // document.getElementById('signout_button').style.visibility = 'hidden';

          /**
           * Callback after api.js is loaded.
           */
          function gapiLoaded() {
              gapi.load('client', initializeGapiClient);
          }

          /**
           * Callback after the API client is loaded. Loads the
           * discovery doc to initialize the API.
           */
          async function initializeGapiClient() {
              await gapi.client.init({
                  apiKey: API_KEY,
                  discoveryDocs: [DISCOVERY_DOC],
              });
              gapiInited = true;
              maybeEnableButtons();
          }

          /**
           * Callback after Google Identity Services are loaded.
           */
          function gisLoaded() {
              tokenClient = google.accounts.oauth2.initTokenClient({
                  client_id: CLIENT_ID,
                  scope: SCOPES,
                  callback: '', // defined later
              });
              gisInited = true;
              maybeEnableButtons();
          }

          /**
           * Enables user interaction after all libraries are loaded.
           */
          function maybeEnableButtons() {
              if (gapiInited && gisInited) {
                  document.getElementById('authorize_button').style.visibility = 'visible';
              }
          }

          /**
           *  Sign in the user upon button click.
           */
          function handleAuthClick() {
              tokenClient.callback = async (resp) => {
                  if (resp.error !== undefined) {
                      throw (resp);
                  }
                  // document.getElementById('signout_button').style.visibility = 'visible';
                  // document.getElementById('authorize_button').value = 'Refresh';
                  await uploadFile();

              };

              if (gapi.client.getToken() === null) {
                  // Prompt the user to select a Google Account and ask for consent to share their data
                  // when establishing a new session.
                  tokenClient.requestAccessToken({
                      prompt: 'consent'
                  });
              } else {
                  // Skip display of account chooser and consent dialog for an existing session.
                  tokenClient.requestAccessToken({
                      prompt: ''
                  });
              }
          }

          /**
           *  Sign out the user upon button click.
           */
          function handleSignoutClick() {
              const token = gapi.client.getToken();
              if (token !== null) {
                  google.accounts.oauth2.revoke(token.access_token);
                  // gapi.client.setToken('');
                  document.getElementById('content').style.display = 'none';
                  // document.getElementById('content').innerHTML = '';
                  document.getElementById('authorize_button').value = 'Authorize';
                  // document.getElementById('signout_button').style.visibility = 'hidden';
              }
          }

          /**
           * Upload file to Google Drive.
           */
          async function uploadFile() {
              var file = new Blob([fileContent], {
                  type: 'text/plain'
              });
              var metadata = {
                  'name': 'data', // Filename at Google Drive
                  'mimeType': 'text/plain', // mimeType at Google Drive
                  // TODO [Optional]: Set the below credentials
                  // Note: remove this parameter, if no target is needed
                  // 'parents': ['1qvt4mLipR3UGUhOmjLvuFh-3EE74BOPY'], // Folder ID at Google Drive which is optional
              };

              var accessToken = gapi.auth.getToken().access_token; // Here gapi is used for retrieving the access token.
              var form = new FormData();
              form.append('metadata', new Blob([JSON.stringify(metadata)], {
                  type: 'application/json'
              }));
              form.append('file', file);

              var xhr = new XMLHttpRequest();
              xhr.open('post', 'https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart&fields=id');
              xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
              xhr.responseType = 'json';
              xhr.onload = () => {
                  console.log(xhr.response.id)
                  // document.getElementById('content').innerHTML = "File uploaded successfully. The Google Drive file id is <b>" + xhr.response.id + "</b>";
                  // document.getElementById('content').style.display = 'block';
              };
              xhr.send(form);
          }
      </script>

      <script async defer src="https://apis.google.com/js/api.js" onload="gapiLoaded()"></script>
      <script async defer src="https://accounts.google.com/gsi/client" onload="gisLoaded()"></script>
  </body>

  </html>
