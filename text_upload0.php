<?php
  $content = $_POST['contentForm'];
  if($content == '') {
    echo 'Error: Please enter some text';
    exit();
  }  else{
      require 'word_translation.php';
      $word = new Word;
      $word->originalValue = $content;
      echo $word->getTranslation();

    }


require 'configDB.php';



// запись в БД
$sql = 'INSERT INTO book_content_table(original_page_content_column) VALUES(:someText)'; //сомтекст -заглушка
$query = $pdo->prepare($sql);
$query->execute(['someText' => $contentToDB]);


?>
<form>
  Text
  <i>
    <?php
    echo substr($contentToDB,0,7);
    if (strlen($contentToDB) > 7) {
       echo "..";
     }
    ?> </i>
 added

</form>
<a href="/"><button>Ok</button></a>
