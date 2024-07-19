<!DOCTYPE html>
<html>

<head>
    <title>Google Drive Upload</title>
    <script src="https://apis.google.com/js/api.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const urlParams = new URLSearchParams(window.location.hash.substring(1));
            const accessToken = urlParams.get('access_token');
            if (accessToken) {
                const fileContent = localStorage.getItem('fileContent'); // Retrieve fileContent from localStorage
                if (fileContent) {
                    await uploadFile(accessToken, fileContent);
                    localStorage.removeItem('fileContent'); // Optionally clear the stored fileContent
                } else {
                    await uploadFile(accessToken, '-');
                    console.error('No file content found');
                }
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
                    window.location.href = "{{ url('/') }}"; // Redirect to the main page after successful upload
                } else {
                    console.error('Error uploading file:', xhr.response);
                }
            };
            xhr.send(form);
        }
    </script>
</head>

<body>
    <p>Uploading to Google Drive...</p>
</body>

</html>