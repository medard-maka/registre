
<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="dk.css">
</head>
<body>
    
    <form action="ajoutp.php" method="post">
    <h4>Ajouter un Nouveau Produit</h4>
        <label for="nom_produit">Nom du produit:</label>
    <input type="text" id="nom_produit" name="nom_produit" required>

    <label for="prix_produit">Prix du produit ($):</label>
    <input type="number" id="prix_produit" name="prix_produit" step="0.01" required>

    <button type="submit">Ajouter le produit</button>
    <button><a href="page.php">Retour</a></button>
    <br>
    <?php


// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connectez-vous à la base de données
    $conn = new mysqli('localhost', 'root', '', 'vk');

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion: " . $conn->connect_error);
    }

    // Récupérez les données du formulaire
    $nom_produit = $_POST['nom_produit'];
    $prix_produit = $_POST['prix_produit'];

    // Préparez une déclaration SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO produits (nom, prix) VALUES (?, ?)");
    $stmt->bind_param("sd", $nom_produit, $prix_produit);

    // Exécutez la requête
    if ($stmt->execute()) {

        echo "Produit ajouté avec succès!";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermez la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>
</form>


        

    </form>
</body>
</html>
