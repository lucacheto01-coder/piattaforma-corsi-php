<?php


session_start();

if (!isset($_SESSION["utente"])) {
    
    header("Location: login.php");
    
    exit;
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
    
        $sql = "SELECT corso.id, corso.denominazione FROM corso INNER JOIN iscrizione ON corso.id = iscrizione.id_corso WHERE iscrizione.id_utente = ?";
        
        $stmt = $connessione->prepare($sql);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>

    <title>I miei corsi</title>
    
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>I miei corsi</h1>


    <p>
        Benvenuto
        <?php echo $utente["nome"]; ?>
        <?php echo $utente["cognome"]; ?>
    </p>


    <?php

    if ($result->num_rows > 0) {

        while ($corso = $result->fetch_assoc()) {

            echo "<p>";
            echo $corso["denominazione"];
            echo "</p>";

        }

    } else {

        echo "<p>Non sei iscritto a nessun corso.</p>";

    }

    ?>


    <br>

    <a href="nuovo_corso.php">
        Iscriviti a un nuovo corso
    </a>

    <br><br>

    <a href="logout.php">
        Logout
    </a>

</body>

</html>