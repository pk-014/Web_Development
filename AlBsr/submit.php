<?php


$api = 'https://api.api-ninjas.com/v1/imagetotext';

if(isset($_FILES['file'])){
    // echo "<p>Printing file info</p><br>";
    // var_dump($_FILES);
    // using curl for making api call
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, $api); 
    curl_setopt($crl, CURLOPT_POST, true); 
    curl_setopt($crl, CURLOPT_POSTFIELDS, array('image' => new CURLFile($_FILES['file']['tmp_name']))); 
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($crl);
    curl_close($crl);
    // echo "<p> => Extracted Text: </p>";
    $result = json_decode($result, true); 
    $data = "";
    foreach($result as $r){
        $data .= $r['text'] . " " ;
    }
  
    // echo $result;
    // echo "<br>";
    // echo $_FILES['file']['tmp_name'];
    // echo "<br>";
    // echo $_FILES['file']['name'];
    // echo "<br>";
    // echo $_FILES['file']['size'];
    // echo "<br>";
    // echo $_FILES['file']['type'];
    // echo "<br>";
}
else{
    echo "Nothing found";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Material CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <!-- Summernote -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
     <!-- custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/ALBSR.png" type="image/x-icon">
    <title>ALBSR</title>
</head>
<body>
    <!-- header -->

  <!-- <div class="header">
    <div class="logo">
        <img src="assets/images/ALBSR.png" alt="ALBSR-LOGO" >
       
    </div>
    <div class="links">
        <ul>
            <a href="###"><li>Faqs</li></a>
            <a href="###"><li>Contact Author</li></a>
        </ul>
    </div>
  </div> -->

<!-- Body starts here -->
 <hr>
<div style="margin-top: 90px;display: flex;flex-direction: column; align-items: center;justify-content: center;height: 60vh;">
    <h1>Extracted Text</h1>
    <div id="summernote"  ><p><?php echo $data; ?></p></div>
    <div class="buttons">
        <button class="btn " style="background-color: #000;color: #ffff;margin: 5px;" onclick="copyText()">Copy Text</button>
        <button class="btn " style="background-color: #000;color: #ffff;margin: 5px;" onclick="savePDF()">Save as PDF</button>
    </div>
    <a href='/AlBsr/'>Extract another text</a>
</div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            width:1000,
        });
    });
    function copyText(){
        let text = $($('#summernote').summernote('code')).text();
        navigator.clipboard.writeText(text);
        alert("Text copied successfully.");
    }
    function savePDF(){
        var content = document.getElementById('summernote').innerHTML;
        let text = $('#summernote').summernote('code');
        var printWindow = window.open('', '', 'height=500,width=800');
        printWindow.document.write('<html><head><title>AlBsr-Extractedtext</title>'); 
        // printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"/>'); 
        printWindow.document.write('</head><body>'); 
        printWindow.document.write(text); 
        printWindow.document.write('</body></html>'); 
        printWindow.document.close(); 
        printWindow.print();
    }
  </script>

    <!-- custom script -->
     <script src="assets/js/script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>