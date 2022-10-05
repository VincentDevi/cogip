<?php

namespace App\models;

class ContactData extends ContactQueries
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

    public function createContact($data): bool
    {
        $query = $this->createQuery();

        return $this->executeQuery($query, $data);
    }

    public function updateContact($data): bool
    {
        $query = $this->updateQuery();

        return $this->executeQuery($query, $data);
    }

    public function deleteContact($id): bool
    {
        $query = $this->deleteQuery();
        $data = [
            'id' => $id,
        ];

        return $this->executeQuery($query, $data);
    }

    public function getLastContactsData($limit): array
    {
        return $this->getData("contacts", $limit);
    }

    public function getRowCount(): array
    {
        $query = $this->getRowCountQuery('contacts');

        return $this->fetchData($query);
    }
}