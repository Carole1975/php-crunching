<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
	<title>Films 2</title>
</head>

<body>

<?php 

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];
$top100 =count($top);

echo "<h3>Le top 10 des films</h3>";
 for ($i = 1; $i <=10; $i++){
 	$titre = $top[$i]["im:name"]["label"];
 	echo $i. " ". $titre."<br>";
 }


  
echo "<h3>Quel est le classement du film Gravity?</h3>";
 for ($i = 0; $i < 100; $i++){
   $titre = $top[$i]["title"]["label"];
   if ($titre === "Gravity - Alfonso Cuarón") {
   	echo "Le classement du film est: ".$i;
   }
 }

 echo "<h3>Quel est le réalisateur du film LEGO Movie?</h3>";
  for ($i = 0; $i < $top100; $i++){
  	$titre = $top[$i]["im:name"]["label"];
  	if ($titre == "The LEGO Movie"){
  		echo "Les réalisateurs de ce film sont: ".$top[$i]["im:artist"]["label"];
  	}
  }

  echo "<h3>Combien de films sont sortis avant 2000?</h3>";
  $nbFilms = 0;
  for ($i = 0; $i < $top100; $i++){
  	$date = $top[$i]["im:releaseDate"]["label"];
  	if(date_parse($date)["year"]<2000){
  		$nbFilms++;
  	}
  }

  echo "le nombre de films sortis avant 2000 est de: ".$nbFilms."<br>";

 
  echo "<h3>Quel est le film le plus récent?</h3>";
  for ($i = 0; $i < $top100; $i++){
  	if($i == 0){
  		$filmRecent = $top[$i];
  	}
  	else{
  		$date = $top[$i]["im:releaseDate"]["label"];
  		$filmPlusRecent = $filmRecent["im:releaseDate"]["label"];
  		if ($date > $filmPlusRecent){
  			$filmRecent = $top[$i];
  		}
  	}
  }

  echo "Le film le plus récent du classement est:" .$filmRecent["im:name"]["label"];


  
  echo "<h3>Quel est le film le plus ancien?</h3>";
  $filmAncien = " ";
  for ($i = 0; $i < $top100; $i++){
  	if($i == 0){
  		$filmAncien = $top[$i];
  	}
  	else{
  		$date = $top[$i]["im:releaseDate"]["label"];
  		$filmPlusAncien = $filmAncien["im:releaseDate"]["label"];
  		if ($date < $filmPlusAncien){
  			$filmAncien = $top[$i];
  		}
  	}
  }

  echo "Le film le plus ancien du classement est:" .$filmAncien["im:name"]["label"];



  echo "<h3>Quelle est la catégorie de films la plus représentée?</h3>";
  $categorieCount = [];
  foreach($top as $value) {
    $categorieCount[$value["category"]["attributes"]["label"]] += 1;
  }
  
  echo array_search(max($categorieCount), $categorieCount);



  echo "<h3>Quel est le réalisateur est dans le top 100?</h3>";
  $realisateurCount = [];
  foreach ($top as $value) {
    $realisateurCount[$value["im:artist"]["label"]] += 1;
  }

  echo array_search(max($realisateurCount),$realisateurCount);



  echo "<h3>Combien cela coûterait-il d'acheter le top 10? De le louer?</h3>";
   $rentalCout = 0;
   $priceCout = 0;
   for ($i = 1; $i <= 10; $i++){
   
    $rentalCout += substr($top[$i]["im:rentalPrice"]["label"], 1);
    $priceCout += substr($top[$i]["im:price"]["label"], 1);
}
echo "Tarif locations = ".$rentalCout." "."dollars<br>";
echo "Tarif achats = ".$priceCout." "."dollars";
 


 echo "<h3>Quel est le mois ayant vu le plus de sorties au cinéma?</h3>";
$monthCount =[];
foreach ($top as $key =>$value){
    $monthCount[explode(" ", $value["im:releaseDate"]["attributes"]["label"])[0]] += 1;
    }
$monthCountArray = array_keys($monthCount, max($monthCount));
foreach ($monthCountArray as $value) {
    echo $value;
};

echo "<h3>Quels sont les 10 meilleurs films à voir en ayant un budget limité?</h3>";
$tabEntry = [];
$tabTitle = [];
$tabPrice = [];
foreach ($top as $key => $value) {
    $tabEntry[] = $key;
    $tabTitle[] = $value["im:name"]["label"];
    $tabPrice[] = substr($value["im:price"]["label"], 1);
}
array_multisort($tabPrice, SORT_ASC, $tabEntry, SORT_NUMERIC, $tabTitle);
for($i = 0; $i < 10; $i++) {
    echo "<br>n°: ".$tabEntry[$i]." - ".$tabTitle[$i].": $".$tabPrice[$i];
}

  
?>

</body>

</html>