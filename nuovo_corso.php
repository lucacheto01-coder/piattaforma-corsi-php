<?php
session_start();

if (! isset($_SESSION["utente"])) {

    header("Location: login.php");

    exit();
}

$utente = $_SESSION["utente"];

$idUtente = $utente["id"];

$indirizzoServer = "localhost";
$nomeUtente = "root";
$passwordDb = "";
$nomeDb = "piattaforma";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connessione = new mysqli(
        $indirizzoServer,
        $nomeUtente,
        $passwordDb,
        $nomeDb
    );

    $connessione->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    die("Errore di connessione al database.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idCorso = $_POST["idCorso"];

    $sql = "SELECT id FROM iscrizione
            WHERE id_utente = ? AND id_corso = ?";

    $stmt = $connessione->prepare($sql);

    $stmt->bind_param("ii", $idUtente, $idCorso);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo "Sei gi� iscritto a questo corso.";
    } else {

        $sql = "INSERT INTO iscrizione (id_utente, id_corso)
                VALUES (?, ?)";

        $stmt = $connessione->prepare($sql);

        $stmt->bind_param("ii", $idUtente, $idCorso);

        $stmt->execute();

        header("Location: corsi.php");

        exit();
    }
}

$sql = "SELECT id, denominazione FROM corso";

$stmt = $connessione->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>

<title>Nuovo corso</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

	<h1>Iscriviti a un nuovo corso</h1>

	<form method="post">

		<label>Scegli un corso:</label> <select name="idCorso">

            <?php

            while ($corso = $result->fetch_assoc()) {

                echo "<option value='" . $corso["id"] . "'>";
                echo $corso["denominazione"];
                echo "</option>";
            }

            ?>

        </select> <br> <br> <input type="submit" value="Iscriviti">

	</form>

	<br>

	<a href="corsi.php">Torna ai miei corsi</a>

</body>

</html>

