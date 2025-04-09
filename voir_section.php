<?php
include 'autoloader.php';

Admin::initialize();
$admin = new Admin(1, "Emna", "emna@mail.com", "admin");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $section = $admin->getSectionById($id);
    if ($section) {
        echo "<h2>Détails de la Section</h2>";
        echo "<p><strong>ID:</strong> {$section['id']}</p>";
        echo "<p><strong>Designation:</strong> {$section['designation']}</p>";
        echo "<p><strong>Description:</strong> {$section['description']}</p>";
    } else {
        echo "<p>Section non trouvée.</p>";
    }
} else {
    echo "<p>ID de la section manquant.</p>";
}
?>

<a href="SectionsForAdmin.php" class="btn btn-secondary">Retour à la liste des sections</a>
