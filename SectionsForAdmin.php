<?php
include 'autoloader.php';

Admin::initialize(); // Initialiser la classe Admin

$admin = new Admin(1, "Emna", "emna@mail.com", "admin");
$sections = $admin->getSections(); 

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $sections = array_filter($sections, function($section) use ($searchTerm) {
        return stripos($section['designation'], $searchTerm) !== false;
    });
}

if (isset($_POST['action']) && $_POST['action'] == 'deleteSection') {
    $id = $_POST['id'];
    $admin->deleteSection($id);
    header("Location: SectionsForAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Liste des Sections</h2>

    <div class="input-group mb-3">
        <form action="SectionsForAdmin.php" method="POST" class="w-100 d-flex">
            <input type="text" class="form-control me-2" name="search" placeholder="Recherche par désignation">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </form>
    </div>

    <!-- 🔹 Bouton Ajouter une Section -->
    <a href="ajouter_section.php" class="btn btn-success mb-3">Ajouter une Section</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Désignation</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sections as $section): ?>
                <tr>
                    <td><?= $section['id'] ?></td>
                    <td><?= $section['designation'] ?></td>
                    <td><?= $section['description'] ?></td>
                    <td>
                        <a href="voir_sectionAdmin.php?id=<?= $section['id'] ?>" class="btn btn-info">Voir</a>
                        <a href="modifier_section.php?id=<?= $section['id'] ?>" class="btn btn-primary">Modifier</a>
                        <form action="SectionsForAdmin.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="deleteSection">
                            <input type="hidden" name="id" value="<?= $section['id'] ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette section ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="AdminPage.php" class="btn btn-secondary">Retour à la page d'administration</a>
</div>
</body>
</html>
