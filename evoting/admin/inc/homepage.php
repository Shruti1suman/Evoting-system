
<div class="row my-3">  
    <div class="col-12">
        <h3>Elections</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Election Name</th>
                    <th scope="col">No Of Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status </th>
                    
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



