<?php

if (isset($_GET['added'])) {


?>

    <div class="alert alert-success my-3" role="alert">
        Election has been added successfully.
    </div>

<?php
}

?>






<div class="row my-3">

    <div class="col-4">
        <h3> Add New Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" placeholder="Election Topic" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="number" name="number_of_candidates" placeholder="Number Of Candidates" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="starting_date" placeholder="Starting Date" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="ending_date" placeholder="Ending Date" class="form-control" required />
            </div>

            <input type="submit" value="Add Election" name="addElectionBtn" class="btn btn-success">
        </form>
    </div>

    <div class="col-8">
        <h3>Upcoming Elections</h3>
        <table class="table table-info">
            <thead>
                <tr>
                    <th scope="col">E.No</th>
                    <th scope="col">Election Name</th>
                    <th scope="col"># Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($db, "SELECT *FROM elections") or die(mysqli_error($db));
                $isAnyElectionAdded = mysqli_num_rows($fetchingData);

                if ($isAnyElectionAdded > 0) {
                    $Eno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                ?>
                        <tr>
                            <td><?php echo $Eno++; ?></td>
                            <td><?php echo $row['election_topic']; ?></td>
                            <td><?php echo $row['no_of_candidates']; ?></td>
                            <td><?php echo $row['starting_date']; ?></td>
                            <td><?php echo $row['ending_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="#" class="btn btn_sm btn-warning"> Edit</a>
                                <a href="#" class="btn btn_sm btn-danger"> Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7"> No any election is added yet.</td>
                    </tr>

                <?php
                }

                ?>


            </tbody>
        </table>
    </div>
</div>


<?php

if (isset($_POST['addElectionBtn'])) {
    $election_topic = mysqli_real_escape_string($db, $_POST['election_topic']);
    $number_of_candidates = mysqli_real_escape_string($db, $_POST['number_of_candidates']);
    $starting_date = mysqli_real_escape_string($db, $_POST['starting_date']);
    $ending_date = mysqli_real_escape_string($db, $_POST['ending_date']);
    $inserted_by = $_SESSION['L_name'];
    $inserted_on = date("Y-m-d");

    //creates Date objects
    $date1 = date_create($inserted_on);
    $date2 = date_create($starting_date);
    //calculates the difference between Date objects
    $diff = date_diff($date1, $date2);
    // printing result in days format


    if ((int)$diff->format("%R%a") > 0) {
        $status = "InActive";
    } else {
        $status = "Active";
    }

    //inserting into database

    mysqli_query($db, "INSERT INTO elections(election_topic, no_of_candidates,starting_date, ending_date, status, inserted_by,inserted_on )
     VALUES('" . $election_topic . "','" . $number_of_candidates . "','" . $starting_date . "','" . $ending_date . "','" . $status . "','" . $inserted_by . "','" . $inserted_on . "')") or
        die(mysqli_error($db));

?>
    <script>
        location.assign('index.php?AddElectionPage=1&added=1');
    </script>

<?php
}

?>