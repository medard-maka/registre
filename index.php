
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <h4>Veillez remplir ce formulaire pour vous connecter</h4>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
<br>
<p>Si vous n'avez un compte veillez cliquer sur ce lien:<a href="new.php">Cliquer ici</a></p>
    </form>
</body>
</html>
