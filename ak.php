
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'vk');

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Récupérez tous les produits de la base de données
$result_produits = $conn->query("SELECT id, nom FROM produits");

// Récupérez toutes les factures de la base de données
$result_factures = $conn->query("SELECT id FROM factures");

// Fermez la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Ligne Facture</title>
    <!-- Assurez-vous d'inclure votre fichier CSS ici -->
    <link rel="stylesheet" href="dk.css">
</head>
<body>
    <form action="ak.php" method="post">
        <label for="facture_id">Sélectionnez une Facture:</label>
        <select id="facture_id" name="facture_id" required>
            <?php if ($result_factures->num_rows > 0): ?>
                <?php while($row = $result_factures->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        Facture <?php echo $row['id']; ?>
                    </option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>

        <label for="produit_id">Sélectionnez un Produit:</label>
        <select id="produit_id" name="produit_id" required>
            <?php if ($result_produits->num_rows > 0): ?>
                <?php while($row = $result_produits->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['nom']); ?>
                    </option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>


        <label for="quantite">Quantité:</label>
        <input type="number" id="quantite" name="quantite" required>

        <button type="submit">Ajouter à la Facture</button>
        <button><a href="page.php">Retour</a></button>
        <br>
        <?php


// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $facture_id = $_POST['facture_id']; // L'ID de la facture
    $produit_id = $_POST['produit_id']; // L'ID du produit
    $quantite = $_POST['quantite']; // La quantité du produit

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'vk');

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion: " . $conn->connect_error);
    }

    // Préparez une déclaration SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO lignes_facture (facture_id, produit_id, quantite) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $facture_id, $produit_id, $quantite);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Ligne de facture ajoutée avec succès!";
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
