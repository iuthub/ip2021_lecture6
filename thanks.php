<?php
include('header.php');
session_start();

// $_REQUEST['city']; will not works
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Thanks for your submission. Your city is <?= $_SESSION['city'] ?>.</h1>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
