<?php
// Récupère les films selon le contexte (Tous, Top 10 ou Recherche)
function fetchMovies($conn, $search = '', $limit = null) {
    $search = mysql_real_escape_string($search);
    
    // Si une recherche est faite, on affiche les films qui correspondent.
    if (!empty($search)) {
        $sql = "SELECT * FROM movies WHERE title LIKE '%$search%' ORDER BY note DESC";
    } else {
    // Sinon on récupère tous les films.
        $sql = "SELECT * FROM movies ORDER BY note DESC";
        // On pose une limite (10 meilleurs films) si spécifié.
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
    }
    
    return mysql_query($sql, $conn);
}

// Affiche un rendu HTML pour le film transmis
function renderMovieCard($row) {
    $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
    $note = htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8');
    
    echo "
    <div class='movie-card'>
        <h3 class='movie-title'>$title</h3>
        <div class='movie-rating-wrapper'>
            <span class='movie-note'>⭐ $note/10</span>
        </div>
    </div>";
}