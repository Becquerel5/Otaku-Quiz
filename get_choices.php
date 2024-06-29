<?php
include 'config.php';

$questionId = $_GET['question_id'];
$sql = "SELECT * FROM choices WHERE question_id = $questionId";
$result = $conn->query($sql);

$choices = [];
while ($row = $result->fetch_assoc()) {
    $choices[] = $row;
}

echo json_encode($choices);
$conn->close();
?>