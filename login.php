<?php


session_start();


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
            
            $username = $_POST["campoUsername"];
            $password = $_POST["campoPassword"];
            
            $sql = "SELECT id, username, nome, cognome, email, cf, pass_word
        FROM utente
        WHERE username = ?";

$stmt = $connessione->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $utente = $result->fetch_assoc();

    if (password_verify($password, $utente["pass_word"])) {

        unset($utente["pass_word"]);

        session_regenerate_id(true);

        $_SESSION["utente"] = $utente;

        header("Location: corsi.php");
        exit;

    } else {
        echo "Username o password errati.";
    }

} else {
    echo "Username o password errati.";
}
        }


?>

<!DOCTYPE html>
<html>
   <head>
   <link rel="stylesheet" href="style.css">
   </head> 
   <body>
     <h1>Accedi</h1>
     <h3>Inserisci i tuoi dati</h3>
       <form method="post">
       <p>
            <label>username</label><br>
            <input name="campoUsername" required>
         </p>
         
         <p>
            <label>password</label><br>
            <input name="campoPassword" type="password" required>
         </p>
        
         <input type="submit">

       </form>
   </body>
</html>
