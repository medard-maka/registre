
<?php
session_start(); // Assurez-vous que la session est démarrée

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirigez vers la page de connexion si non connecté
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="vk.css"> <!-- Assurez-vous que le fichier CSS existe -->
</head>
<body>
    <header>
        <h1>Carnet Electronique</h1>
        <nav>
            <ul>
                <li><a href="ajoutp.php">Ajouter un Produit</a></li>
                <li><a href="ajout.php">Ajouter un Client</a></li>
                <li><a href="fac.php">creer votre carnet</a></li>  
                <li><a href="ak.php">Generer un carnet</a></li>
                <li><a href="affichage.php">Afficher votre carnet</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
                <li><a href="supprimer.php">Supprimer</a></li>


            </ul>
        </nav>
    </header>
    <main>
        <p>Bonjour, bienvenue dans votre carnet electronique <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <!-- Ajoutez ici le contenu principal de votre page d'accueil -->
    </main>
    <footer>
        <p>©  Votre Carnet </p>
    </footer>
</body>
</html>
