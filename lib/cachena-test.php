<?php 
require __DIR__.'/../config/config.php';

//Récupération des libellés de segments dans $lib_segments.
require __DIR__.'/lib_segments.php'; 

// Fonction qui va analyser une chaîne de caractères censée
// contenir une valeur de segment (ou de corpus) et rendre
// la valeur adéquate
function give_segment($chaine){
	$retval = "";
	// Distinguer segments et corpus
	if (substr($chaine, 1, 1) != " "){
		// C'est un segment
		$retval = substr($chaine, 0, 3);
	}
	else {
		// C'est en réalité un corpus
		// On extrait la valeur du corpus. Un corpus
		// est structuré ainsi X YYYYYY AAA. 
		// Il faut trouver la position de l'espace avant AAA.
		$position = strpos($chaine, " ", 2);
		$temp_retval = substr($chaine, 0, $position);
		// On remplace dans cette chaine les espaces par un _
		$retval = str_replace(" ", "_", $temp_retval);	
	}
	return $retval;
}


//Date du jour
$date = date("Y-m-d");
//Si le fichier existe déjà pour la date du jour

if(file_exists("cache/reportna".$date.".xml")) {
  //On renvoie le fichier déjà créé
  $xml_result = simplexml_load_file("cache/reportna".$date.".xml");
}
//Sinon on appelle l'API pour créer le fichier
else {
  $ch = curl_init();
  $url = 'https://api-eu.hosted.exlibrisgroup.com/almaws/v1/analytics/reports';
	$queryParams = '?' . urlencode('path') . '=' . urlencode('/shared/Campus Condorcet 33CCP_INST/Reports/LISTE_NOUVEAUTES') . '&' . urlencode('limit') . '=' . urlencode('1000') . '&' . urlencode('apikey') . '=' . urlencode(APIKEY);
  curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  //echo $url . $queryParams;
  $response = curl_exec($ch);
  //per debug
  //echo curl_getinfo($ch) . '<br/>';
  //echo curl_errno($ch) . '<br/>';
  //echo curl_error($ch) . '<br/>';
  curl_close($ch);

  //on met dans le cache
  $nomOutput="reportna".date("Y-m-d").".xml";
  file_put_contents ('cache/'.$nomOutput, $response);
  $var = $nomOutput;
  $xml_result = simplexml_load_file('cache/'.$var);
}

// Constitution de la liste des segments dans les résultats et de la boîte de tri
$lst_segments = array(); 
$segments_dispo = array(); // pour la boîte de tri
$segment = "";
foreach($xml_result->QueryResult->ResultXml->rowset->Row as $row) {
	$segment = give_segment($row->Column7);

	//echo "<br> Segment à ajouter : ".$segment;
	if (!in_array($segment, $lst_segments)) {
		$lst_segments[] = $segment;
	}
  	if (!array_key_exists($segment, $segments_dispo)) {
		$segments_dispo[$segment] = $lib_segments[$segment];
  	}
}

//print_r($segments_dispo);
?>

<p class="biblio">
	<span>Filtre par territoire :
		<select class="biblio" id="filtre_territoire">
			<option value="Tous">Tous</option>
			<option value="A">Territoire A</option>
			<option value="B">Territoire B</option>
			<option value="C">Territoire C</option>
			<option value="D">Territoire D</option>
			<option value="E">Territoire E</option>
			<option value="F">Territoire F</option>
			<option value="G">Territoire G</option>
			<option value="H">Territoire H</option>
		</select>
	</span>
	<span>Filtre par segment : 
  		<select class="biblio" id="filtre_segment">
  		<option value="Tous">Tous</option>
  		<option value="Unk">Non spécifié</option>
  		<?php
    			// On trie sur les segments par ordre alphabétique
    			asort($segments_dispo);
    			foreach($segments_dispo as $key => $value){
				// Le cas Unk pour une absence de segment est déjà prévu ci-dessus
				if ($key != "Unk"){
      					echo "<option value=\"".$key."\">".$value."</option>";
				}
    			}
  		?>
  		</select>
	</span>
</p>

<?php
// Affichage du résultat
echo '<ul class="list">';
$dateReception = new DateTime();
$segment = "";
foreach($xml_result->QueryResult->ResultXml->rowset->Row as $row){
  $segment = give_segment($row->Column7);
  echo '<div class="segment" id="'.$segment.'">';
  echo '<li><h3 class="title">' . $row->Column6 . '</h3>';

  $row->Column1 = str_replace(", ,",",",$row->Column1);

  echo '<p><span class="biblio"> Auteur : </span><span class="biblio-info">' . $row->Column1 . '</span></p>';
  echo '<p><span class="biblio"> Editeur, année : </span><span class="biblio-info">' . $row->Column5 . ' , ' . $row->Column4 . '</span></p>';
  echo '<p><span class="biblio">ISBN : </span><span class="biblio-info">' . $row->Column2 . '</span></p>';
  echo '<p><span  class="biblio">Cote : </span><span class="biblio">' . $row->Column7 . '</span></p>';
  $dateReception = (new DateTime($row->Column13))->format('d/m/Y');
  echo '<p><span  class="biblio">Date de réception de l\'exemplaire : </span><span class="biblio">' . $dateReception . '</span></p>';
  echo '<p><a class="ged" href="' . $row->Column14 . '">Voir la notice dans Primo VE</a></p></li>';
  echo '</div>';
}
echo '</ul>';
//var_dump($response);
?>
