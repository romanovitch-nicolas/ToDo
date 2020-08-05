<?php
namespace ToDo\Models;

class Task
{
    protected $id;
    protected $userId;
    protected $listId;
    protected $name;
    protected $creationDate;
    protected $deadline;
    protected $important;
    protected $done;

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

        if (isset($data['list_id']))
        {
            $this->setListId($data['list_id']);
        }

        if (isset($data['name']))
        {
            $this->setName($data['name']);
        }

        if (isset($data['creation_date_fr']))
        {
            $this->setCreationDate($data['creation_date_fr']);
        }

        if (isset($data['deadline_date_fr']))
        {
            $this->setDeadlineDate($data['deadline_date_fr']);
        }

        if (isset($data['important']))
        {
            $this->setImportant($data['important']);
        }

        if (isset($data['done']))
        {
            $this->setDone($data['done']);
        }
    }

    // Getters    
    public function id() {
        return $this->id;
    }

    public function userId() {
        return $this->userId;
    }

    public function listId() {
        return $this->listId;
    }

    public function name() {
        return $this->name;
    }

    public function creationDate() {
        return $this->creationDate;
    }

    public function deadlineDate() {
        return $this->deadlineDate;
    }

    public function important() {
        return $this->important;
    }

    public function done() {
        return $this->done;
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

    public function setListId($listId)
    {
        $listId = (int)$listId;
        if ($listId > 0)
        {
            $this->listId = $listId;
        }
    }

    public function setName($name) {
        if (is_string($name))
        {
            $this->name = $name;
        }
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setDeadlineDate($deadlineDate)
    {
        $this->deadlineDate = $deadlineDate;
    }

    public function setImportant($important) {
        if ($important == 0 || $important == 1)
        {
            $this->important = $important;
        }
    }

    public function setDone($done) {
        if ($done == 0 || $done == 1)
        {
            $this->done = $done;
        }
    }
}