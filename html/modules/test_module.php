mysql> CREATE USER 'buxalter'@'localhost' IDENTIFIED BY 'Bukaka_675u';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT SELECT ON test_lab_2.workers 'buxalter'@'localhost';
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''buxalter'@'localhost'' at line 1
mysql> select * from user where User='buxalter';
+-----------+----------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+----------+------------------------+--------------------------+----------------------------+---------------+-------------+-----------------+----------------------+-----------------------+------------------------------------------------------------------------+------------------+-----------------------+-------------------+----------------+------------------+----------------+------------------------+---------------------+--------------------------+-----------------+
| Host      | User     | Select_priv | Insert_priv | Update_priv | Delete_priv | Create_priv | Drop_priv | Reload_priv | Shutdown_priv | Process_priv | File_priv | Grant_priv | References_priv | Index_priv | Alter_priv | Show_db_priv | Super_priv | Create_tmp_table_priv | Lock_tables_priv | Execute_priv | Repl_slave_priv | Repl_client_priv | Create_view_priv | Show_view_priv | Create_routine_priv | Alter_routine_priv | Create_user_priv | Event_priv | Trigger_priv | Create_tablespace_priv | ssl_type | ssl_cipher             | x509_issuer              | x509_subject               | max_questions | max_updates | max_connections | max_user_connections | plugin                | authentication_string                                                  | password_expired | password_last_changed | password_lifetime | account_locked | Create_role_priv | Drop_role_priv | Password_reuse_history | Password_reuse_time | Password_require_current | User_attributes |
+-----------+----------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+----------+------------------------+--------------------------+----------------------------+---------------+-------------+-----------------+----------------------+-----------------------+------------------------------------------------------------------------+------------------+-----------------------+-------------------+----------------+------------------+----------------+------------------------+---------------------+--------------------------+-----------------+
| localhost | buxalter | N           | N           | N           | N           | N           | N         | N           | N             | N            | N         | N          | N               | N          | N          | N            | N          | N                     | N                | N            | N               | N                | N                | N              | N                   | N                  | N                | N          | N            | N                      |          | 0x                     | 0x                       | 0x                         |             0 |           0 |               0 |                    0 | caching_sha2_password | $A$005$oc&+.0 NHwnC/stWrqW9eiOJojfYXuK.X/0YRpa2MzoQlWlKBPbtZh4wo5oB | N                | 2024-04-27 08:07:49   |              NULL | N              | N                | N              |                   NULL |                NULL | NULL                     | NULL            |
+-----------+----------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+----------+------------------------+--------------------------+----------------------------+---------------+-------------+-----------------+----------------------+-----------------------+------------------------------------------------------------------------+------------------+-----------------------+-------------------+----------------+------------------+----------------+------------------------+---------------------+--------------------------+-----------------+
1 row in set (0,00 sec)

mysql> GRANT SELECT ON test_lab_2.workers 'buxalter'@'localhost';
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''buxalter'@'localhost'' at line 1
mysql> GRANT SELECT ON test_lab_2.workers TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT DELETE ON test_lab_2.workers TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT UPDATE ON test_lab_2.workers TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT INSERT ON test_lab_2.workers TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT INSERT ON test_lab_2.worker_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,01 sec)

mysql> GRANT SELECT ON test_lab_2.worker_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT UPDATE ON test_lab_2.worker_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT DELETE ON test_lab_2.worker_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT DELETE ON test_lab_2.machinery_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT UPDATE ON test_lab_2.machinery_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT INSERT ON test_lab_2.machinery_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT SELECT ON test_lab_2.machinery_group TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT INSERT ON test_lab_2.machinery TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT DELETE ON test_lab_2.machinery TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT UPDATE ON test_lab_2.machinery TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT SELECT ON test_lab_2.machinery TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT SELECT ON test_lab_2.product_directory TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT SELECT ON test_lab_2.worker_group_view TO 'buxalter'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> CREATE USER 'Ivan'@'localhost' IDENTIFIED BY 'Chupakabra_777';

mysql> GRANT SELECT ON test_lab_2.animal_feed_product_storage_view TO 'Ivan'@'lo
calhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT SELECT ON test_lab_2.product_directory TO 'Ivan'@'localhost';
Query OK, 0 rows affected (0,02 sec)

mysql> GRANT INSERT ON test_lab_2.product_directory TO 'Ivan'@'localhost';
Query OK, 0 rows affected (0,03 sec)

mysql> GRANT UPDATE ON test_lab_2.product_directory TO 'Ivan'@'localhost';
Query OK, 0 rows affected (0,05 sec)

mysql> GRANT DELETE ON test_lab_2.product_directory TO 'Ivan'@'localhost';
Query OK, 0 rows affected (0,03 sec)


CREATE USER 'quest'@'localhost' identified by '_Have1not1password_'
-> ;

/*<?php
$username = "root"; // Введіть своє ім'я користувача
$password = "Acer_Aspire_7"; // Введіть свій пароль
$con = mysqli_connect("localhost",$username,$password,"mysql");

function login($username, $password)
{
    global $con;
    $gigi = mysqli_query($con, "SELECT * FROM user WHERE USER='$username';");;
    if ($gigi->num_rows > 0) {
        // Отримання рядка результатів
        $row = $gigi->fetch_assoc();

        // Отримання значення зі стовпця authentication_string
        $authentication_string = $row["authentication_string"];
        echo PASSWORD($authentication_string);
        echo SHA1($authentication_string);
        // Використання значення
        echo "Authentication String: " . $authentication_string;
        echo "verify - ". password_verify($password, $authentication_string);
        error_log("verify: ". password_verify($password, $authentication_string));

    } else {
        echo "No results found";
    }
}

// Виклик функції login для перевірки введених даних
login($username, $password);
?>
<!--$result = login($username, $password);
//echo $result;

/*$useuryy = password_verify($password, );
error_log("userpass : ".$userpass);
error_log("password : ".$password);
error_log("username : ".$username);

$result = mysqli_query($con, "SELECT * FROM user WHERE USER='$username' AND authentication_string='$userpass'");
$success = false; // Ініціалізуємо змінну $success перед циклом
while($row = mysqli_fetch_array($result)) {
    $success = true;
}
if($success == true) {
    $_SESSION['username']= $username;
    //redirect to home page
} else {
    echo '<div class="alert alert-danger">Oops! It looks like your username and/or password are incorrect. Please try again.</div>';
}
}


?>-->
