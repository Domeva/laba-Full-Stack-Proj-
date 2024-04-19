<?php

class MainSql
{
    public $connection = null;
    private $server = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $db_name = 'osbb';

    public function __construct()
    {
        $connection = new mysqli($this->server, $this->username, $this->password, $this->db_name);
        if (!$connection->connect_error) {
            $this->connection = $connection;
            $this->useDataBase();
        } else {
            http_response_code(500);
            die("Error while connection!");
        }
    }

    private function useDataBase()
    {
        mysqli_select_db($this->connection, $this->db_name);
    }

    public function createUser($username, $password)
    {
        $createUser = $this->connection->query("CREATE USER '{$username}'@'{$this->server}' IDENTIFIED BY '{$password}';");

        if ($createUser !== TRUE) {
            http_response_code(500);
            die('Error while creating user!');
        } else {
            return true;
        }
    }

    public function grant($username)
    {
        $allow = $this->connection->query("GRANT SELECT, INSERT, DELETE, UPDATE ON osbb.* TO '{$username}'@'{$this->server}';");

        if ($allow !== TRUE) {
            http_response_code(500);
            die("Error while allow access for $username!");
        }

        $flush = $this->connection->query("FLUSH PRIVILEGES;");
        if ($flush !== TRUE) {
            http_response_code(500);
            die("Error while flushing privileges!");
        } else {
            return true;
        }
    }

    public function revoke($username)
    {
        $revoke = $this->connection->query("REVOKE SELECT, INSERT, DELETE, UPDATE ON osbb.* TO '{$username}'@'{$this->server}'");

        if ($revoke !== TRUE) {
            http_response_code(500);
            die("Error while allow access for $username!");
        } else {
            return true;
        }
    }

    public function checkUser($username)
    {
        $checkUsername = $this->connection->prepare('SELECT * FROM mysql.user WHERE User = ? AND Host = ?');
        $checkUsername->bind_param('ss', $username, $this->server);

        if ($checkUsername->execute() !== TRUE) {
            http_response_code(500);
            die("Error while select user!");
        } else {
            $result = $checkUsername->get_result();
            $checkUsername->close();
            if ($result->num_rows >= 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function checkPassword($username, $password)
    {
        $check = $this->connection->prepare('SELECT * FROM mysql.user WHERE User = ? AND Host = ?');

        $check->bind_param('ss', $username, $this->server);

        if ($check->execute() !== TRUE) {
            http_response_code(500);
            die("Error while select user!");
        } else {
            $result = $check->get_result();
            $check->close();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($password === md5($row['Password'])) {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public function changeUser($username, $password)
    {
        $this->connection = new mysqli($this->server, $username, $password, $this->db_name);

        if ($this->connection->connect_error) {
            http_response_code(500);
            die("Error while connection new user!");
        } else {
            return true;
        }
    }

    public function checkCurrentUser($username)
    {
        $getUser = $this->connection->prepare("SELECT CURRENT_USER() as 'current_user';");

        if ($getUser->execute() !== TRUE) {
            http_response_code(500);
            die("Error while getting user for check !");
        } else {
            $result = $getUser->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['current_user']) {
                        $array_checked_u = explode('@', $row['current_user']);
                        $user_checked_name = $array_checked_u[0];
                        if ($user_checked_name === $username) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }


    // view
    public function getData()
    {
            $createTable = $this->connection->prepare('CREATE TABLE IF NOT EXISTS owners_flats (
                id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                entrance_number INT(11) UNSIGNED NOT NULL,
                flat_number INT(11) UNSIGNED NOT NULL,
                owner_firstname VARCHAR(60) NOT NULL,
                owner_secondname VARCHAR(60) NOT NULL,
                phone_number_owner VARCHAR(60) NOT NULL,
                services_price DECIMAL(6, 0) UNSIGNED NOT NULL,
                tenants INT(11) UNSIGNED NOT NULL
            )ENGINE=InnoDB DEFAULT charset=utf8 collate=utf8_general_ci');


            if($createTable->execute() !== TRUE){
                http_response_code(500);
                die("Error while create table!");
            }
            else{
                session_start();
                if (!isset($_SESSION['added']) || !$_SESSION['added']) {
                    $insert_data = $this->connection->prepare('
                        INSERT INTO owners_flats (`entrance_number`, `flat_number`, `owner_firstname`,
                              `owner_secondname`, `phone_number_owner`, `services_price`, `tenants`)
                        SELECT
                            flat.entrance_number AS entrance_number,
                            flat.flat_number AS flat_number,
                            flat.f_name_owner AS owner_firstname,
                            flat.s_name_owner AS owner_secondname,
                            flat.phone_number_owner AS phone_number_owner,
                            flat.services_price AS services_price,
                            flat.tenants AS tenants
                        FROM entrance_details
                        INNER JOIN flat ON flat.entrance_number = entrance_details.entrance_number;
                    ');

                    if ($insert_data->execute()) {
                        $_SESSION['added'] = true;
                    } else {
                        http_response_code(500);
                        die("Error while inserting data into owners_flats!");
                    }
                }
                session_write_close();


                $select_data = $this->connection->prepare('SELECT * FROM owners_flats;');
                    $array_data = [];

                    if ($select_data->execute() !== TRUE) {
                        http_response_code(500);
                        die("Error while select data from table!");
                    }

                    $result = $select_data->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $array_data[] = $row;
                        }
                    }

                    $createTable->close();
                    $select_data->close();

                    return $array_data;
                }
    }


    public function checkPhoneNumber($phone){
        $checkPhoneNumber = $this->connection->prepare('SELECT * FROM owners_flats where phone_number_owner = ?');
        $checkPhoneNumber->bind_param('s', $phone);

        if($checkPhoneNumber->execute() !== TRUE){
            http_response_code(500);
            die('Error while check phone number!');
        }
        else{
            $result = $checkPhoneNumber->get_result();
            if($result->num_rows > 0){
                return false;
            }
            else{
                return true;
            }
        }
    }


    public function checkEntryFlat($request)
    {
        $id = (int)$request['update_id'];

        $checkEntryFlat = $this->connection->prepare('SELECT * FROM owners_flats WHERE entrance_number = ? AND flat_number = ?');

        $entry = (int)$request['entrance_number'];
        $flat = (int)$request['flat_number'];

        $checkEntryFlat->bind_param('ii', $entry, $flat);

        if (!$checkEntryFlat->execute()) {
            http_response_code(500);
            die("Error executing check query: " . $this->connection->error);
        } else {
            $result = $checkEntryFlat->get_result();
            $row = $result->fetch_assoc();
            $checkEntryFlat->close();

            if (($result->num_rows === 1 && (int)$row['id'] === $id) || $result->num_rows === 0) {
                $request['update_id'] = null;
                return true;
            }
            else {
                $request['update_id'] = null;
                return false;
            }
        }
    }





    public function addEntry($request)
    {
        $entrance_number = (int)$request['entrance_number'];
        $flat_number = (int)$request['flat_number'];
        $owner_firstname = $request['owner_firstname'];
        $owner_secondname = $request['owner_secondname'];
        $phone_number_owner = $request['phone_number_owner'];
        $services_price = (int)$request['services_price'];
        $tenants = (int)$request['tenants'];

        $insert_data = $this->connection->prepare("INSERT INTO owners_flats (entrance_number, flat_number, owner_firstname, 
                  owner_secondname, phone_number_owner, services_price, tenants) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $insert_data->bind_param('iisssii', $entrance_number, $flat_number, $owner_firstname,
            $owner_secondname, $phone_number_owner, $services_price, $tenants);

        if ($insert_data->execute() !== TRUE) {
            http_response_code(500);
            die("Error while add new entry !");
        } else {
            $insert_data->close();
            return $this->connection->insert_id;
        }
    }
    public function updateEntry($request)
    {
        $id = (int)$request['update_id'];
        $entrance_number = (int)$request['entrance_number'];
        $flat_number = (int)$request['flat_number'];
        $owner_firstname = $request['owner_firstname'];
        $owner_secondname = $request['owner_secondname'];
        $phone_number_owner = $request['phone_number_owner'];
        $services_price = (int)$request['services_price'];
        $tenants = (int)$request['tenants'];

        $update_entry = $this->connection->prepare('UPDATE owners_flats SET  
            entrance_number = ?, flat_number = ?, owner_firstname = ?, owner_secondname = ?, phone_number_owner = ?,
            services_price = ?, tenants = ? where id = ?                  
        ');

        $update_entry->bind_param('iisssiii', $entrance_number, $flat_number, $owner_firstname, $owner_secondname,
            $phone_number_owner, $services_price, $tenants, $id);

        if ($update_entry->execute() !== TRUE) {
            http_response_code(500);
            die("Error while update entry !");
        } else {
            $update_entry->close();
            return $id;
        }
    }
    public function getNewEntry($id)
    {
        $select_added = $this->connection->prepare('SELECT * FROM owners_flats where id = ?');
        $id = (int)$id;

        $select_added->bind_param('i', $id);

        if ($select_added->execute() !== TRUE) {
            http_response_code(500);
            die("Error while getting added!");
        } else {
            $result = $select_added->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    return $row;
                }
            }
            $select_added->close();
        }
    }
    public function deleteEntry($request)
    {
        $id = (int)$request['delete_id'];
        $delete_entry = $this->connection->prepare('DELETE FROM owners_flats where id = ?');

        $delete_entry->bind_param('i', $id);

        if ($delete_entry->execute() !== TRUE) {
            http_response_code(500);
            die("Error while deleting entry!");
        } else {
            $delete_entry->close();
            return $id;
        }
    }
    public function search($value)
    {
        $keyword = '%' . $value . '%';

        $search_array = [];

        $search = $this->connection->prepare("SELECT id FROM owners_flats WHERE CONCAT(owner_firstname, ' ', owner_secondname) LIKE ?");
        $search->bind_param('s', $keyword);

        if($search->execute() !== TRUE){
            http_response_code(500);
            die("Error while search!");
        }
        else{
            $result = $search->get_result();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $search_array[] = $row;
                }
            }
            $search->close();

            return $search_array;
        }
    }
}