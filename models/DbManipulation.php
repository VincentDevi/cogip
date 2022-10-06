<?php

namespace App\models;

class DbManipulation extends DbData
{
    /**
     * Create a new entry with the specified data's.
     * Returns TRUE if successful.
     *
     * @param $data
     * @return bool
     */
    public function createEntry($data): bool
    {
        $query = $this->createQuery();

        print_r($query);

        return $this->executeQuery($query, $data);
    }
}