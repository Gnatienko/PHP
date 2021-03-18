
  <link rel="stylesheet" href="css/style.css">


<?php
  $content = $_POST['contentForm'];
  if($content == '') {
    echo 'Error: Please enter some text';
    exit();
  }  else{

      $splittedContent = explode(" ", $content);




      //getting internal dictionary from DB
  require 'configDB.php';
  $sql = mysqli_query($link, 'SELECT * FROM `internal_dictionary`');
  while ($result = mysqli_fetch_array($sql)) {
    $internalDictionaryArray[$result['en']]=$result['ru'];
  }


// google translation
  function googleTranslation ($toTranslate)
  {
    $translateApiURL = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ru&dt=t&q=';
    $translateApiResponse = file_get_contents($translateApiURL.$toTranslate);
    $translation = json_decode($translateApiResponse)[0][0][0];
    return $translation;
  }


  function internalTranslation($toTranslate, $dictionaryArray)
  {
    $internalTranslation = $dictionaryArray[$toTranslate];
      return $internalTranslation;
  }






        //show on screen
      echo ' <div class="obshchij">';
      foreach ($splittedContent as &$value) {
          echo '<div class="word">';
          if($internalDictionaryArray[$value]){
          echo '<div class="translation">'.$internalDictionaryArray[$value].'</div>';
        }else{
          $googleTranslatedValue = googleTranslation($value);
          echo '<div class="translation">'.$googleTranslatedValue.'</div>';
//add to DB unknown words
$sql = "INSERT INTO internal_dictionary (en, ru) VALUES ('$value', '$googleTranslatedValue')";
mysqli_query($link, $sql);



        }
          echo '<div  class="original">'. $value.'&nbsp'.'</div>';
          echo '</div>';
          }
          echo ' </div>';

    }
?>
