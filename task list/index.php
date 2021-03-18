<!DOCTYPE HTML>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список дел</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 </head>
 <body>
   <div class="container">
     <h1>Список дел</h1>
     <form action="/add.php" method="post">
       <input type="text" name="task" value="" id="task" placeholder="Нужно сделать">
       <button type="submit" name="send task" class="btn btn-success">Отправить </button>
     </form>

     <?php
      require 'configDB.php';

      echo'<ul>';
      $query = $pdo->query('SELECT * FROM `tasks` ORDER BY `ID` DESC');
      while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo '<li><b>'.$row->task.'</b><button>del</button></li>';
      }
      echo'</ul>';
    ?>



 </body>
</html>
