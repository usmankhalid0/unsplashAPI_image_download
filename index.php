<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <title>Image Search</title>
  </head>
  <body>
    <div class="container mt-4">
      <div class="input-group input-group-lg">
        <input type="text" class="form-control" id="imageInput" placeholder="Search for an image..." aria-label="Search for an image">
        <div class="input-group-append">
          <button class="btn btn-primary" id="searchImage">Search</button>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <div id="imageContainer" class="d-flex flex-wrap"></div>
    </div>

    <script>
      document.getElementById('searchImage').addEventListener("click", () => {
        const accessKey = "NfovgrYduywl37PLoLp5IThJB8k-G87f3VX-_XXRUcw";
        const apiUrl = "https://api.unsplash.com/photos/random";
        const imageContainer = document.getElementById('imageContainer');
        const imageInput = document.getElementById("imageInput").value.trim();

        if (imageInput === '') {
          alert('Please enter a valid search term.');
          return;
        }
        // console.log((`${apiUrl}?query=${imageInput}&count=20&client_id=${accessKey}`));
        fetch(`${apiUrl}?query=${imageInput}&count=20&client_id=${accessKey}`)
          .then(response => response.json())
          .then(data => {
            imageContainer.innerHTML = "";
            data.forEach(photoData => {
    const photoURL = photoData.urls.regular;
    const downloadURL = photoData.links.full;

    // Create container for image and button
    const div = document.createElement('div');
    div.className = "d-flex flex-column align-items-center m-2";

    // Create image
    const img = document.createElement('img');
    img.src = photoURL;
    img.className = "img-thumbnail";
    img.style.height = "200px";
    img.style.width = "200px";
    img.onclick = () => {
        window.open(photoURL, '_blank');
    };

    // Create download button
    const button = document.createElement('a');
    button.href = downloadURL;
    button.className = "btn btn-primary mt-2";
    button.innerText = "download";
    button.setAttribute("download", "image.jpg"); // Allows direct download

    // Append image and button to container div
    div.appendChild(img);
    div.appendChild(button);

    // Append container to imageContainer
    imageContainer.appendChild(div);
});

          })
          .catch(error => console.error('Error fetching images:', error));
      });
    </script>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
