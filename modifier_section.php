<?php
include 'autoloader.php';

Admin::initialize();
$admin = new Admin(1, "Emna", "emna@mail.com", "admin");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $section = $admin->getSectionById($id);
    if ($section) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'designation' => $_POST['designation'],
                'description' => $_POST['description']
            ];
            $admin->updateSection($id, $data);
            echo "<p>Section mise à jour avec succès.</p>";
        }
        ?>
        <h2>Modifier la Section</h2>
        <form action="modifier_section.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $section['designation']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $section['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <?php
    } else {
        echo "<p>Section non trouvée.</p>";
    }
} else {
    echo "<p>ID de la section manquant.</p>";
}
?>

<a href="SectionsForAdmin.php" class="btn btn-secondary">Retour à la liste des sections</a>
