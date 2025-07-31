<?php
session_start();
require_once 'db/conn.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['string_id']);
    $sql = "DELETE FROM string_info WHERE string_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Record with ID $id deleted successfully!";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM string_info";
$result = mysqli_query($conn, $sql);

echo "<h3>All Records</h3>";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['string_id'] . " - Message: " . htmlspecialchars($row['message']) . "<br>";
    }
} else {
    echo "No records found.";
}
?>

<form method="POST">
    <input type="number" name="string_id" placeholder="Enter ID to delete" required>
    <button type="submit" name="delete">Delete</button>
</form>

</body>
</html>
