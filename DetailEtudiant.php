<?php
include "autoloader.php";
$_bd = ConnexionBD::getInstance(); //instanciation d'une base de donnee
$id = $_GET['id'] ?? null; // variable pour recuperer l'ID depuis l'URL
if ($id === null) {
    echo "Aucun etudiant selectionne.";
    exit;
}
// Requete pour recuperer les details de l'etudiant
$req = $_bd->prepare("SELECT * FROM student WHERE id = ?");
$req->execute([$id]);
$etudiant = $req->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    echo "Étudiant non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Etudiant</title>
</head>
<body>
    <h1>Details de l'etudiant</h1>
    <p><strong>ID :</strong> <?= $etudiant['id'] ?></p>
    <p><strong>Nom :</strong> <?= $etudiant['name'] ?></p>
    <p><strong>Date de naissance :</strong> <?= $etudiant['birthday'] ?></p>

    <a href="index.php">⬅ Retour à la liste</a>
</body>
</html>
