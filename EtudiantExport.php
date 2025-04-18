 <?php
include "autoloader.php";

$admin = new Admin(1, "Emna", "emna@mail.com", "admin"); 
Admin::initialize(); // Initialize the database connection and repositories
$admin = new Admin(1, "Emna", "emna@mail.com", "admin"); // Ensure the object is created properly

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['id']; // ID de l'étudiant
    $etudiantData = $admin->getEtudiantById($id); // Récupère les données de l'étudiant

    if (!$etudiantData) {
        echo "Étudiant non trouvé.";
        exit;
    }

    switch ($_POST['action']) {
        case 'exportPDF':
            exportToPDF($etudiantData);
            break;

        case 'exportExcel':
            exportToExcel($etudiantData);
            break;

        case 'exportCSV':
            exportToCSV($etudiantData);
            break;

        default:
            echo "Action non reconnue.";
    }
}

function exportToPDF($data) {
    // Utilisez une bibliothèque comme FPDF ou TCPDF pour générer un PDF
    require_once 'fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Informations de l\'étudiant');
    $pdf->Ln();
    foreach ($data as $key => $value) {
        $pdf->Cell(40, 10, ucfirst($key) . ': ' . $value);
        $pdf->Ln();
    }
    $pdf->Output('D', 'etudiant_' . $data['id'] . '.pdf'); // Téléchargement direct
}

function exportToExcel($data) {
    // Génération d'un fichier Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=etudiant_" . $data['id'] . ".xls");
    echo "ID\tName\tEmail\tBirthday\tImage\tSection\n";
    echo "{$data['id']}\t{$data['name']}\t{$data['email']}\t{$data['birthday']}\t{$data['image']}\t{$data['section']}\n";
}

function exportToCSV($data) {
    // Génération d'un fichier CSV
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=etudiant_" . $data['id'] . ".csv");
    $output = fopen("php://output", "w");
    fputcsv($output, array_keys($data)); // En-têtes
    fputcsv($output, $data); // Données
    fclose($output);
}
?>