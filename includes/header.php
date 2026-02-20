<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <title>Mes Films</title>
</head>
<body>
    <header>
        <div class="Header-components logo-div">
            <span class="logo-icon">🎬</span>
            <h1>Mes Films</h1>
        </div>
        
        <div class="Header-components searchBar-div">
            <form action="index.php" method="GET" class="search-form">
                <input type="text" name="search" id="searchBar" placeholder="Rechercher un film...">
                <button type="submit" class="btn-search">🔍</button>
            </form>
        </div>

        <div class="Header-components Interactive-header-div">
            <p>Bienvenue The_ScareCrow !</p>
            <div class="nav-buttons">
                <a href="index.php" class="menu-btn">Accueil</a>
                <a href="collection.php" class="menu-btn">Ma Collection</a>
            </div>
        </div>
    </header>