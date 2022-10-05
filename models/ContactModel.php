<?php

namespace App\models;

class ContactModel extends ContactQueries
{
    /**
     * Returns the data's from the company according to the provided ID.
     * If no id is provided, returns all the companies data's.
     *
     * @param $contactId
     * @return array
     */
    public function getContactData($contactId = NULL): array
    {
        if($contactId) {

            $query = $this->getUniqueQuery();

            return $this->fetchData($query,["id"=>$contactId]);
        } else {
            return $this->getData('contacts');
        }
    }

    /**
     * Create a new contact with the specified data's.
     * Returns TRUE if successful.
     *
     * @param $data
     * @return bool
     */
    public function createContact($data): bool
    {
        $query = $this->createQuery();

        return $this->executeQuery($query, $data);
    }

    /**
     * Update a contact with the specified data's.
     * Returns true if the update was successful.
     *
     * @param $data
     * @return bool
     */
    public function updateContact($data): bool
    {
        $query = $this->updateQuery();

        return $this->executeQuery($query, $data);
    }

    /**
     * Delete the specified contact from the database.
     * Returns true if the operation was successful.
     *
     * @param $id
     * @return bool
     */
    public function deleteContact($id): bool
    {
        $query = $this->deleteQuery();
        $data = [
            'id' => $id,
        ];

        return $this->executeQuery($query, $data);
    }

    /**
     * Returns the n last Contacts data's, where n is the provided number.
     *
     * @param $limit
     * @return array
     */
    public function getLastContactsData($limit): array
    {
        return $this->getData("contacts", $limit);
    }

    /**
     * Get number of entries in the database for the contacts.
     *
     * @return array
     */
    public function getRowCount(): array
    {
        $query = $this->getRowCountQuery('contacts');

        return $this->fetchData($query);
    }
}