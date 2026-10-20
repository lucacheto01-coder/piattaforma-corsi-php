<?php 

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
            
    
        $nome = $_POST["campoNome"];
        $cognome = $_POST["campoCognome"];
        $email = $_POST["campoEmail"];
        $codicefiscale = $_POST["campoCf"];
        $username = $_POST["campoUsername"];
        $password = $_POST["campoPassword"];
            
        if (strlen($password) < 5) {
            echo "La password deve contenere almeno 5 caratteri.";
            exit;
        }
        
        $sql = "SELECT id FROM utente WHERE nome = ? AND cognome = ? AND email = ? AND cf = ?";
        $stmt = $connessione->prepare($sql);
        $stmt->bind_param("ssss", $nome, $cognome, $email, $codicefiscale);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            echo "Esiste gi� un utente con questi dati.";
            exit;
            
        }
        
        $sql = "SELECT id FROM utente WHERE username = ?";
        $stmt = $connessione->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
               echo "Esiste gia un utente con questo username.";
               exit;
       
        }
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

       $sql = "INSERT INTO utente (nome, cognome, email, cf, username, pass_word) VALUES (?, ?, ?, ?, ?, ?)";
       $stmt = $connessione->prepare($sql);
       $stmt->bind_param("ssssss", $nome, $cognome, $email, $codicefiscale, $username, $passwordHash);
       $stmt->execute();
        echo "Registrazione effettuata con successo";
     }
                     
?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="style.css">
  </head>
   <body>
      <h1>Iscriviti</h1>
      
      <h3>inserisci i tuoi dati:</h3>
      
      <form method="post">
         <p>
            <label>nome</label><br>
            <input name="campoNome" required>
         </p>
                  
         <p>
            <label>cognome</label><br>
            <input name="campoCognome" required>
         </p>
         
         <p>
            <label>email</label><br>
            <input name="campoEmail" required>
         </p>
         
         <p>
            <label>codice fiscale</label><br>
            <input name="campoCf" required>
         </p>
         
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






