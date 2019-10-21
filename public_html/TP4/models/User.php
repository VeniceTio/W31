<?php
include("MyPDO.php");
class User
{
    private const USER_TABLE = "users";
    private $_login;
    private $_password;


    public function __construct(string $login, string $password = null)
    {
        $this->_login = $login;
        $this->_password = $password;
    }

    public function get_login(): string
    {
        return $this->_login;
    }

    public function set_login(string $login): string
    {
        $this->_login = $login;
    }

    public function get_password(): string
    {
        return $this->_password;
    }

    public function set_password(string $password): string
    {
        $this->_password = $password;
    }


    public function exists() : bool {
        $return = false;
        try{
            $pdo = MyPDO::pdo();
            $result = $pdo->prepare("SELECT * FROM ".self::USER_TABLE."WHERE login = :login");
            $result->bindValue(':login', $this->_login, PDO::PARAM_STR);
            $result->execute();
        }
        catch(PDOException $e){
            header('Location: fail.php');
            exit();
        }

        if ($result->rowCount()!=0){
            $donne = $result->fetch();
            if (sha1($this->_password)==$donne['password']) {
                $return = true;
            }
        }
        return $return;
    }

    public function create() : bool
    {
        $return = false;
        if (!$this->exists()) {
            try {
                $pdo = MyPDO::pdo();
                $result = $pdo->prepare("INSERT INTO " . self::USER_TABLE . " (login,password) VALUES (\"" . $this->_login . "\",\"" . sha1($this->_password) . "\")");
                $succes = $result->execute();
            } catch (PDOException $e) {
                header('Location: fail.php');
                exit();
            }
            if ($succes) {
                $return = true;
            }
        }
        return $return;
    }
    public function changePassword(string $newPassword) : bool
    {
        $return = false;
        try {
            $pdo = MyPDO::pdo();
            $result = $pdo->prepare("UPDATE " . self::USER_TABLE . " set password = :password WHERE login = \"" . $this->_login . "\"");
            $result->bindValue(':password', $newPassword, PDO::PARAM_STR);
            $result->execute();
            //throw new Exception("Error");
        }
        catch(PDOException $e){
            //var_dump($result);
            //throw( new Exception("erreur de requete"));
            header('Location: fail.php');
            exit();
        }
        if ($result) {
            $return = true;
            $this->_password = $newPassword;
        }
        return $return;
    }
    public function deleteUser() : bool{
        $return = false;
        if ($this->exists()) {
            try{
                $pdo = MyPDO::pdo();
                $result = $pdo->prepare("DELETE FROM " . self::USER_TABLE . " WHERE " . self::USER_TABLE . ".login=\"" . $this->_login . "\"");
                $result->execute();
                //var_dump($result);
                //throw new Exception($result);
            }
            catch(PDOException $e){
                //var_dump($result);
                //throw( new Exception("erreur de requete"));
                header('Location: fail.php');
                exit();
            }
            if ($result) {
                $return = true;
            }
        }
        return $return;
    }
}