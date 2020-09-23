<?php
namespace ToDo\Models;

class ListEntity
{
    protected $id;
    protected $userId;
    protected $name;
    protected $description;
    protected $creationDate;
    protected $progressBar;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data) {
        if (isset($data['id']))
        {
            $this->setId($data['id']);
        }

        if (isset($data['user_id']))
        {
            $this->setUserId($data['user_id']);
        }

        if (isset($data['name']))
        {
            $this->setName($data['name']);
        }
        if (isset($data['description']))
        {
            $this->setDescription($data['description']);
        }
        if (isset($data['creation_date']))
        {
            $this->setCreationDate($data['creation_date']);
        }
        if (isset($data['progress_bar']))
        {
            $this->setProgressBar($data['progress_bar']);
        }
    }

    // Getters    
    public function id() {
        return $this->id;
    }

    public function userId() {
        return $this->userId;
    }

    public function name() {
        return $this->name;
    }

    public function description() {
        return $this->description;
    }

    public function creationDate() {
        return $this->creationDate;
    }

    public function progressBar() {
        return $this->progressBar;
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

    public function setUserId($userId)
    {
        $userId = (int)$userId;
        if ($userId > 0)
        {
            $this->userId = $userId;
        }
    }

    public function setName($name) {
        if (is_string($name))
        {
            $this->name = $name;
        }
    }

    public function setDescription($description) {
        if (is_string($description))
        {
            $this->description = $description;
        }
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setProgressBar($progressBar) {
        if ($progressBar == 0 || $progressBar == 1)
        {
            $this->progressBar = $progressBar;
        }
    }
}