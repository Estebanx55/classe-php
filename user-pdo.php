<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

</body>

</html>
<?php

class Userpdo
{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    private $password;

    public function __construct()
    {
        $this->id = 0;
        $this->login = "";
        $this->email = "";
        $this->firstname = "";
        $this->lastname = "";
        $this->password = "";
    }

    public function register($login, $password, $email, $firstname, $lastname)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        $connect = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');

        $sql = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if ($statement = true) {
            return '<table class="table"><tr>
            <th scope="col">Login</th>
            <th scope="col">Password</th>
            <th scope="col">Email</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
          </tr><tr scope="row"><td>' . $login . '</td><td> ' . $password . '</td><td>' . $email . '</td><td>' . $firstname . '</td><td>' . $lastname . '</td></tr></table>';
        } else {
            return 'ERROR';
        }
    }
    public function connect($login, $password)
    {
        $connect = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql = "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $any = $statement->fetch(PDO::FETCH_ASSOC);
        if ($any) {
            // var_dump($any);
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $this->login = $any['login'];
            $this->password = $any['password'];
            $this->email = $any['email'];
            $this->firstname = $any['firstname'];
            $this->lastname = $any['lastname'];
            return "CONNEXION RÉUSSEE";
        } else {
            return 'ERROR';
        }
    }
    public function disconnect()
    {
        unset($_SESSION['login']);
        unset($_SESSION['password']);
        $this->login = "";
        $this->password = "";
        $this->email = "";
        $this->firstname = "";
        $this->lastname = "";
        return "DÉCONNEXION RÉUSSEE";
    }
    public function delete()
    {
        $connect = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql = "DELETE FROM utilisateurs WHERE login = '$this->login'";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if ($statement = true) {
            $this->disconnect();
            return 'DELETE';
        } else {
            return 'ERROR';
        }
    }

    public function update($login, $password, $email, $firstname, $lastname)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $currentLogin = $_SESSION['login'];
        $connect = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql = "UPDATE utilisateurs SET login = '$login', password = '$password', email = '$email', firstname = '$firstname', lastname = '$lastname' WHERE login = '$currentLogin'";
        $statement = $connect->prepare($sql);
        $statement->execute();
        if ($statement = true) {
            $_SESSION['login'] = $this->login;
            $_SESSION['password'] = $password;
            return 'UPDATE';
        } else {
            return 'ERROR';
        }
    }
    public function isConnected()
    {
        if (isset($_SESSION['login'])) {
            return 'TRUE';
        } else {
            return 'FALSE';
        }
    }
    public function getAllinfo()
    {
        if (isset($_SESSION['login'])) {
            $connect = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
            $sql = "SELECT * FROM utilisateurs WHERE login = '$_SESSION[login]'";
            $statement = $connect->prepare($sql);
            $statement->execute();
            $info = $statement->fetch(PDO::FETCH_ASSOC);
            return '<table class="table"><tr>
            <th scope="col">Login</th>
            <th scope="col">Password</th>
            <th scope="col">Email</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
          </tr><tr scope="row"><td>' . $info['login'] . ' </td><td> ' . $info['password'] . '</td><td>' . $info['email'] . '</td><td>' . $info['firstname'] . '</td><td>' . $info['lastname'] . '</td></tr></table>';
        }
    }
    public function getLogin(){
        return $this->login;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
}
$userpdo = new Userpdo();
var_dump($userpdo);

