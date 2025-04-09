<?php
require_once 'Admin.php';

// Instantiate the $admin object outside the POST block
$admin = new Admin(1, "Emna", "emna@mail.com", "admin");
Admin::initialize(); // Initialize the database connection
// Recherche d'étudiant
$students = $admin->getAllStudents(); // Récupérer tous les étudiants au départ
if (isset($_POST['search']) && !empty($_POST['search'])) {
    // Si une recherche est effectuée, filtrer les étudiants par nom
    $searchTerm = $_POST['search'];
    $students = array_filter($students, function($student) use ($searchTerm) {
        return stripos($student['name'], $searchTerm) !== false; // Recherche insensible à la casse
    });
}

switch ($_POST['action'] ?? '') {
    case 'addEtudiant':
        header("location: AjouterEtudiant.php");
        break;

    case 'deleteEtudiant':
        deleteEtudiant($_POST['id']);
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
        $_GET['id'] = $student['id']; // Set the ID for the GET request
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

function deleteEtudiant($id): void {
    global $admin; // Access the global $admin object
    $admin->deleteEtudiant($id);
    echo "Étudiant supprimé avec succès.";
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
                <form action="AdminPage.php" method="POST" class="w-100">
                    <input type="text" class="form-control" name="search" placeholder="Enter Name...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>

        <div class="mb-3">
            <form action="EtudiantExportAll.php" method="POST" class="d-inline">
                <input type="hidden" name="exportCSV" value="csv">
                <button class="btn btn-secondary me-2">Exporter en CSV</button>
            </form>
            <form action="EtudiantExportAll.php" method="POST" class="d-inline">
                <input type="hidden" name="exportExcel" value="xls">
                <button class="btn btn-secondary me-2">Exporter en XLS</button>
            </form>
            <form action="EtudiantExportAll.php" method="POST" class="d-inline">
                <input type="hidden" name="exportPDF" value="pdf">
                <button class="btn btn-secondary me-2">Exporter en PDF</button>
            </form>
        </div>

        <div class="container mt-5">
            <h1 class="mb-4">Liste des Étudiants</h1>
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
                        if (!empty($students)) {
                            foreach ($students as $student) {
                                echo "<tr data-id='{$student['id']}'>
                                    <td>{$student['id']}</td>
                                    <td><img src='{$student['image']}' alt='{$student['name']}' class='student-image'></td>
                                    <td>{$student['name']}</td>
                                    <td>{$student['birthday']}</td>
                                    <td>{$student['section']}</td>
                                    <td class='text-center'>
                                        <a href='voir_etudiant.php?id={$student['id']}' class='btn btn-sm btn-info'><i class='bi bi-info-circle'></i></a>
                                        <a href='modifier_etudiant.php?id={$student['id']}' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                                        <form action='AdminPage.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='action' value='deleteEtudiant'>
                                            <input type='hidden' name='id' value='" . htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8') . "'>
                                            <button type='submit' class='btn btn-sm btn-danger' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');\">
                                                <i class='bi bi-trash'></i>
                                            </button>
                                        </form>
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
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="SectionsForAdmin.php">Next</a></li> <!-- Modified link -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <form action="AjouterEtudiant.php" method="GET" class="d-inline">
        <input type="hidden" name="action" value="addEtudiant">
        <button class="btn btn-success">Ajouter Étudiant</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
