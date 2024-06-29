<?php
include 'config.php';

$action = $_POST['action'];

if ($action == 'add_participant') {
    $name = $_POST['participant_name'];
    $message = "participant créé avec succès.";
    $sql = "INSERT INTO participants (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        //echo "Participant ajouté avec succès.";
        echo "<script>window.location.href = document.referrer + '?successMessage=" . urlencode($message) . "';</script>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == 'create_anime') {
    $title = $_POST['anime_title'];
    $image = $_POST['anime_image'];
    $message = "animé créé avec succès.";
    
    
        $sql = "INSERT INTO animes (title, image) VALUES ('$title', '$image')";
        if ($conn->query($sql) === TRUE) {
           // echo "Animé créé avec succès.";
            echo "<script>window.location.href = document.referrer + '?successMessage=" . urlencode($message) . "';</script>";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    
} elseif ($action == 'add_question') {
    $animeId = $_POST['anime_id'];
    $questionText = $_POST['question_text'];
    $questionType = $_POST['question_type'];
    $correctAnswer = $_POST['correct_answer'];
    $message = "Questions créé avec succès.";
    
    $sql = "INSERT INTO questions (anime_id, question_text, question_type, correct_answer) VALUES ($animeId, '$questionText', '$questionType', '$correctAnswer')";
    if ($conn->query($sql) === TRUE) {
        //echo "Question ajoutée avec succès.";
        echo "<script>window.location.href = document.referrer + '?successMessage=" . urlencode($message) . "';</script>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<a href="admin.php">Retour à l'administration</a>