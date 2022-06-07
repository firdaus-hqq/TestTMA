<?php
require_once "koneksi.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}
function get_mahasiswa()
{
    global $connect;
    $query = $connect->query("CALL tabelMahasiswa()");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Success',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}