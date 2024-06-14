
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
    <title>Ajouter un Client</title>
    <link rel="stylesheet" href="dk.css">
</head>
<body>
    
    <form  action="ajout.php" method="post">
    <h4>Ajouter un Nouveau Client</h4>

   
    <label for="nom_client">Nom du client:</label>
    <input type="text" id="nom_client" name="nom_client" required>

    <label for="adresse_client">Adresse:</label>
    <input type="text" id="adresse_client" name="adresse_client">

    
    <button type="submit">Ajouter le client</button>
    <button><a href="page.php">Retour</a></button>
    
    <br>
    <?php
// Assurez-vous que l'utilisateur est connecté


// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $nom_client = $_POST['nom_client'];
    $adresse_client = $_POST['adresse_client'];
    

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'vk');

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion: " . $conn->connect_error);
    }

    // Préparez une déclaration SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO clients (nom, adresse) VALUES (?, ?)");
    $stmt->bind_param("ss", $nom_client, $adresse_client);


    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Client ajouté avec succès!";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermez la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>


</form>



   
</body>
</html>
