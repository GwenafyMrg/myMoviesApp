<?php

// Génération du Header et des fonctions :
include('includes/header.php');
include('includes/functions.php');

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
// echo "Connexion réussie à MySQL !<br>";

// Sélection de la base de données :
$dbname = $config['dbname'];
$db_selected = mysql_select_db($dbname, $conn);
if (!$db_selected) {
    die("Base de données non trouvée : " . mysql_error());
    //mysql_errror() --> renvoie la dernière erreur MySQL trouvée.
}
// echo "Base de données sélectionnée : $dbname<br>";

// -----
// Logique de recherche
// -----
$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<main class="container">
    <?php if (!empty($search)): ?>
        <section class="movie-list-section">
            <h2>Résultats pour : "<?php echo htmlspecialchars($search); ?>"</h2>
            <div class="movie-list">
                <?php 
                $result = fetchMovies($conn, $search);
                if (mysql_num_rows($result) > 0) {  // Si le nombre d'enregistrement remonté est > 0 :
                    // Génération d'une carte pour chaque film retourné.
                    while ($row = mysql_fetch_assoc($result)) renderMovieCard($row);
                } else {
                    echo "<p>Aucun film trouvé.</p>";
                }
                ?>
            </div>
            <p><a href="index.php" class="back-link">← Retour à l'accueil</a></p> 
        </section>

    <?php else: ?>
        <section class="movie-list-section">
            <div class="section-title-box">
                <h2>Le Top 10 des Films</h2>
            </div>
            <div class="movie-list">
                <?php 
                $top10 = fetchMovies($conn, '', 10);
                while ($row = mysql_fetch_assoc($top10)) renderMovieCard($row);
                ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
mysql_close($conn);     // Fermeture proore de la connexion.
include('includes/footer.php');         // Génération du pied de page.
?>