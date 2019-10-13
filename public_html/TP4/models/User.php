<?php
include("MyPDO.php");
class User
{
    private const USER_TABLE = "users ";
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
            session_start();
            $donne = $result->fetch();
            if (sha1($this->_password)==$donne['password']) {
                $return = true;
            }
        }
        return $return;
    }
}