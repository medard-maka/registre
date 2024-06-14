<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'vk');

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Récupérez tous les clients de la base de données
$result = $conn->query("SELECT id, nom FROM clients");

// Vérifiez si le formulaire a été soumis pour créer une facture
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $client_id = $_POST['client_id'];
    $date_facture = $_POST['date_facture'];

    // Préparez une déclaration SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO factures (client_id, date_creation) VALUES (?, ?)");
    $stmt->bind_param("is", $client_id, $date_facture);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Facture créée avec succès!";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermez la déclaration et la connexion
    $stmt->close();
}

// Fermez la connexion à la base de données
$conn->close();
?>
<?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['nom']); ?>

                    </option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>
