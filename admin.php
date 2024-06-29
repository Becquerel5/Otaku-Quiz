<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="boostrap5.css">
    <link rel="stylesheet" href="admin_styles.css">
    

    
</head>
<body>

<style>
    .textarea-container {
    width: 80%;
    max-width: 600px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 10px;
}

textarea {
    width: 100%;
    height: 200px;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #ddd;
    resize: vertical; /* Allows vertical resizing only */
    outline: none;
    box-sizing: border-box;
}

textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

textarea::placeholder {
    color: #aaa;
}
</style>

<script>
  // Function to retrieve the value of a query parameter from the URL
  function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  // Retrieve the success message from the URL
  const successMessage = getQueryParam('successMessage');

  // Display the success message in green if it exists
  if (successMessage) {
    const messageElement = document.createElement('p');
    messageElement.textContent = decodeURIComponent(successMessage);
    messageElement.style.color = 'green';
    document.body.appendChild(messageElement);
  }
</script>

<h1>Admin Interface - OTAKU QUIZZ CHAMPION</h1>
    <div class="admin-section">
        <h2>Enregistrer les Participants</h2>
        <form action="admin_process.php" method="post" enctype="multipart/form-data">
            <h3>Ajouter un Participant</h3>
                <input type="text" name="participant_name" placeholder="Nom du participant" required>
                <button type="submit" name="action" value="add_participant">Ajouter</button>
        </form>
            <form action="purger.php" method="post" enctype="multipart/form-data">
                <button class="btn btn-danger" type="submit" name="action" value="supprime_participant">Purger Les Participants</button>
            </form>
        <div id="participants-list"></div>
    </div>

    <div class="admin-section">
        <h2>Enregistrer un Animé</h2>
        <form action="admin_process.php" method="post" enctype="multipart/form-data">
        <h3>Créer un Animé</h3>
                <input type="text" name="anime_title" placeholder="Titre de l'animé" required>
                <input type="text" name="anime_image" placeholder="lien url de l'animé" required>
                <button type="submit" name="action" value="create_anime">Créer</button>
        </form>
        <div id="animes-list"></div>
    </div>

    <div class="admin-section">
        <h2>Ajouter des Questions</h2>
        <form action="admin_process.php" method="post">
            <h3>Ajouter une Question</h3>
                <select name="anime_id" required>
                    <option value="">Sélectionner un animé</option>
                    <?php
                    $sql = "SELECT id, title FROM animes";
                    $result = $conn->query($sql);
                    while ($anime = $result->fetch_assoc()): ?>
                        <option value="<?php echo $anime['id']; ?>"><?php echo $anime['title']; ?></option>
                    <?php endwhile; ?>
                </select>
                <textarea name="question_text" placeholder="Texte de la question" required></textarea><br>
                <select name="question_type" required>
                    <option value="QCU">Question à choix unique</option>
                    <option value="QCM">Question à choix multiple</option>
                </select>
                <input type="text"  name="correct_answer" placeholder="Réponse correcte" required>
                <button type="submit" name="action" value="add_question">Ajouter</button>
        </form>
        
    </div>


    