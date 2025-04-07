<?php
include "autoloader.php";
//requete pour recuperer les etudiants
$_bdd = ConnexionBD::getInstance();
$rep = $_bdd->query("SELECT * FROM student");
$students = $rep->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table class="table table-striped">
        <tr class="table-success">
            <th>ID</th>
            <th>Nom</th>
            <th>Birthday</th>
            <th></th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr class="table-success">
                <td><?= htmlspecialchars($student['id']) ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['birthday']) ?></td>
                <td><a href="detailEtudiant.php?id=<?= $student['id'] ?>">Details</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
