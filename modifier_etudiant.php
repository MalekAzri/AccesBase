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
        // Afficher le formulaire de modification avec les informations actuelles
        ?>
        <h1>Modifier les informations de l'étudiant</h1>
        <form action="modifier_etudiant.php?id=<?= $id ?>" method="POST">
            <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
            
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $etudiant['name'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $etudiant['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" value="<?= $etudiant['section'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="birthday" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $etudiant['birthday'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <?php
    } else {
        echo "<p>Étudiant non trouvé.</p>";
    }
} else {
    echo "<p>Paramètre 'id' manquant ou invalide. Veuillez fournir un ID valide d'étudiant dans l'URL.</p>";
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $section = $_POST['section'];
    $birthday = $_POST['birthday'];

    // Vérifier si l'étudiant existe toujours avant de procéder à la mise à jour
    $etudiant = $admin->getEtudiantById($id); // Récupérer l'étudiant par son ID

    if (!$etudiant) {
        echo "<p>Étudiant non trouvé pour la mise à jour.</p>";
        exit;
    }

    // Mettre à jour les informations de l'étudiant sans modification de l'image
    try {
        $etudiantData = [
            'name' => $name,
            'email' => $email,
            'section' => $section,
            'birthday' => $birthday
        ];
        $admin->updateEtudiant($id, $etudiantData);  // Cette méthode doit exister dans la classe Admin
        echo "<p>Les informations de l'étudiant ont été mises à jour avec succès.</p>";
    } catch (Exception $e) {
        echo "<p>Erreur: " . $e->getMessage() . "</p>";
    }
}
?>
