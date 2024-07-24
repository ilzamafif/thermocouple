<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Page</title>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const urlParams = new URLSearchParams(window.location.hash.substring(1));
            const accessToken = urlParams.get('access_token');

            if (accessToken) {
                const response = await fetch('/get-data');
                if (!response.ok) {
                    console.error('Failed to retrieve data');
                    return;
                }
                const data = await response.json();
                const fileContent = data['fileContent']['fileContent'];

                await uploadFile(accessToken, fileContent);
            } else {
                console.error('Access token not found in URL');
            }
        });

        async function uploadFile(accessToken, fileContent) {
            var file = new Blob([fileContent], {
                type: 'text/plain'
            });
            var metadata = {
                'name': 'data.txt', // Filename at Google Drive
                'mimeType': 'text/plain', // mimeType at Google Drive
            };

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
                if (xhr.status === 200) {
                    console.log('File uploaded successfully. File ID:', xhr.response.id);
                    window.location.href = "myapp://redirect";
                } else {
                    console.error('Error uploading file:', xhr.response);
                }
            };
            xhr.send(form);
        }
    </script>
</body>
</html>
