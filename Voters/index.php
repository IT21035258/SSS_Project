<?php

require_once("Inc/header.php");
require_once("Inc/navigation.php");
?>

<div class="row my-3">
    <div class="col-12">
        <h3>Voters Panel</h3>

        <?php
        $fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE status = 'Active'") or die(mysqli_error($db));

        //fetching details about active elections - 
        $totalActiveElections = mysqli_num_rows($fetchingActiveElections);

        if ($totalActiveElections > 0) {

            while ($data = mysqli_fetch_assoc($fetchingActiveElections)) {

                $election_id = $data['id'];
                $election_topic = $data['election_topic'];


        ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4" class="bg-info text-white ">
                                <!-- strtoupper - for upper case letters -->
                                <h5>ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5>
                            </th>
                        </tr>
                        <tr>
                            <!-- voting table :table header -->
                            <th>Photo</th>
                            <th>Candidate Details</th>
                            <th># of Votes</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_details WHERE election_id = '" . $election_id . "'") or die(mysqli_error($db));

                        while ($candidateData = mysqli_fetch_assoc($fetchingCandidates)) {
                            // fetching from the db (candidate_details)
                            $candidate_id = $candidateData['id'];
                            $candidate_photo = $candidateData['candidate_photo'];



                            // fetching candidate votes -
                            $fetchingVotes = mysqli_query($db, "SELECT * FROM voting_details WHERE candidate_id = '" . $candidate_id . "'") or die(mysqli_error($db));

                            $totalVotes = mysqli_num_rows($fetchingVotes);


                        ?>
                            <!-- adding candidate data to the table -->
                            <tr>
                                <td><img src=" <?php echo $candidate_photo; ?>" class="candidate_photo"></td>
                                <!-- having candidates name and, details below the candidates name -->
                                <td><?php echo "<b>" . $candidateData['candidate_name'] . "</b> <br/>" . $candidateData['candidate_details']; ?></td>
                                <td> <?php echo $totalVotes ?></td>

                                <td>
                                    <?php

                                    $checkIfVoteCasted = mysqli_query($db, "SELECT * FROM voting_details WHERE voters_id = '" . $_SESSION['user_id'] . "' AND election_id = '" . $election_id . "'") or die(mysqli_error($db));
                                    $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);
                                    // echo $isVoteCasted;


                                    if ($isVoteCasted > 0) {

                                        $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                        $voteCastedToCandidate = $voteCastedData['candidate_id'];

                                        if ($voteCastedToCandidate == $candidate_id) {
                                    ?>
                                            <!-- if candidate have voted then the voted image will be displayed infront of the party which the candidate has voted. -->
                                            <img src="../Assets/images/vote2.png" width="100px">

                                        <?php
                                        }
                                    } else {

                                        ?> <button class="btn btn-md btn-success " onclick="CastVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> Vote </button>
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
        } else {

            echo "No any active elections..";
        }
        ?>

    </div>
</div>

<!-- // testing if the vote button is working -->
<!-- <script>
    const CastVote = (e_id, c_id, v_id) => {
        console.log(e_id + " - " + c_id + " - " + v_id);
    }
</script> -->


<script>
    const CastVote = (election_id, customer_id, voters_id) => {





        // why use ajax - allows web pages to be updated asynchronously by exchanging data with the server behind the scenes.
        //Performs an async AJAX request -> $.ajax

        //FormData  - creates a form and injecting all the data to the form.
        const form = new FormData();
        form.append('e_id', election_id)
        form.append('c_id', customer_id)
        form.append('v_id', voters_id)
        $.ajax({

            type: "POST",
            url: "./Inc/ajaxCalls.php",
            data: form,
            processData: false,
            contentType: false,
            success: function(response) {
                location.assign("index.php?voteCasted=1");

            },

            error: function(error) {
                location.assign("index.php?voteNotCasted=1");
            }

        });

    }
</script>

<?php
require_once("Inc/footer.php");
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>