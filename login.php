<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start(); // Démarrage de la session

    // Vérifiez si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assignez les données du formulaire à des variables
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', '', 'vk');

        // Vérifiez la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion: " . $conn->connect_error);
        }

        // Préparez une déclaration SQL pour éviter les injections SQL
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = ? AND mot_de_passe = ?");
        $stmt->bind_param("ss", $username, $password);

        // Exécutez la requête
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifiez si l'utilisateur existe
        if ($result->num_rows > 0) {
            // L'utilisateur existe, créez des variables de session
            $_SESSION['username'] = $username;
            header("Location: page.php"); // Redirigez vers la page d'accueil
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect";
        }

        // Fermez la déclaration et la connexion
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>