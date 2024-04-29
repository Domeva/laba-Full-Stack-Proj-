<?php
$text = 'Bukaka_675u';
$hashed_text = password_hash($text, PASSWORD_ARGON2ID);
echo $hashed_text;
echo '<br>';
$text = 'Bukaka_675u';
$hashed_text = password_hash($text, PASSWORD_DEFAULT);
echo $hashed_text;
//$hashed_text = password_hash($text, PASSWORD_ARGON2ID);

