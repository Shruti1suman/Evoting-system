<?php
    require_once("./admin/inc/config.php");
//     This part includes the configuration file to connect to the database.
// It then fetches all rows from the election table.

      $fetchingElections = mysqli_query($db, "SELECT * FROM election") OR die(mysqli_error($db));
      // This loop iterates through each fetched row and extracts the start date, end date, election ID, and current status
      while($data = mysqli_fetch_assoc($fetchingElections))
      {
        $starting_date = $data['start_date'];
        $ending_date = $data['end_date'];
        $election_id = $data['e_id'];
        $status = $data['e_status'];


         //if election is active then after ending date it's status should be expired
        

         if($status == "Active"){
$startDateTime = new DateTime($starting_date, new DateTimeZone('Asia/Kolkata'));
$endDateTime = new DateTime($ending_date, new DateTimeZone('Asia/Kolkata'));

// Current date/time (assuming current server time)
$currentDateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

// Check if current date/time is between start and end dates/times
if ($currentDateTime->getTimestamp() > $endDateTime->getTimestamp()) {
  mysqli_query($db,"UPDATE election SET e_status = 'Expired' WHERE e_id = '". $election_id ."'") OR die(mysqli_error($db));
}
         }

else if($status == "InActive"){
  $startDateTime = new DateTime($starting_date, new DateTimeZone('Asia/Kolkata'));
  $endDateTime = new DateTime($ending_date, new DateTimeZone('Asia/Kolkata'));
  
  // Current date/time (assuming current server time)
  $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
  
  // Check if current date/time is between start and end dates/times
  if ($currentDateTime->getTimestamp() >= $startDateTime->getTimestamp() && $currentDateTime->getTimestamp() <= $endDateTime->getTimestamp()) {
    mysqli_query($db,"UPDATE election SET e_status = 'Active' WHERE e_id = '". $election_id ."'") OR die(mysqli_error($db));
  }
  else if($currentDateTime->getTimestamp() > $endDateTime->getTimestamp()){
    mysqli_query($db,"UPDATE election SET e_status = 'Expired' WHERE e_id = '". $election_id ."'") OR die(mysqli_error($db));
  }
}
      }
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
            <a class="nav-link" href="#about">About Us</a>
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
            <a class="nav-link" href="result.php" style="font-size: 18px;"><button class="btn login_btn">Result</button></a>
          </li>
        </ul>



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


<!-- image cards -->


<div class="container">
  <div class="card">
    <img src="assets/images/Default_india_vote_0.jpg" alt="Image 1">
    
  </div>
  <div class="card">
    <img src="assets/images/elogo.jpeg" alt="Image 2">
    
  </div>
  <div class="card">
    <img src="assets/images/Default_online_voting_system_0.jpg" alt="Image 3">

  </div>
</div>









<div class="section">
            <div class="con">
                <div class="content-section">
                    <div class="title">
                        <h1 id="about">ABOUT US</h1>
                    </div>
                    <div class="content">
                        <h3>Our Mission
                            </h3>
                            <p>At E-Vote Solutions, we are passionate about revolutionizing the democratic process.
                                 Our mission is to empower citizens by providing a secure, transparent, and accessible e-voting platform.
                                  We believe that every voice matters, and our goal is to make voting efficient, reliable, and inclusive.</p>
                                  <h3>Join Us in Shaping Democracy
                                </h3>
                                <p>Whether you’re a voter, a government official, or a concerned citizen, E-Vote Solutions invites you to be part of the digital democracy movement.
                                     Let’s build a future where every vote counts!</p>
                                    
                                
                    </div>
    
                </div>
                <div class="image-section">
                    <img src="assets/images/vlogo.jpeg">
                </div>
            </div>
        </div>




<br>





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



























