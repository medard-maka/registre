


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression d'un Client ou d'un Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 30px auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select, input[type="submit"] {
            width: 100%;
            padding: 10px;

            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        form a{
    text-decoration: none;
     width: 90px;
    background-color: #5cb85c;
            color: white;
            
            
}

    </style>
</head>
<body>
    <form action="supprimer.php" method="post">
        
<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=vk', 'root', '');

// Vérifiez si l'action de suppression a été demandée
if(isset($_POST['action'])) {
    // Suppression d'un client
    if($_POST['action'] == 'Supprimer le client' && isset($_POST['client_id'])) {
        $client_id = $_POST['client_id'];

        // Préparez la requête SQL pour supprimer le client
        $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->execute([$client_id]);

        echo "<p>Le client a été supprimé avec succès.</p>";
    }
    // Suppression d'un produit
    elseif($_POST['action'] == 'Supprimer le produit' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Préparez la requête SQL pour supprimer le produit
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
        $stmt->execute([$product_id]);

        echo "<p>Le produit a été supprimé avec succès.</p>";
    }

    // Suppression d'une facture
    elseif($_POST['action'] == 'Supprimer la facture' && isset($_POST['facture_id'])) {
        $facture_id = $_POST['facture_id'];

        // Préparez la requête SQL pour supprimer la facture
        $stmt = $pdo->prepare("DELETE FROM factures WHERE id = ?");
        $stmt->execute([$facture_id]);

        echo "<p>La facture a été supprimée avec succès.</p>";
    }
    // Suppression d'une ligne de facture
    elseif($_POST['action'] == 'Supprimer la ligne de facture' && isset($_POST['ligne_facture_id'])) {
        $ligne_facture_id = $_POST['ligne_facture_id'];

        // Préparez la requête SQL pour supprimer la ligne de facture
        $stmt = $pdo->prepare("DELETE FROM lignes_facture WHERE id = ?");
        $stmt->execute([$ligne_facture_id]);

        echo "<p>La ligne de facture a été supprimée avec succès.</p>";
    }
}
?>
        <label for="clientSelect">Sélectionnez le client à supprimer :</label>
        <select name="client_id" id="clientSelect">
            <!-- Les options des clients seront générées par PHP -->
            <?php
            // Récupérez tous les clients
            $stmt = $pdo->query("SELECT id, nom FROM clients");
            while ($row = $stmt->fetch()) {
                echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['nom']) . "</option>";

            }
            ?>
        </select>
        <input type="submit" name="action" value="Supprimer le client">

        <label for="productSelect">Sélectionnez le produit à supprimer :</label>
        <select name="product_id" id="productSelect">
            <!-- Les options des produits seront générées par PHP -->
            <?php
            // Récupérez tous les produits
            $stmt = $pdo->query("SELECT id, nom FROM produits");
            while ($row = $stmt->fetch()) {
                echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['nom']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="action" value="Supprimer le produit">
                <!-- Votre code existant pour la suppression des clients et des produits -->

                <label for="factureSelect">Sélectionnez la facture à supprimer :</label>
        <select name="facture_id" id="factureSelect">
            <!-- Les options des factures seront générées par PHP -->
            <?php
            // Récupérez toutes les factures
            $stmt = $pdo->query("SELECT id, date_creation FROM factures");
            while ($row = $stmt->fetch()) {
                echo "<option value=\"" . $row['id'] . "\">Facture du " . htmlspecialchars($row['date_creation']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="action" value="Supprimer la facture">


        <label for="ligneFactureSelect">Sélectionnez la ligne de facture à supprimer :</label>
        <select name="ligne_facture_id" id="ligneFactureSelect">
            <!-- Les options des lignes de factures seront générées par PHP -->
            <?php
            // Récupérez toutes les lignes de factures
            $stmt = $pdo->query("SELECT id FROM lignes_facture");
            while ($row = $stmt->fetch()) {
                echo "<option value=\"" . $row['id'] . "\">Ligne de Facture ID: " . htmlspecialchars($row['id']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="action" value="Supprimer la ligne de facture">
        <button><a href="page.php">Retour</a></button>

    </form>
</body>
</html>
