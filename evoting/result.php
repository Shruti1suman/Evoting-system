<?php 
    session_start();
    require_once("./admin/inc/config.php");


?>
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





<div class="row my-3">  
    <div class="col-12">
        <h3> Election Results</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Election Name</th>
                    <th scope="col">No Of Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status </th>
                    <th scope="col">Action </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $fetchingData = mysqli_query($db, "SELECT * FROM election") or die(mysqli_error($db)); 
                    $isAnyElectionAdded = mysqli_num_rows($fetchingData);
                     
                    if($isAnyElectionAdded > 0)
                    {
                        $sno = 1;
                        while($row = mysqli_fetch_assoc($fetchingData))
                        {
                          $status = $row['e_status'];
                            $election_id = $row['e_id'];
                            
                            // Query to count the number of candidates with the specified election ID
                          $query = "SELECT COUNT(*) as candidate_count FROM candidate WHERE election_id = '$election_id'";
                          $result = mysqli_query($db, $query) or die(mysqli_error($db));
                
                          if ($result) {
                            $candidate_row = mysqli_fetch_assoc($result);
                            $countCandidate = $candidate_row['candidate_count'];
                        } else {
                            $countCandidate = 0;
                        }
                                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $row['e_topic']; ?></td>
                                <td><?php echo $countCandidate; ?></td>
                                <td><?php echo $row['start_date']; ?></td>
                                <td><?php echo $row['end_date']; ?></td>
                                <td><?php echo $row['e_status']; ?></td>

                             <?php
                             if($status == "Expired"){
                              ?>
                                <td>
                              <a href="config.php?viewResult=<?php echo $election_id; ?>" class="btn btn-sm btn-success"> View Results </a>  </td>
                              <?php
                             }
                
                               else if($status == "Active"){
                                ?>
                                <td>No result published</td>
                                <?php

                               }   
                               else{
                                ?>
                                <td>Election is not started</td>
                                <?php
                               }
                               ?> 
                                 
                              
                            </tr>
                <?php
                        }
                    }else {
            ?>
                        <tr> 
                            <td colspan="7"><h3> No Upcoming Election </h3></td>
                        </tr>
            <?php
                    }
                ?>
            </tbody>    
        </table>
    </div>
</div>






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


