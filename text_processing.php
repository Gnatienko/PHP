<?php
session_start();
echo 'Hi, "'.$_SESSION['login'].'"';
?>
<a href="logout.php">Logout</a>
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
  $sql = mysqli_query($connectionDB, 'SELECT * FROM `internal_dictionary`');
  while ($result = mysqli_fetch_array($sql)) {
    $internalDictionaryArray[$result['en']]=$result['ru'];
    $rank[$result['en']]=$result['rank'];
  }

  //getting users setting
$login = $_SESSION['login'];
$sql = mysqli_query($connectionDB, "SELECT * FROM `users` WHERE login='$login'");
while ($result = mysqli_fetch_array($sql)) {
    $userId = $result['id'];
}

$sql = mysqli_query($connectionDB, "SELECT * FROM `users_settings` WHERE user_id='$userId'");
while ($result = mysqli_fetch_array($sql)) {
    $userSetting[knownWordsIndex] = $result['known_words_index'];
}



//  translation
  function googleTranslation ($toTranslate)
  {
    $translateApiURL = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ru&dt=t&q=';
    $translateApiResponse = file_get_contents($translateApiURL.$toTranslate);
    $translation = json_decode($translateApiResponse)[0][0][0];
    if($translation<>''){
        return $translation;
    }else{
        return 'error';
    }

  }



//
//


        //show on screen
      echo ' <div class="common">';
      foreach ($splittedContent as $word) {

          $clearedWord = strtolower(preg_replace('/[^a-z-]+/i', '', $word));
          echo '<div class="word">';
          if($internalDictionaryArray[$clearedWord]){
              if($rank[$clearedWord]>$userSetting[knownWordsIndex] or  $rank[$clearedWord] == 0 ) {
                  echo '<div class="translation">' . $internalDictionaryArray[$clearedWord] . '</div>';
              }
              else{
                  echo '<div class="translation">' . '-' . '</div>';
              }
          }
          else{
          $googleTranslatedValue = googleTranslation($clearedWord);
          echo '<div class="translation">'.'<spun>'.$googleTranslatedValue.'++'.'</spun>'.'</div>';


//add to DB unknown words

          $sql = "INSERT INTO internal_dictionary (rank, en, ru) VALUES (0,'$clearedWord', '$googleTranslatedValue')";
          mysqli_query($connectionDB, $sql);



        }
          echo '<div  class="original">'. $word.'&nbsp'.'</div>';
          echo '</div>';
          }
          echo ' </div>';

    }
?>
