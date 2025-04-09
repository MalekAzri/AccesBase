<?php
require_once 'Admin.php';

// Créez une instance de la classe Admin
Admin::initialize();
$admin = new Admin(1, "Emna", "emna@mail.com", "admin");

if (isset($_GET['add']) && $_SERVER['REQUEST_METHOD'] === 'GET' ) {

        $etudiant = new Etudiant(
            $_GET['id'] , // ID de l'étudiant 
            $_GET['name'], // Nom de l'étudiant                 
            $_GET['email'], // Email de l'étudiant
            $_GET['birthday'], // Date de naissance
            $_GET['image'], // Chemin de l'image
            $_GET['section'] // Section de l'étudiant
        );
        $admin->addEtudiant($etudiant);
        echo "Étudiant ajouté avec succès.";
        header("Location: AdminPage.php"); // Redirige vers la page d'administration après l'ajout
    } 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <div class="container mt-4">
        <h2>Ajouter un nouvel étudiant</h2>
        <form action="AjouterEtudiant.php" method="GET" enctype="multipart/form-data" onsubmit="return validateForm()">

            <div class="mb-3">
                <label for="id" class="form-label">ID de l'étudiant</label>
                <input type="number" class="form-control" id="id" name="id" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" required>
            </div>

            <div class="mb-3">
                <label for="birthday" class="form-label">Date de naissance</label>
                <input type="text" class="form-control" id="birthday" name="birthday" placeholder="YYYY-MM-DD" required>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">URL de l'image</label>
                <input type="text" class="form-control" id="image_url" name="image" required>
            </div>

            <input type="hidden" name="add" id="etudiantData">
            <button type="submit" class="btn btn-primary">Ajouter Étudiant</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
