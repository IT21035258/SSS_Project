<?php
require_once('Inc/header.php');
require_once('Inc/navigation.php');

if (isset($_GET['HomePage'])) {
    require_once('Inc/homepage.php');
}

if (isset($_GET['AddElectionPage'])) {

    require_once('Inc/add_elections.php');
} else if (isset($_GET['AddCandidatePage'])) {

    require_once("Inc/add_candidates.php");
}
?>

<?php

require_once("Inc/footer.php");

?>
