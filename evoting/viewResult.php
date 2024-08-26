
<!doctype html>
<html lang="en">
  <head>
    <title>Evoting</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />


    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <header>
      <!-- place navbar here -->
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <!-- Logo as an image -->
      <a class="navbar-brand" href="#">
        <img src="assets/images/vlogo.jpeg" alt="Logo" style="height: 40px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact Us</a>
          </li>
        </ul>
        <!-- Centered Evoting link -->
        <ul class="navbar-nav mx-auto"> </ul>
        <!-- Login link aligned to the right -->
        
 


     
        


        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="login.php" style="font-size: 18px;"><button class="btn login_btn">Login</button></a>
          </li>
        </ul>
        
        
      </div>
    </div>
  </nav>
    </header>
    <main>
    <h1>Result Page</h1>




    <?php
       $election_id = $_GET['viewResult'];

  ?>  

  <?php
   $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));

       //  storing total votes for each candidate
             $totalVotes = array();
             $totalVotesCount = 0;

            while($candidateData = mysqli_fetch_assoc($fetchingCandidates))
            {
               $candidate_id = $candidateData['c_id'];
               $fetchingVotes = mysqli_query($db, "SELECT * FROM vote WHERE c_id = '$candidate_id'") or die(mysqli_error($db));
                $votes = mysqli_num_rows($fetchingVotes);
                $totalVotes[$candidate_id] = $votes;
                $totalVotesCount += $votes;

            // Fetching Candidate Votes 
          $fetchingVotes = mysqli_query($db, "SELECT * FROM vote WHERE c_id = '". $candidate_id . "'") or die(mysqli_error($db));
          $totalVotes[$candidate_id] = mysqli_num_rows($fetchingVotes);
            }
          // Find the candidate with the maximum total votes
          if(empty($totalVotes)){
            $maxVotes=0;
          }
          else{
                                      $maxVotes = max($totalVotes);
                                      $maxCandidateId = array_search($maxVotes, $totalVotes);


                               if ($maxCandidateId == false) {
                                echo "No votes found.";
                                  } 
                                }


                                function hasDuplicates($array) {
                                  return count($array) !== count(array_unique($array));
                              }
?>   


<div class="row my-3">
        <div class="col-12">
        

            <?php 
            
                $fetchingActiveElections = mysqli_query($db, "SELECT * FROM election WHERE e_id = '".$election_id."'") or die(mysqli_error($db));
                $totalActiveElections = mysqli_num_rows($fetchingActiveElections);

                if($totalActiveElections > 0) 
                {
                    while($data = mysqli_fetch_assoc($fetchingActiveElections))
                    {
                        $election_id = $data['e_id'];
                        $election_topic = $data['e_topic'];    
                ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="6" class="bg-black text-white"><h5> ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5></th>
                                </tr>
                                <tr>
                                    <th> Photo </th>
                                    <th> Candidate Name </th>
                                    <th> Candidate Details </th>
                                    <th> Result </th> 
                                    <th> Total votes </th> 
                                    <th> Vote percent </th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));

                                while($candidateData = mysqli_fetch_assoc($fetchingCandidates))
                                {
                                    $candidate_id = $candidateData['c_id'];
                                    $candidate_photo = $candidateData['c_photo'];
                                    $candidate_votes = $totalVotes[$candidate_id] ?? 0;
                                    $vote_percentage = $totalVotesCount > 0 ? ($candidate_votes / $totalVotesCount) * 100 : 0;
                                    ?>

                                    <tr>
                                        <td> <img src="assets/<?php echo $candidate_photo; ?>" class="candidate_photo"> </td>
                                        <td><?php echo "<b>" . $candidateData['c_name'] . "</b>";?></td>
                                        <td><?php echo $candidateData['c_details']; ?></td>
                                        <?php

                                        if($totalVotesCount == 0){
                                          ?>
                                          <td>No votes found</td>
                                          <?php
                                        }
                                        else{
                                          if (hasDuplicates($totalVotes)) {
                                            ?>
                                            <td>Election result is tied</td>
                                            <?php
                                          }
                                       else if( $candidate_id ==  $maxCandidateId){
                                        ?>
                                        <td> <img src="./assets/images/winner.webp" width="100px;"></td>
                                        <?php
                                       }
                                       else if($maxVotes == 0){
                                        ?>
                                        <td>no votes found</td>
                                        <?php
                                       }
                                        else{
                                            ?>
                                            <td> <img src="./assets/images/loser.png" width="100px;"></td>
                                            <?php
                                        }
                                      }
                                        ?>
                
                                        <td><?php echo $totalVotes[$candidate_id] ?? 0;?></td>
                                        <td><?php  echo number_format($vote_percentage, 2); ?>%</td>
                                    </tr>
                            <?php
                                }
                            ?>
                            </tbody>

                        </table>
                <?php
                    
                    }
                }else {
                    echo "No any active election.";
                }
            ?>

            
        </div>
    </div>



<section class="contact">
        <div class="cont">
            <h2 id="contact">CONTACT US</h2>
            <div class="contact-wrapper">
                <div class="contact-form">
                    <h3>send us message</h3>
                    <form action="https://api.web3forms.com/submit" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="access_key" value="312fda9f-b783-4ad6-b988-7e397499114d">
                        </div>

                        <div class="form-group">
                            <input type="text" name="name" placeholder="your name" required>
                        </div>
                        

                        <div class="form-group">
                            <input type="email" name="email" placeholder="your email" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="your message" required></textarea>
                        </div>
                        <button type="submit">send message</button>

                    </form>
                </div>
                <div class="contact-info">
                    <h3>contact information</h3>
                    
                    <p><b>PHONE NO:</b> +91 9263578272</p>
                    <p><B>EMAIL:</B> shivangibhadani55@gmail.com</p>
                    <p><B>ADDRESS:</B> cusat,kochi</p>
                </div>
            </div>
        </div>
    </section>
    <br>
    



    </main>

    <footer>
       <!-- place footer here -->
<div  style="  text-align: center;
  bottom: 0;  
  width: 100%; 
  background-color: black;  
  color: white;"     >
  <p style="font-size: 24px; margin-bottom: 10px;">Evoting</p>
  <div class="footer-links" style="margin-bottom: 20px;">
    <a href="index.php">HOME</a>
    <a href="#about">ABOUT</a>
    <a href="#contact">CONTACT</a>
  </div>
  <p style="margin-top: 20px;">Copyright ©2024 All rights reserved | Made with ❤ by Evoting Team</p>
</div>



    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>



























