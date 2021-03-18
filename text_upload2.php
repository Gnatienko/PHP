
  <link rel="stylesheet" href="css/style.css">


<?php
  $content = $_POST['contentForm'];
  if($content == '') {
    echo 'Error: Please enter some text';
    exit();
  }  else{
      require 'word_translation.php';
      $word = new Word;
      $splitedContent = explode(" ", $content);

      foreach ($splitedContent as &$value) {
        $word->originalValue = $value;
          echo '<table > <tr>';
          echo '<div class="translation">'.$word->getTranslation().'</div>';
          echo '<div >'.$word->originalValue.'</div>';
          echo '</tr></table> ';
        }



    }
?>
