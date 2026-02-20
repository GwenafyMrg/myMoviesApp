<?php
// Génération du header HTML et des fonctions PHP.
include('includes/header.php');
include('includes/functions.php');

// Inporter les crédentials.
$config = require('config.php');

// Connection à la base de données.
$conn = mysql_connect($config['host'], $config['user'], $config['password']);
mysql_select_db($config['dbname'], $conn);

?>

<!-- Génération du code HTML pour l'affichage de la collection. -->
<main class="container">
    <section class="movie-list-section">
        <h2>Ma Collection Complète de Films</h2>
        <div class="movie-list">
            <?php 
                $all = fetchMovies($conn);  // Récupération des films.
                // Affichage du rendu pour tous les films.
                while ($row = mysql_fetch_assoc($all)) renderMovieCard($row); 
            ?>
        </div>
    </section>
</main>

<?php
// Fermeture de la connexion.
mysql_close($conn);
// Génération du footer HTML.
include('includes/footer.php');
?>