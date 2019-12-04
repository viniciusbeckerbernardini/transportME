<?php
namespace model;

use \Firebase\JWT\JWT;
use persistence\Database;


class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $ip;
    private $lastLogin;
    private $createdAt;
    private $isAdmin;

    /**
     * @return integer
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getIp():string
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getLastLogin():DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastLogin
     */
    public function setLastLogin(DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt():DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function login(string $email, string $password):array{
        $this->setEmail($email);
        $this->setPassword($password);

        $query = new Query();

        $query->setQuery("SELECT * FROM USERS WHERE email=:email_user AND password=:password_user",

            array(
                ":email_user"=> $email,
                ":password_user"=> $password
            )
        );

        try{
            $query->execQuery();

            $return = $query->getResults()[0];

            return $return != null && is_array($return) && !empty($return) ? $return :array();
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage());
        }

    }

    /**
     * @return mixed
     *
     */
    public function authenticateWithJWT(array $token):string{

        Database::getEnvVariables();
        $key = getenv("KEY");


        $jwt = JWT::encode($token,$key);

        return $jwt;

    }

    public function identifyJWT(string $jwt){

        Database::getEnvVariables();
        $key = getenv("KEY");

        JWT::$leeway = 5;

        try {
            $decode = JWT::decode($jwt,$key,array('HS256'));
        }catch (\UnexpectedValueException $e){
            return false;
        }

        if(!empty($decode)){
            return $decode;
        }else{
        }
    }


    public function __toString():string
    {
        // TODO: Implement __toString() method.
    }


}