<?php 
    require_once("inc/header.php");
    require_once("inc/navigation.php");
?>




<div class="row my-3">
        <div class="col-12">
            <h3> Voters Panel </h3>

            <?php 
                $fetchingActiveElections = mysqli_query($db, "SELECT * FROM election WHERE e_status = 'Active'") or die(mysqli_error($db));
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
                                    <th colspan="4" class="bg-black text-white"><h5> ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5></th>
                                </tr>
                                <tr>
                                    <th> Photo </th>
                                    <th> Candidate Name </th>
                                    <th> Candidate Details </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));

                                while($candidateData = mysqli_fetch_assoc($fetchingCandidates))
                                {
                                    $candidate_id = $candidateData['c_id'];
                                    $candidate_photo = $candidateData['c_photo'];

                                    // Fetching Candidate Votes 
                                    $fetchingVotes = mysqli_query($db, "SELECT * FROM vote WHERE c_id = '". $candidate_id . "'") or die(mysqli_error($db));
                                    $totalVotes = mysqli_num_rows($fetchingVotes);

                            ?>
                                    <tr>
                                        <td> <img src="<?php echo $candidate_photo; ?>" class="candidate_photo"> </td>
                                        <td><?php echo "<b>" . $candidateData['c_name'] . "</b>";?></td>
                                        <td><?php echo $candidateData['c_details']; ?></td>
                                        <td>
                                            <!-- vote button -->
                        
                                    <?php
                                            $checkIfVoteCasted = mysqli_query($db, "SELECT * FROM vote WHERE v_id = '". $_SESSION['user_id'] ."' AND e_id = '". $election_id ."'") or die(mysqli_error($db));    
                                            $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);

                                            if($isVoteCasted > 0)
                                            {
                                                $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                                $voteCastedToCandidate = $voteCastedData['c_id'];

                                                if($voteCastedToCandidate == $candidate_id)
                                                {
                                    ?>

                                                    <img src="../assets/images/vote.png" width="100px;">
                                    <?php
                                                }
                                            }else {
                                    ?>
                                                <button class="btn btn-md btn-success" onclick="CastVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> Vote </button>
                                    <?php
                                            }

                                            
                                    ?>


                                    </td>
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



    <script>
    const CastVote = (election_id, customer_id, voters_id) => 
    {
        $.ajax({
            type: "POST", 
            url: "inc/ajaxCalls.php",
            data: "e_id=" + election_id + "&c_id=" + customer_id + "&v_id=" + voters_id, 
            success: function(response) {
                
                if(response == "Success")
                {
                    location.assign("index.php?voteCasted=1");
                }else {
                    location.assign("index.php?voteNotCasted=1");
                }
            }
        });
    }

</script>









<?php
    require_once("inc/footer.php");
?>