<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de test</title>
	<meta http-equiv = "refresh" content = "0; url =http://r-info-nacre/~kml2784a/ProjetMedecin/gestionPatient.php" />
    </head>
    <body>
        <h1>Page de test </h1>

<?php
include '.credentials.php';


$sql = "INSERT INTO patient (numSecuSoc,Nom, Prenom, Adresse, Cp,dateN,civilite,lieuN,id_medecin) VALUES ('".$_POST["NumSecuSoc"]."','". $_POST["Nom"]."','".$_POST["Prenom"]."','".$_POST["Adresse"]."','".$_POST["Cp"]."','". $_POST["DateN"]."','". $_POST["Civilite"]."','". $_POST["LieuN"]."','".$_POST["id_medecin"]."')";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

	$conn->exec($sql);
	echo "New record created successfully";
}

catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = NULL;
		?>

    </body>
</html>
