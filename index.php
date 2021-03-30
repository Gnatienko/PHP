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






     <form action="/text_upload.php" method="post">
       <textarea  type="text" name="contentForm" id="contentForm" placeholder="Please insert text..." class="form-control"></textarea>
       <div class="btn-align">
         <button type="submit" name="Upload_text" class="btn btn-success">Upload</button>
       </div>



     </form>


   </div>
   <div>
     <?php
     require 'processing.php'

     ?>


   </div>






 </body>
</html>
