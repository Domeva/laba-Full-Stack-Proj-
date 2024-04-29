<?php
session_start();
?>
<footer>
    <h5>
        Сторінок:
        <?php
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 1;
        } else {
            $_SESSION['counter']++;
        }
        echo $_SESSION['counter'];
        ?>
    </h5>
</footer>
