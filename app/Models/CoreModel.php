<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    // méthodes abstraites = les classes filles seront forcées de les implémenter. Ici on ne déclare que les signatures (visibilité + nom + paramètres)
    abstract public function insert(); // create
    abstract static public function find($id); // read
    abstract static public function findAll(); // read
    abstract public function update(); // update
    abstract public function delete(); // delete


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }

     /**
     * Is this resource already persisted or not?
     *
     * @return bool
     */
    public function isPersisted()
    {
        return $this->id > 0;
    }

    // on prévoit une seule méthode pour faire toutes les opérations d'enregistrement (update et insert)
    public function save()
    {
        // ici, on est certain d'avoir une méthode update() et un méthode insert(), car elles sont déclarée abstract
        if ($this->isPersisted()) {
            // si le model est déjà présent en base de données (sur la  base de son id),
            // on fait un update et on oublie pas de relayer la valeur retournée par update()
            return $this->update(); 
        } else {
            // sinon => c'est un nouveau model
            // on fait un insert et on oublie pas de relayer la valeur retournée par update()
            return $this->insert();
        }
    }
}
