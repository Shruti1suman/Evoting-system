<?php  // Database connection

    // Check if the Accept button was clicked
    if (isset($_POST['acceptVoter'])) {
        $voter_id = $_POST['voter_id'];
        mysqli_query($db, "UPDATE voter SET v_status = 'Active' WHERE v_id = '$voter_id'") or die(mysqli_error($db));
        ?>  <div class="alert alert-success my-3" role="alert">
          Voter verified successfully!
    </div>
    <?php
    }

    // Check if the Delete button was clicked
    if (isset($_POST['deleteVoter'])) {
        $voter_id = $_POST['voter_id'];
        mysqli_query($db, "DELETE FROM voter WHERE v_id = '$voter_id'") or die(mysqli_error($db));
      ?>  <div class="alert alert-danger my-3" role="alert">
          Voter deleted successfully!
    </div>
    <?php
    }
?>

<div class="row my-3">  
    <div class="col-12">
        <h3>Voter List</h3>
        <?php 
            if(isset($_GET['accepted'])) {
        ?>
            <div class="alert alert-success my-3" role="alert">
                Voter accepted successfully                                          
            </div>  
        <?php 
            } elseif(isset($_GET['deleted'])) {
        ?>
            <div class="alert alert-success my-3" role="alert">
                Voter deleted successfully                                          
            </div>  
        <?php 
            } 
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Fetch only inactive voters
                    $fetchingData = mysqli_query($db, "SELECT * FROM voter WHERE v_status = 'Inactive'") or die(mysqli_error($db)); 
                    $isanyvoteradded = mysqli_num_rows($fetchingData);

                    if($isanyvoteradded > 0) {
                        $sno = 1;
                        while($row = mysqli_fetch_assoc($fetchingData)) {
                            $voter_id = $row['v_id'];
                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['f_name']; ?></td>
                                <td><?php echo $row['l_name']; ?></td>
                                <td> 
                                    <form method="POST" style="display:inline-block;">
                                        <input type="hidden" name="voter_id" value="<?php echo $voter_id; ?>">
                                        <button class="btn btn-sm btn-success" type="submit" name="acceptVoter"> Accept </button>
                                    </form>
                                    <form method="POST" style="display:inline-block;">
                                        <input type="hidden" name="voter_id" value="<?php echo $voter_id; ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" name="deleteVoter"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
                ?>
                        <tr> 
                            <td colspan="5"><h3> No Pending Voters</h3></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>    
        </table>
    </div>
</div>

