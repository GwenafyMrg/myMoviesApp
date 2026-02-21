<?php
// Importation du header et des fonctions :
include('includes/header.php');
include('includes/functions.php');

$config = require('config.php');

$conn = mysql_connect($config['host'], $config['user'], $config['password']);
mysql_select_db($config['dbname'], $conn);

$id = isset($_GET['id']) ? $_GET['id'] : 0;     // On récupère l'ID passé dans l'URL.
$movie = fetchMovieById($conn, $id);    // Recherche du film selon l'ID.

?>

<main class="container">
    <?php if ($movie): ?>
        <section class="movie-card" style="border-left-width: 10px;">
            <h2 class="movie-title" style="font-size: 2.5rem;"><?php echo htmlspecialchars($movie['title']); ?></h2>
            <p class="movie-note" style="display:inline-block; margin-bottom:20px;">Note Globale : ⭐ <?php echo $movie['note']; ?>/10</p>
            
            <hr>
            
            <div class="movie-details-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <!-- Affichage du détail de la note -->
                <div><strong>📖 Histoire :</strong> <?php echo $movie['history']; ?>/10</div>
                <div><strong>👥 Personnages :</strong> <?php echo $movie['characters']; ?>/10</div>
                <div><strong>🎵 Musique :</strong> <?php echo $movie['music']; ?>/10</div>
                <div><strong>🎬 Action :</strong> <?php echo $movie['action']; ?>/10</div>
                <!-- Soit on affiche la note de l'atmosphère du film -->
                <?php if(isset($movie['atmosphere'])): ?>
                    <div><strong>🌌 Atmosphère :</strong> <?php echo $movie['atmosphere']; ?>/10</div>
                <!-- Soit on affiche la note de la scène post générique du film -->
                <?php else: ?>
                    <div><strong>🌌 Scène post-générique :</strong> <?php echo $movie['postCredit']; ?>/10</div>
                <?php endif; ?>
            </div>

            <p style="margin-top: 30px;">
                <a href="index.php" class="menu-btn">← Retour</a>
            </p>
        </section>
    <?php else: ?>
        <p>Film non trouvé.</p>
        <a href="index.php">Retour à l'accueil</a>
    <?php endif; ?>
</main>

<?php
mysql_close($conn); // Fermeture propre de la connexion.
include('includes/footer.php');         // Importation du pied de page.
?>