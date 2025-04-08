<?php
include_once 'Etudiant.php'; 
$etudiant = new Etudiant(); 
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
    <div class="container mt-4 ">
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
                    <tr>
                        <td>1</td>
                        <td><img src="https://via.placeholder.com/30" alt="Aymen" class="student-image"></td>
                        <td>Aymen</td>
                        <td>1982-02-07</td>
                        <td>GI</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-info"><i class="bi bi-info-circle"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="https://via.placeholder.com/30" alt="Skander" class="student-image"></td>
                        <td>Skander</td>
                        <td>2018-07-11</td>
                        <td>GI</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-info"><i class="bi bi-info-circle"></i></a>
                        </td>
                    </tr>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <tbody>
    <tr>
        <td>1</td>
        <td><img src="https://via.placeholder.com/30" alt="Aymen" class="student-image"></td>
        <td>Aymen</td>
        <td>1982-02-07</td>
        <td>GI</td>
        <td class="text-center">
            <!-- Bouton pour exporter en PDF -->
            <form action="EtudiantExport.php" method="POST" class="d-inline">
                <input type="hidden" name="action" value="exportPDF">
                <input type="hidden" name="id" value="1"> <!-- ID de l'étudiant -->
                <button class="btn btn-sm btn-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</button>
            </form>

            <!-- Bouton pour exporter en Excel -->
            <form action="EtudiantExport.php" method="POST" class="d-inline">
                <input type="hidden" name="action" value="exportExcel">
                <input type="hidden" name="id" value="1"> <!-- ID de l'étudiant -->
                <button class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Excel</button>
            </form>

            <!-- Bouton pour exporter en CSV -->
            <form action="EtudiantExport.php" method="POST" class="d-inline">
                <input type="hidden" name="action" value="exportCSV">
                <input type="hidden" name="id" value="1"> <!-- ID de l'étudiant -->
                <button class="btn btn-sm btn-primary"><i class="bi bi-file-earmark-spreadsheet"></i> CSV</button>
            </form>
        </td>
    </tr>
</tbody>
<?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['viewSections'])) {
                $sections = $etudiant->viewSections(); // Fetch sections
                echo "<ul class='list-group'>";
                foreach ($sections as $section) {
                    echo "<li class='list-group-item'>{$section['name']}</li>";
                }
                echo "</ul>";
            }
            ?>
</body>
</html>