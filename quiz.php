<?php
include 'config.php';

$animeId = $_GET['anime_id'];

$sql = "SELECT * FROM animes WHERE id = $animeId";
$animeResult = $conn->query($sql);
$anime = $animeResult->fetch_assoc();

$sql = "SELECT * FROM questions WHERE anime_id = $animeId";
$questionsResult = $conn->query($sql);

$questions = [];
while ($row = $questionsResult->fetch_assoc()) {
    $questions[] = $row;
}

$sql = "SELECT * FROM participants";
$participantsResult = $conn->query($sql);

$participants = [];
while ($row = $participantsResult->fetch_assoc()) {
    $participants[] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo $anime['title']; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="boostrap5.css">
    
    <script>
        const questions = <?php echo json_encode($questions); ?>;
    </script>
    <script src="quiz.js" defer></script>
</head>


<body>

<style>

body {
      background-image: url("<?php echo $anime['image']; ?>");
      background-repeat: no-repeat;
      background-size: cover;
    }

    .progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
    }
    .progress:after{
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 12px solid #fff;
        position: absolute;
        top: 0;
        left: 0;
    }
    .progress > span{
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
    }
    .progress .progress-left{
        left: 0;
    }
    .progress .progress-bar{
        width: 100%;
        height: 100%;
        background: none;
        border-width: 12px;
        border-style: solid;
        position: absolute;
        top: 0;
    }
    .progress .progress-left .progress-bar{
        left: 100%;
        border-top-right-radius: 80px;
        border-bottom-right-radius: 80px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
    }
    .progress .progress-right{
        right: 0;
    }
    .progress .progress-right .progress-bar{
        left: -100%;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
        animation: loading-1 1.8s linear forwards;
    }
    .progress .progress-value{
        width: 90%;
        height: 90%;
        border-radius: 50%;
        background: #ffffff;
        font-size: 24px;
        color: #d10b4f;
        line-height: 135px;
        text-align: center;
        position: absolute;
        top: 5%;
        left: 5%;
    }
    .progress.blue .progress-bar{
        border-color: #d10b4f;
    }
    .progress.blue .progress-left .progress-bar{
        animation: loading-2 1.5s linear forwards 1.8s;
    }






    @keyframes loading-1{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }
    }
    @keyframes loading-2{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(144deg);
            transform: rotate(144deg);
        }
    }
    @keyframes loading-3{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }
    }
    @keyframes loading-4{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(36deg);
            transform: rotate(36deg);
        }
    }
    @keyframes loading-5{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(126deg);
            transform: rotate(126deg);
        }
    }
    @media only screen and (max-width: 990px){
        .progress{ margin-bottom: 20px; }
}

</style>
<section style="background-color: #ee;" >
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?php echo $anime['image']; ?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h1 class="my-3"><?php echo $anime['title']; ?></h1>
            <p class="text-muted mb-1">Bienvenue au Quiz <b><?php echo $anime['title']; ?></b></p>
            
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="progress blue">
                                <span class="progress-left">
                                <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value" id="timer">10s</div>
                                
                            </div>
                        </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><h3>Question</h3></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <p id="question-text"></p>
                <div id="choices"></div></p>
                <h4 id="correctAnswerDisplay"></h4>
              </div>
            </div>
            <hr>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Participants</span> 
                </p>
                <p class="mb-1" style="font-size: .77rem;">
                    <ul>
                        <?php foreach ($participants as $participant): ?>
                            <li>
                                <strong><?php echo $participant['name']; ?>:</strong>
                                <?php for ($i = 0; $i < count($questions); $i++): ?>
                                    <input type="checkbox" class="participant-checkbox" id="participant-<?php echo $participant['id'] . '-' . $i; ?>" name="participants" value="<?php echo $participant['id']; ?>">
                                    <label for="participant-<?php echo $participant['id'] . '-' . $i; ?>">Q<?php echo $i + 1; ?></label>
                                <?php endfor; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Resultats</span>
                </p>
                <p class="mb-1" style="font-size: .77rem;">
                    <button type="button" onclick="calculateResults()">Show Results</button>
                    <div id="results"></div>
                </p>
                <p>
                   
                </p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




    <script src="script.js"></script>
</body>
</html>


