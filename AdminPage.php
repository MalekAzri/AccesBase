<?php
require_once 'Admin.php';

// Instantiate the $admin object outside the POST block
Admin::initialize(); // Initialize the database connection and repositories
$admin = new Admin(1, "Emna", "emna@mail.com", "admin"); // Ensure the object is created properly

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addEtudiant':
            $etudiantData = json_decode($_POST['etudiantData'], true);
            $etudiant = new Etudiant($etudiantData['id'], $etudiantData['name'], $etudiantData['email'], $etudiantData['section'], $etudiantData['birthday'], $etudiantData['image']);
            $admin->addEtudiant($etudiant);
            echo "Étudiant ajouté avec succès.";
            break;

        case 'deleteEtudiant':
            $id = $_POST['id'];
            $admin->deleteEtudiant($id);
            echo "Étudiant supprimé avec succès.";
            break;

        case 'getEtudiantById':
            $id = $_POST['id'];
            $etudiant = $admin->getEtudiantById($id);
            if ($etudiant) {
                echo "Informations de l'étudiant : " . json_encode($etudiant);
            } else {
                echo "Étudiant non trouvé.";
            }
            break;

        case 'updateEtudiant':
            $id = $_POST['id'];
            $etudiantData = json_decode($_POST['etudiantData'], true);
            try {
                $admin->updateEtudiant($id, $etudiantData);
                echo "Étudiant mis à jour avec succès.";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            break;

        default:
            echo "Action non reconnue.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .student-image {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Liste des étudiants</h2>
            <div class="input-group w-auto">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-secondary me-2">Copy</button>
            <button class="btn btn-secondary me-2">Excel</button>
            <button class="btn btn-secondary me-2">CSV</button>
            <button class="btn btn-secondary">PDF</button>
        </div>

        <div class="container mt-5">
        <h1 class="mb-4">Liste des Étudiants</h1>
        
        <!-- Tableau des étudiants -->
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Section</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupère tous les étudiants
            $students = $admin->getAllStudents(); 
            if (!empty($students)) {
                foreach ($students as $student) {
                    echo "<tr>
                        <td>{$student['id']}</td>
                        <td><img src='{$student['image']}' alt='{$student['name']}' class='student-image'></td>
                        <td>{$student['name']}</td>
                        <td>{$student['birthday']}</td>
                        <td>{$student['section']}</td>
                        <td class='text-center'>
                            <a href='#' class='btn btn-sm btn-info'><i class='bi bi-info-circle'></i></a>
                            <a href='#' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='#' class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Aucun étudiant trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


        <div class="d-flex justify-content-between align-items-center">
            <div>Showing 1 to 2 of 2 entries</div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    
    <form action="Admin.php" method="POST" class="d-inline">
    <input type="hidden" name="action" value="addEtudiant">
    <input type="hidden" name="etudiantData" value='{"id":3,"name":"John","email":"john@example.com","section":"GI"}'>
    <button class="btn btn-secondary">Ajouter Étudiant</button>
    
    <!-- Supprimer un etudiant-->
<form action="Admin.php" method="POST" class="d-inline">
    <input type="hidden" name="action" value="deleteEtudiant">
    <input type="hidden" name="id" value="1"> <!-- Remplacez 1 par l'ID de l'étudiant à supprimer -->
    <button class="btn btn-sm btn-danger">Supprimer Étudiant</button>
</form>

<!-- avoir les informations d'un etudiant -->
<form action="Admin.php" method="POST" class="d-inline">
    <input type="hidden" name="action" value="getEtudiantById">
    <input type="hidden" name="id" value="1"> <!-- Remplacez 1 par l'ID de l'étudiant à récupérer -->
    <button class="btn btn-sm btn-info">Voir Étudiant</button>
</form>

<!-- mettre à jour un etudiant -->
<form action="Admin.php" method="POST" class="d-inline">
    <input type="hidden" name="action" value="updateEtudiant">
    <input type="hidden" name="id" value="1"> <!-- Remplacez 1 par l'ID de l'étudiant à mettre à jour -->
    <input type="hidden" name="etudiantData" value='{"name":"Updated Name","email":"updated@example.com","section":"Updated Section"}'>
    <button class="btn btn-sm btn-primary">Mettre à jour Étudiant</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
