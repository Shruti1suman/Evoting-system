
<!-- alert -->
<?php 
    if(isset($_GET['added']))
    {
?>
        <div class="alert alert-success my-3" role="alert">
            Election added successfully                                          
        </div>  
<?php
    }
    else if(isset($_GET['notadded'])){
        ?>
        <div class="alert alert-danger my-3" role="alert">
        Election topic already exists. Please choose a different topic
        </div>  
<?php
    }
    else if(isset($_GET['date'])){
        ?>
        <div class="alert alert-danger my-3" role="alert">
        Starting date time is greater than ending date time.Please correct it
        </div>  
<?php
    }
    else if(isset($_GET['date1'])){
        ?>
        <div class="alert alert-danger my-3" role="alert">
        Current date time is greater than ending date time.Please correct it
        </div>  
<?php
    }
    else if(isset($_GET['delete_id']))
    {
        $d_id = mysqli_real_escape_string($db, $_GET['delete_id']);
          // Delete candidates associated with the election
          mysqli_query($db, "DELETE FROM candidate WHERE election_id = '". $d_id ."'") or die(mysqli_error($db));
        
          // Delete the election
          mysqli_query($db, "DELETE FROM election WHERE e_id = '". $d_id ."'") or die(mysqli_error($db));
  ?>
         <div class="alert alert-danger my-3" role="alert">
              Election and its candidates have been deleted successfully!
          </div>
<?php

    }

?>


<div class="row my-3">
    <div class="col-4">
        <h3>Add New Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" placeholder="Election Topic" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="number" name="number_of_candidates" min=2 placeholder="No of Candidates" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="sd">Starting Date</label>
                <input type="datetime-local" id="sd" name="starting_date" placeholder="Starting Date" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="sd">Ending Date</label>
                <input type="datetime-local" name="ending_date" placeholder="Ending Date" class="form-control" required />
            </div>
            <input type="submit" value="Add Election" name="addElectionBtn" class="btn btn-success" />
        </form>
    </div>


<div class="col-8">
        <h3>Upcoming Elections</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Election Topic</th>
                    <th scope="col">Candidates</th>
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
                            $election_id = $row['e_id'];

                          
                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $row['e_topic']; ?></td>
                                <td><?php echo $row['no_of_candidates']; ?></td>
                                <td><?php echo $row['start_date']; ?></td>
                                <td><?php echo $row['end_date']; ?></td>
                                <td><?php echo $row['e_status']; ?></td>
                                <td> 
                        
                                    <button class="btn btn-sm btn-danger" onclick="DeleteData(<?php echo $election_id; ?>)"> Delete </button>
                                </td>
                            </tr>
                <?php
                        }
                    }else {
            ?>
                        <tr> 
                            <td colspan="7"><h3>No Upcoming Elections</h3> </td>
                        </tr>
            <?php
                    }
                ?>


            </tbody>
        </table>
    </div>
</div>


      
<!--function DeleteData() is used to delete the election having id e_id -->

<script>
    const DeleteData = (e_id) => 
    {
        let c = confirm("Are you really want to delete it?");

        if(c == true)
        {
            location.assign("index.php?addElectionPage=1&delete_id=" + e_id);
        }
    }
</script>





<?php 

    if(isset($_POST['addElectionBtn']))
    {
        //The mysqli_real_escape_string() function in PHP is used to escape special 
        //characters within a string before it is used in an SQL query
        $election_topic = mysqli_real_escape_string($db, $_POST['election_topic']);
        $number_of_candidates = mysqli_real_escape_string($db, $_POST['number_of_candidates']);
        $starting_date = mysqli_real_escape_string($db, $_POST['starting_date']);
        $ending_date = mysqli_real_escape_string($db, $_POST['ending_date']);
        



        

$startDateTime = new DateTime($starting_date, new DateTimeZone('Asia/Kolkata'));
$endDateTime = new DateTime($ending_date, new DateTimeZone('Asia/Kolkata'));

// Current date/time (assuming current server time)
$currentDateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

// Check if current date/time is between start and end dates/times
if ($startDateTime->getTimestamp() > $endDateTime->getTimestamp()) {
    ?>
            <script> location.assign("index.php?addElectionPage=1&date=1"); </script>
    <?php
    exit;
} 
else if ($currentDateTime->getTimestamp() > $endDateTime->getTimestamp()) {
    ?>
            <script> location.assign("index.php?addElectionPage=1&date1=1"); </script>
    <?php
    exit;
}
else if ($currentDateTime->getTimestamp() >= $startDateTime->getTimestamp() && $currentDateTime->getTimestamp() <= $endDateTime->getTimestamp()) {
    $status = "Active";
} else {
    $status = "InActive";
}


         //Check if e_topic is unique
         $checkQuery = $db->prepare("SELECT e_id FROM election WHERE e_topic = ?");             //checking for a specific e_topic value, lets say "?"
         $checkQuery->bind_param("s", $election_topic);                                     //binding the parameter election topic instead of ? & "s" determines, it's a string
         $checkQuery->execute();                                                           // This executes the prepared statement with the bound parameter.
         $checkQuery->store_result();                                                     // This stores the result of the query, allowing you to check if any rows were returned.
 


         if ($checkQuery->num_rows == 0){

            // inserting into db
        mysqli_query($db, "INSERT INTO election(e_topic, no_of_candidates, start_date, end_date, e_status) VALUES
        ('". $election_topic ."', '". $number_of_candidates ."', '". $starting_date ."', '". $ending_date ."', '". $status ."')") or die(mysqli_error($db));
        
    ?>
            <script> location.assign("index.php?addElectionPage=1&added=1"); </script>
    <?php
         }
         else{
            ?>
            <script> location.assign("index.php?addElectionPage=1&notadded=1"); </script>
    <?php
         }
    }
?>

    
