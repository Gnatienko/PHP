<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Reader</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


 </head>
 <body>
    <div>
        <?php
        session_start();
        echo 'Hi, "'.$_SESSION['login'].'"';
        ?>
        <a href="logout.php">Logout</a>
    </div>

   <div>
     <form action="/text_processing.php" method="post">
       <textarea  name="contentForm" id="contentForm" placeholder='Please insert text and press "Upload"' class="form-control"></textarea>
       <div class="btn-align">
         <button type="submit" name="Upload_text" class="btn btn-success">Upload</button>
       </div>

     </form>


   </div>

 </body>
</html>
