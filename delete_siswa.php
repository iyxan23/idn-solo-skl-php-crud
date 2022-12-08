<?php
$host       = "localhost:3306";
$user       = "root";
$password   = "";
$db         = "siswa";

$conn       = mysqli_connect($host, $user, $password, $db);

if ($conn->connect_errno) {
    echo `<script>location.href = "./?status=failed&type=delete&error=`. $conn->connect_error .`";</script>`;
    die("MySQL connection failed: " . $conn->connect_error);
}

$id         = $_REQUEST["id"];
$sql        = "DELETE FROM data WHERE data.id = $id";

$result = $conn->query($sql);

if (!$result) {
    echo '<script>location.href = "./?status=failed&type=delete&error='. $result->errno .'";</script>';
    die("Failed to delete id $id");
}
?>

<script>
    location.href = "./?status=success&type=delete";
</script>