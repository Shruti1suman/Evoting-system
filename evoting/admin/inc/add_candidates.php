
<!-- alert -->
<?php 
    if(isset($_GET['added']))
    {
?>
        <div class="alert alert-success my-3" role="alert">
        Candidate has been added successfully
        </div>  
<?php 
    }else if(isset($_GET['largeFile'])) {
?>
        <div class="alert alert-danger my-3" role="alert">
           Image size is too large(Required size < 10MB)
        </div>

 <?php
    }else if(isset($_GET['invalidFile']))
    {
?>
        <div class="alert alert-danger my-3" role="alert">
            Invalid image type (Only .jpg, .png files are allowed) .
        </div>

<?php
    }else if(isset($_GET['failed']))
    {
?>
        <div class="alert alert-danger my-3" role="alert">
            Image uploading failed, please try again
        </div>


<?php
}
else if(isset($_GET['delete_id']))
{
    $d_id = mysqli_real_escape_string($db, $_GET['delete_id']);
    $query = "DELETE FROM candidate WHERE c_id = '$d_id'";
    if (mysqli_query($db, $query)) {
        echo "<div class='alert alert-danger my-3' role='alert'>Candidate has been deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger my-3' role='alert'>Error deleting candidate: " . mysqli_error($db) . "</div>";
    }

}

?>
    


<div class="row my-3">
    <div class="col-4">
        <h3>Add New Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="election_id" required> 
                    <option value=""> Select Election </option>
                    <?php 
                        $fetchingElections = mysqli_query($db, "SELECT * FROM election") OR die(mysqli_error($db));
                        $isAnyElectionAdded = mysqli_num_rows($fetchingElections);
                        if($isAnyElectionAdded > 0)
                        {
                            while($row = mysqli_fetch_assoc($fetchingElections))
                            {
                                $election_id = $row['e_id'];
                                $election_name = $row['e_topic'];
                                $allowed_candidates = $row['no_of_candidates'];

                                // // Now checking how many candidates are added in this election 
                                $fetchingCandidate = mysqli_query($db, "SELECT * FROM candidate WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));
                                $added_candidates = mysqli_num_rows($fetchingCandidate);


                                //if otherwise else empty
                                if($added_candidates < $allowed_candidates)
                                {
                        ?>
                                <option value="<?php echo $election_id; ?>"><?php echo $election_name; ?></option>
                        <?php
                                }
                            }
                        }else {
                    ?>
                            <option value=""> Please add election first </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="cp">Candidate Photo</label>
                <input type="file" id="cp" name="candidate_photo" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required />
            </div>
            <input type="submit" value="Add Candidate" name="addCandidateBtn" class="btn btn-success" />
        </form>
    </div>   

    <div class="col-8">
        <h3>Candidate Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Details</th>
                    <th scope="col">Election</th>
                    <th scope="col">Action </th>
                    
                </tr>
            </thead>
            <tbody>

            <?php  
            
            $fetchingData = mysqli_query($db, "SELECT * FROM candidate") or die(mysqli_error($db)); 
                    $isAnyCandidateAdded = mysqli_num_rows($fetchingData);
                    
                    if($isAnyCandidateAdded > 0)
                    {
                        $sno = 1;
                        while($row = mysqli_fetch_assoc($fetchingData))
                        {
                           
                            $election_id = $row['election_id'];
                            $fetchingElectionName = mysqli_query($db, "SELECT * FROM election WHERE e_id = '". $election_id ."'") or die(mysqli_error($db));
                            $execFetchingElectionNameQuery = mysqli_fetch_assoc($fetchingElectionName);

                 // check if election having column e_topic exists or not,if exists then show the candidates data  
                 
                            if (isset($execFetchingElectionNameQuery['e_topic']) && !is_null($execFetchingElectionNameQuery['e_topic'])) {
                            $election_name = $execFetchingElectionNameQuery['e_topic'];

                            $candidate_photo = $row['c_photo'];
                            $candidate_id = $row['c_id'];
                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td> <img src="<?php echo $candidate_photo; ?>" class="candidate_photo" />    </td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td><?php echo $row['c_details']; ?></td>
                                <td><?php echo $election_name; ?></td>
                                <td> 
                                <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo $candidate_id; ?>)"> Delete </button>
                                </td>
                            </tr>   
                <?php
                        
                        }
        
                    }
                    }else {
            ?>
                        <tr> 
                            <td colspan="7"><h3> No any candidate is added yet</h3></td>
                        </tr>
            <?php
                    }
                ?>
            </tbody>    
        </table>
    </div>
</div>

<!--function DeleteData() is used to delete the candidate with id c_id -->

<script>
    const DeleteData = (c_id) => {
        let c = confirm("Are you sure you want to delete this candidate?");
        if (c) {
            console.log(`Deleting candidate with ID: ${c_id}`);
            location.assign("index.php?addCandidatePage=1&delete_id=" + c_id);
        }
    }
</script>



<?php 

    if(isset($_POST['addCandidateBtn']))
    {
        //The mysqli_real_escape_string() function in PHP is used to escape special 
        //characters within a string before it is used in an SQL query
        $election_id = mysqli_real_escape_string($db, $_POST['election_id']);
        $candidate_name = mysqli_real_escape_string($db, $_POST['candidate_name']);
        $candidate_details = mysqli_real_escape_string($db, $_POST['candidate_details']);

        

        //photo logic
        $targetted_folder = "../assets/images/candidate_photos/";
        $candidate_photo = $targetted_folder . rand(111111111, 99999999999) . "_" . rand(111111111, 99999999999) . $_FILES['candidate_photo']['name'];
        $candidate_photo_tmp_name = $_FILES['candidate_photo']['tmp_name'];
        $candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "png", "jpeg");        
        $image_size = $_FILES['candidate_photo']['size'];


        
        if($image_size < 10000000) // 10 MB
        {
            
            if(in_array($candidate_photo_type, $allowed_types))
            {
                if(move_uploaded_file($candidate_photo_tmp_name, $candidate_photo))
                {
                    // inserting into db
                    mysqli_query($db, "INSERT INTO candidate
                    (election_id, c_name, c_details, c_photo)
                     VALUES('". $election_id ."', '". $candidate_name ."', '". $candidate_details ."', '". $candidate_photo ."')") or die(mysqli_error($db));

                    echo "<script> location.assign('index.php?addCandidatePage=1&added=1'); </script>";


                }else {
                    echo "<script> location.assign('index.php?addCandidatePage=1&failed=1'); </script>";                    
                }

            }else {
            echo "<script> location.assign('index.php?addCandidatePage=1&invalidFile=1'); </script>";
             }

        }else {
            echo "<script> location.assign('index.php?addCandidatePage=1&largeFile=1'); </script>";
        }
        
   
   
    ?>
    <?php 

    }
?>

    
