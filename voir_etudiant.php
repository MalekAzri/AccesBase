<?php
require_once 'Admin.php';

// Vérifier si l'ID de l'étudiant est passé en paramètre dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    Admin::initialize(); // Initialiser la connexion à la base de données
    $admin = new Admin(1, "Emna", "emna@mail.com", "admin"); // Créer l'objet admin

    // Récupérer les informations de l'étudiant par ID
    $etudiant = $admin->getEtudiantById($id);

    if ($etudiant) {
        // Afficher les informations de l'étudiant
        echo "<h1>Informations de l'étudiant</h1>";
        echo "<p><strong>ID:</strong> {$etudiant['id']}</p>";
        echo "<p><strong>Nom:</strong> {$etudiant['name']}</p>";
        echo "<p><strong>Email:</strong> {$etudiant['email']}</p>";
        echo "<p><strong>Section:</strong> {$etudiant['section']}</p>";
        echo "<p><strong>Date de naissance:</strong> {$etudiant['birthday']}</p>";
        echo "<p><strong>Image:</strong><br><img src='{$etudiant['image']}' alt='{$etudiant['name']}' class='student-image'></p>";
    } else {
        echo "<p>Étudiant non trouvé.</p>";
    }
} else {
    echo "<p>Paramètre 'id' manquant ou invalide.</p>";
}
?>
