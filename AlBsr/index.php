<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Material CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />

    <!-- custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/ALBSR.png" type="image/x-icon">
    <title>ALBSR</title>
</head>
<body>
  <div class="header">
    <div class="logo">
        <img src="assets/images/ALBSR.png" alt="ALBSR-LOGO" >
        <!-- <h1>AL-BASR</h1> -->
    </div>
    <div class="links">
        <ul>
            <a href="###"><li>Faqs</li></a>
            <a href="###"><li>Contact Author</li></a>
        </ul>
    </div>
  </div>

<!-- Body starts here -->

<div class="main">
    <div class="square">
        <span></span>
        <span></span>
        <span></span>
        <div class="content drop-container" id="dropcontainer">
            <!-- <h2>
                AL BASR
            </h2> -->
            <!-- <p>Upload your files and get the text extracted in seconds.</p> -->
            <p>Choose an image to extract the text.</p>
            <div class="upload-wrap">
                <form action="submit.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" id="images" accept="image/*" multiple size="10"  id = upload require>
                <input type="submit" value="Submit"  >
                </form>
            </div>
        
        </div>
    </div>

</div>


    <!-- custom script -->
     <script src="assets/js/script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>