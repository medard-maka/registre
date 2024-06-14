




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélectionnez un Client</title>
    <link rel="stylesheet" href="kap.css">
</head>
<body>
    <form action="affichage.php" method="get">
    <?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=vk', 'root', '');

// Vérifiez si un client a été sélectionné
if(isset($_GET['id_client'])) {
    $id_client = $_GET['id_client'];

    // Préparez la requête SQL pour récupérer les informations du client et ses commandes
    $stmt = $pdo->prepare("
        SELECT c.nom AS client_nom, 
               c.adresse AS client_adresse, 
               f.id AS facture_id, 
               f.date_creation, 
               p.nom AS produit_nom, 
               lf.quantite, 
               p.prix,
               (lf.quantite * p.prix) AS total_prix_produit
        FROM clients c
        JOIN factures f ON c.id = f.client_id
        JOIN lignes_facture lf ON f.id = lf.facture_id
        JOIN produits p ON lf.produit_id = p.id
        WHERE c.id = ?
        GROUP BY lf.id
    ");
    $stmt->execute([$id_client]);

    // Affichez les informations du client et les détails de ses commandes

    while($ligne = $stmt->fetch()) {
        echo "<h2>Client : " . htmlspecialchars($ligne['client_nom']) . "</h2>";
        echo "<h3>Facture ID : " . htmlspecialchars($ligne['facture_id']) . "</h3>";
        echo "<p>Adresse : " . htmlspecialchars($ligne['client_adresse']) . "</p>";
        echo "<p>Date de création : " . htmlspecialchars($ligne['date_creation']) . "</p>";
        echo "<p>Produit : " . htmlspecialchars($ligne['produit_nom']) . "</p>";
        echo "<p>Quantité : " . htmlspecialchars($ligne['quantite']) . "</p>";
        echo "<p>Prix unitaire : " . htmlspecialchars($ligne['prix']) . " $</p>";
        echo "<p>Prix total pour ce produit : " . htmlspecialchars($ligne['total_prix_produit']) . " $</p>";
    }
} else {
    echo "<p>Veuillez sélectionner un client.</p>";
}
?>

        <label for="client">Choisissez un client :</label>
        <select name="id_client" id="client">
            <?php
            // Connexion à la base de données
            $pdo = new PDO('mysql:host=localhost;dbname=vk', 'root', '');

            // Récupérez tous les clients
            $stmt = $pdo->query("SELECT id, nom FROM clients");
            while ($row = $stmt->fetch()) {
                echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['nom']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Afficher les informations">
        <button><a href="page.php">Retour</a></button>
    </form>
</body>
</html>

