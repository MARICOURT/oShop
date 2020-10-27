<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel {

    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    static public function find($id) {}// read
    public function update(){}// update
    public function delete(){}// delete
    
    /**
     * Récupérer un utilisateur par son email
     * 
     * @param string $email
     * @return AppUser
     */
    static public function findByEmail($email)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();
        
        // écrire notre requête et la préparer
        $sql = 'SELECT * FROM `app_user` WHERE `email` = :email';
        $pdoStatement = $pdo->prepare($sql);
        
        // exécuter notre requête
        $pdoStatement->execute([
            ':email' => $email
            ]);
            
            // un seul résultat => fetchObject
            $user = $pdoStatement->fetchObject(self::class);
            
            // retourner le résultat
            return $user;
        }
        
        static public function findAll()
        {
            // se connecter à la BDD
            $pdo = Database::getPDO();
            
            $sql = 'SELECT * FROM `app_user`';
            $pdoStatement = $pdo->query($sql);
            
            $users = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            
            return $users;
        }
        
        public function insert()
        {
            // se connecter à la BDD
            $pdo = Database::getPDO();

            // préparer la requête
            $sql = "
                INSERT INTO `app_user` (
                    `email`,
                    `password`,
                    `firstname`,
                    `lastname`, 
                    `role`,
                    `status`
                ) 
                VALUES (
                    :email,
                    :password,
                    :firstname,
                    :lastname,
                    :role,
                    :status
                )";

            $pdoStatement = $pdo->prepare($sql);
            
            // exécuter la requête
            $success = $pdoStatement->execute([
                ':email' => $this->email,
                ':password' => $this->password,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':role' => $this->role,
                ':status' => $this->status
            ]);

            // mettre à jour l'id du model
            if ($success) {
                $this->id = $pdo->lastInsertId();
            }
            
            // ne pas oublier de retourner le succes de l'opération
            return $success;
        }
    }
