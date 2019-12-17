<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de test</title>
    </head>
    <body>
        <h1>Page de test </h1>

<?php

include '.credentials.php';

$sql = "SELECT * FROM `patient` WHERE 1";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

	$resultats = $conn->query($sql);
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

    </body>
</html>
