<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

require 'koneksi.php';
require 'Datatables.php';

// Pastikan $connectdb tersedia dari file koneksi.php
if (!isset($connectdb)) {
    echo json_encode(['error' => 'Database connection not available']);
    exit;
}

$dataTables = new Datatables();

$query = "SELECT id_user, username, name FROM users";
$where = null;
$isWhere = null;
$search = ['id_user', 'username', 'name'];



try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    $name = $_POST['name'];
                    $username = $_POST['username'];
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                    $stmt = $connectdb->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
                    $stmt->execute([$username, $password, $name]);

                    echo json_encode(["message" => "User added successfully"]);
                    break;

                case 'edit':
                    $name = $_POST['name'];
                    $username = $_POST['username'];
                    $id_user = $_POST['id'];

                    if (!empty($_POST['password'])) {
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $stmt = $connectdb->prepare("UPDATE users SET username = ?, password = ?, name = ? WHERE id_user = ?");
                        $stmt->execute([$username, $password, $name, $id_user]);
                    } else {
                        $stmt = $connectdb->prepare("UPDATE users SET username = ?, name = ? WHERE id_user = ?");
                        $stmt->execute([$username, $name, $id_user]);
                    }

                    echo json_encode(["message" => "User updated successfully"]);
                    break;

                case 'delete':
                    $id_user = $_POST['id'];

                    $stmt = $connectdb->prepare("DELETE FROM users WHERE id_user = ?");
                    $stmt->execute([$id_user]);

                    echo json_encode(["message" => "User deleted successfully"]);
                    break;

                case 'list':
                    $stmt = $connectdb->prepare($query);
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $totalRecords = count($data);

                    echo json_encode([
                        "draw" => intval($_POST['draw']),
                        "recordsTotal" => $totalRecords,
                        "recordsFiltered" => $totalRecords,
                        "data" => $data
                    ]);
                    break;

                default:
                    echo json_encode(["error" => "Invalid action"]);
                    break;
            }
        } else {
            // DataTables query for retrieving user data (read-only)
            $query = "SELECT id_user, username, name FROM users";
            $where = null; // Tambahkan kondisi WHERE jika diperlukan
            $search_columns = ['id_user', 'username', 'name'];

            $response = $dataTables->getQuery($connectdb, $query, $where, $search_columns);
            echo json_encode($response);
        }
    } else {
        echo json_encode(["error" => "Invalid request method"]);
    }
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
