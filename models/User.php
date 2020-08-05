<?php
namespace ToDo\Models;

class User
{
    protected $id;
    protected $login;
    protected $pass;
    protected $mail;
    protected $inscriptionDate;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data) {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }

        if (isset($data['login']))
        {
            $this->setLogin($data['login']);
        }

        if (isset($data['pass']))
        {
            $this->setPass($data['pass']);
        }
        if (isset($data['mail']))
        {
            $this->setMail($data['mail']);
        }
        if (isset($data['inscription_date']))
        {
            $this->setInscriptionDate($data['inscription_date']);
        }
    }

    // Getters    
    public function id() {
        return $this->id;
    }

    public function login() {
        return $this->login;
    }

    public function pass() {
        return $this->pass;
    }

    public function mail() {
        return $this->mail;
    }

    public function inscriptionDate() {
        return $this->inscriptionDate;
    }

    // Setters
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0)
        {
            $this->id = $id;
        }
    }

    public function setLogin($login) {
        if (is_string($login))
        {
            $this->login = $login;
        }
    }

    public function setPass($pass) {
        if (is_string($pass))
        {
            $this->pass = $pass;
        }
    }

    public function setMail($mail) {
        if (is_string($mail))
        {
            $this->mail = $mail;
        }
    }

    public function setInscriptionDate($inscriptionDate)
    {
        $this->inscriptionDate = $inscriptionDate;
    }
}