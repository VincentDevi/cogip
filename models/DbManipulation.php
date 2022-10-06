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

//        print_r($query);

        return $this->executeQuery($query, $data);
    }

    /**
     * Delete the specified entry from the database.
     * Returns true if the operation was successful.
     *
     * @param $id
     * @return bool
     */
    public function deleteEntry($id): bool
    {
        $query = $this->deleteQuery();
        $data = [
            'id' => $id,
        ];

        return $this->executeQuery($query, $data);
    }
}