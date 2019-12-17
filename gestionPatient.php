<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de test</title>
<script src="https://kit.fontawesome.com/53044d83ca.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Page de test </h1>
			<br/> 
			<form action="" method="post">
				<button type="submit" name="action" value="add"><i class="fas fa-plus"> Ajouter</i></button>
				<button type="submit" name="action" value="edit"><i class="far fa-edit"> Modifier</i></button>
				<button type="submit" name="action" value="del"><i class="far fa-trash-alt"> Effacer</i></button>
			</form><br/><br/>
			<?php
				if (isset($_POST['action'])) { 
					echo "Vous avez cliqué sur [".$_POST['action']."]";
				
					switch ($_POST['action']) {
						case 'add':
							echo '<h3>Ajout d\'un patient</h3>';
							echo '<form action="ajoutPatient.php" method="post">';
							$fields = array('Nom'=>'<input type="text" name="Nom">',
							'Prénom'=>'<input type="text" name="Prenom">',
							'Adresse'=>'<input type="text" name="Adresse">',
							'Code Postal'=>'<input type="text" name="Cp">',
							'Civilité'=>'<select name="Civilite"><option value="M">Monsieur</option><option value="F">Madame</option></select>',
							'Lieu de Naissance'=>'<input type="text" name="LieuN">',
							'Date de Naissance'=>'<input type="date" name="DateN">',
							'Identifiant Médecin'=>'<select name="id_medecin">'.$medecinoptions.'</select>',
							'Numéro de Sécurité Sociale'=>'<input type="text" maxlength="13" name="NumSecuSoc">'
							);
							echo "<table>";
							foreach ($fields as $field => $value) {
								echo "<tr><td>$field</td><td>$value</td></tr>";						
							}
							echo '</table><input type="reset" name="clear"><input type="submit" name="valider"> <br/> </form><br/><br/>';
							break;					
					}

				}
					
			?>
<?php
include '.credentials.php';
$sql = "SELECT * FROM `patient` WHERE 1";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

	$resultats = $conn->query($sql);
	$medecins  = $conn->query("SELECT * FROM medecin");
	$medecinoptions = "";
	foreach($medecins as $med) {
		$medecinoptions .= "<option value=$med['id_medecin']>$med['nom']</option>";
	}
	//print_r($resultats);

	$lastVal = "";
	$firstLoop = true;
	$header = "";
	$tablerow = "";

	echo "<table border=\"1\">";
	foreach ($resultats as $res) {
		$tablerow .= "<tr>";
		foreach($res as $key => $value) {
			
			if ($lastVal!=$value){
				if ($firstLoop) {
					$header .= "<th>".$key."</th>";			
				}
				$tablerow .= "<td>". $value . '</td>';
				$lastVal=$value;
			}
		}
		if ($firstLoop) {
			print($header);
			$header="";
			$firstLoop=false;
		}
		print($tablerow."</tr>");
		$tablerow="";
		//print_r($res);
	}
	//echo $conn;
}

catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = NULL;
		?>
		</form>

    </body>
</html>

