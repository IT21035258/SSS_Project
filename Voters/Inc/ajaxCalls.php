

<?php
require_once("../../Admin/Inc/config.php");


//var_dump($_POST["e_id"]);

if (isset($_POST['e_id']) and isset($_POST['c_id']) and isset($_POST['v_id'])) {
    $vote_date = date("Y-m-d");
    // Y- years m- month d- day
    $vote_time = date("h:i:s a");
    // h - hours i- minutes s- seconds a-am/pm

    mysqli_query($db, "INSERT INTO voting_details(election_id, voters_id, candidate_id, vote_date, vote_time) VALUES('" . $_POST['e_id'] . "', '" . $_POST['v_id'] . "','" . $_POST['c_id'] . "','" . $vote_date . "','" . $vote_time . "')") or die(mysqli_error($db));

    echo "Success";
}


?>

