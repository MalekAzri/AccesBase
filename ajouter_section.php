<?php
include 'autoloader.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Admin::initialize();
    $admin = new Admin(1, "Emna", "emna@mail.com", "admin");

    $data = [
        'id' => $_POST['id'], 
        'designation' => $_POST['designation'],
        'description' => $_POST['description']
    ];

    
    $admin->addSection($data);
    header('Location: SectionsForAdmin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Ajouter une Nouvelle Section</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="ajouter_section.php">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" required>
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">Désignation</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="SectionsForAdmin.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
