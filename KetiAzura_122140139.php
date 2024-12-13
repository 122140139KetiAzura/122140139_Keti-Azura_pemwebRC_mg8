<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "example_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query data
$sql = "SELECT * FROM data LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Hitung total data
$total_sql = "SELECT COUNT(*) AS total FROM data";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .pagination {
            margin-top: 10px;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
        }
        .pagination a.active {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Data Table</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>
        <?php
        $row_count = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row_count++;
                echo "<tr>
                        <td>" . ($offset + $row_count) . "</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['alamat']) . "</td>
                    </tr>";
            }
        }
        while ($row_count < 10) {
            echo "<tr><td colspan='3'>&nbsp;</td></tr>";
            $row_count++;
        }
        ?>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>
