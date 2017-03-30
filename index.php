<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Dictionnaire</title>
</head>

<body>

	<h1>Dictionnaire</h1>

	  <p>Combien de mots contient ce dictionnaire?</p>

	    <?php  

	      $string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
	      $dico = explode("\n", $string);
	       echo count($dico)." ". "mots.";
	    ?>

	  <p>Combien de mots font exactement 15 caractères?</p>

	<?php  

	      $words_15 = array();
	      foreach ($dico as $word){
		   if (strlen($word)== 15){
			array_push($words_15, $word);
		}
	}
	echo count($words_15)." "."mots.";

	?>

	  <p>Combien de mots contiennent la lettre "w"?</p>

	<?php

	      $words_w = array();
	      foreach ($dico as $word){
		   if (strpos($word, "w")!== false){
			array_push($words_w, $word);
		}
	}
	echo count($words_w)." "."mots.";
	
	?>

	  <p>Combien de mots finissent par la lettre "q"?</p>

	<?php  

	      $words_q = array();
	      foreach ($dico as $word){
		   if (substr($word, -1)== "q"){
			array_push($words_q, $word);
		}
	}
	echo count($words_q)." "."mots.";
	
	?>

</body>

</html>