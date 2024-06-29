<?php

include 'config.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'supprime_participant') {
    
   
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete all records from the participants table
    $message = "participant supprimé avec succès.";
    $sql = "DELETE FROM participants";
      if ($conn->query($sql) === TRUE) {
        //echo "Participant ajouté avec succès.";
        echo "<script>window.location.href = document.referrer + '?successMessage=" . urlencode($message) . "';</script>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    if ($conn->query($sql) === TRUE) {
        echo "All participants have been deleted successfully.";
    } else {
        echo "Error deleting participants: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>