<?php
include "Etudiant.php";

// Initialiser les propriétés statiques de la classe Etudiant
Etudiant::initialize();

// Vérifier si une recherche est effectuée
$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

// Récupérer les étudiants en fonction de la recherche, si une recherche a été effectuée
if (!empty($searchQuery)) {
    $students = Etudiant::$repoEtudiant->findAll(); // On récupère tous les étudiants, la recherche se fait côté affichage
    $students = array_filter($students, function ($student) use ($searchQuery) {
        return stripos($student['name'], $searchQuery) !== false; // Filtrer par nom d'étudiant
    });
} else {
    // Si aucune recherche, on récupère tous les étudiants
    $students = Etudiant::$repoEtudiant->findAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
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
                <form action="EtudiantPage.php" method="POST" class="w-100">
                    <input type="text" class="form-control" name="search" placeholder="Enter Name..." value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>">
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
                        // Afficher les étudiants après filtrage
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
                        <li class="page-item"><a class="page-link" href="SectionsForEtudiant.php">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
