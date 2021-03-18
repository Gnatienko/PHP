


<?php
class Word
{
  public $originalValue;


  function __construct($originalValue='')
  {
      $this->originalValue = $originalValue;
  }

  function getTranslation ()
  {
    $translateApiURL = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ru&dt=t&q=';
    $translateApiResponse = file_get_contents($translateApiURL.$this->originalValue);
    $translation = json_decode($translateApiResponse)[0][0][0];
    return $translation;
  }
}

// $word = new Word;
// $word->originalValue = 'five';
// echo $word->getTranslation();
//
// echo '1'
?>
