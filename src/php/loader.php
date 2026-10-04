
<?php

function injectLoader() {
    echo "
        <div class='loader d-flex align-items-center justify-content-center' style='visibility: hidden;' role='loader'>
            <div class='spinner-grow m-3 text-danger'></div>
            <div class='spinner-grow m-3 text-success'></div>
            <div class='spinner-grow m-3 text-primary'></div>
        </div>
    ";
}

?>
