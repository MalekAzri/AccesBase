<?php
include "autoloader.php";
$_bd = ConnexionBD::getInstance(); //instanciation d'une base de donnee
$id = $_GET['id'] ?? null; // variable pour recuperer l'ID depuis l'URL
if ($id === null) {
    echo "Aucun etudiant selectionne.";
    exit;
}
// Requete simple pour recuperer les details de l'etudiant
$req = "SELECT * FROM student WHERE id = $id";
$rep = $_bd->query($req);
$etudiant = $rep->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Etudiant</title>
</head>
<body>
    <h1>Details de l'etudiant</h1>
    <?php if ($etudiant): ?>
        <p><strong>ID :</strong> <?= $etudiant['id'] ?></p>
        <p><strong>Nom :</strong> <?= $etudiant['name'] ?></p>
        <p><strong>Date de naissance :</strong> <?= $etudiant['birthday'] ?></p>
    <?php else: ?>
        <p style="color:red;">Étudiant introuvable</p>
    <?php endif; ?>
    <a href="index.php">⬅ Retour à la liste</a>
</body>
</html>
