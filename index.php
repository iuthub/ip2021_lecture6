<?php
include('header.php');
session_start();

$city = isset($_SESSION['city'])?$_SESSION['city']:'';
$state = isset($_SESSION['state'])?$_SESSION['state']:'';
$zipCode = isset($_SESSION['zipCode'])?$_SESSION['zipCode']:'';

$isCityValid = true;
$isStateValid = true;
$isZipCodeValid = true;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zipCode = $_REQUEST['zipCode'];

    $isCityValid = preg_match('/^[a-z][a-z \-]*[a-z]$/i', $city);
    $isStateValid = preg_match('/^[a-z]{2}$/i', $state);
    $isZipCodeValid = preg_match('/^\d{5}$/i', $zipCode);;

    $isValid = $isZipCodeValid && $isCityValid && $isStateValid;

    if ($isValid) {
        //  insert into database, or send over email, or API

//        setcookie('city', $city, time() + 3600);
//        setcookie('state', $state, time() + 3600);
//        setcookie('zipCode', $zipCode, time() + 3600);

        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;
        $_SESSION['zipCode'] = $zipCode;
        header('Location: thanks.php', TRUE, 301);
    }
}
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Submit Form with a Validation</h1>
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control <?= $isCityValid ? '' : 'is-invalid' ?>" id="city"
                               name="city" value="<?= $city ?>" placeholder="Enter city">
                        <div class="invalid-feedback">
                            Please, enter city
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">State</label>
                        <input type="text" class="form-control <?= $isStateValid ? '' : 'is-invalid' ?>" id="state"
                               name="state" value="<?= $state ?>" placeholder="Enter state"
                               maxlength="2">
                        <div class="invalid-feedback">
                            Please, enter state which is 2 characters long
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zipCode" class="form-label">Zip Code</label>
                        <input type="text" class="form-control <?= $isZipCodeValid ? '' : 'is-invalid' ?>" id="zipCode"
                               name="zipCode" value="<?= $zipCode ?>" placeholder="Enter zip code"
                               maxlength="5">
                        <div class="invalid-feedback">
                            Please, enter zip code which is 5 character long
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>