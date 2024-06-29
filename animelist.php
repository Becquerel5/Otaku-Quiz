<?php
include 'config.php';

$sql = "SELECT id, title FROM animes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Animés</title>
    <link rel="stylesheet" href="boostrap5.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="container">
<style>
    body {
            background-image: url("images/multianime2.jpg");
           
            }
</style>

<br><br><br>
           <center> <h1  style="color:white;">LISTE D'ANIMÉS</h1></center>
            <?php if ($result->num_rows > 0): ?>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><a class="btn btn-primary" href="quiz.php?anime_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h5>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php else: ?>
  <li>Aucun animé disponible.</li>
<?php endif; ?>


                
            </ul>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>