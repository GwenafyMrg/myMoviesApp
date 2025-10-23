<?php

include('includes/header.php');

// Afficher les erreurs (à désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Récupération des paramètres de connexion Free :
$config = require('config.php');

// Connexion à MySQL (ancienne extension)
$conn = mysql_connect($config['host'], $config['user'], $config['password']);

// -----------------------------------------

if (!$conn) {
    die("Connexion échouée : " . mysql_error()); //die() --> bloque la suite du script PHP.
}
echo "Connexion réussie à MySQL !<br>";

// Sélection de la base
$dbname = $config['dbname'];
$db_selected = mysql_select_db($dbname, $conn);
if (!$db_selected) {
    die("Base de données non trouvée : " . mysql_error());
    //mysql_errror() --> renvoie la dernière erreur MySQL trouvée.
}
echo "Base de données sélectionnée : $dbname<br>";

// Requête SQL :
$sql = "SELECT * FROM movies";      // Variable (optionnel) pour stocker la requête.
$result = mysql_query($sql, $conn);
//mysql_query(<query>,<conn>) --> exécution de la requête.

if (!$result) {
    die("Erreur SQL : " . mysql_error());
}

// Affichage des résultats :
if (mysql_num_rows($result) == 0) {
    //mysql_num_rows() --> renvoie le nombre de ligne retourné par une query.
    echo "Aucun film trouvé.<br>";
} else {
    echo "<ol>";
    while ($row = mysql_fetch_assoc($result)) {
        //Récupère la ligne suivante d'un résultat query sous forme de tableau associatif.
        echo "<li>Titre : " . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . " - Note " . htmlspecialchars($row['note'],ENT_QUOTES, 'UTF-8') . "</li><br>";
        //htmlspecialchars() --> sécurité contre les attaques XSS (agit sur les caractères spéciaux HTML)
    }
    echo "</ol>";
}

// -----------------------------------------

// Fermer la connexion :
mysql_close($conn);

?>

</body>
</html>