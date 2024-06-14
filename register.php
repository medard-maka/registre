
<?php
session_start(); // Démarrage de la session

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assignez les données du formulaire à des variables
    $username = $_POST['username'];
   
    $password = $_POST['password']; // Vous devriez utiliser une fonction de hachage pour le mot de passe

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'vk');

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion: " . $conn->connect_error);
    }

    // Préparez une déclaration SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom_utilisateur,  mot_de_passe) VALUES (?,?)");
    $stmt->bind_param("ss", $username, $password);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Inscription réussie";
        $_SESSION['username'] = $username;
        header("Location: page.php"); // Redirigez vers la page d'accueil 
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermez la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>
