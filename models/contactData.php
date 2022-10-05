<?php

namespace App\models;

class contactData extends DbData
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

            $query = $this->getQuery();

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

    private function getQuery(): string
    {
        return "
                SELECT contacts_name AS name, 
                       contacts_firstname AS firstname,
                       contacts_phone AS phone, 
                       email, 
                       companies.companies_name AS company_name, 
                       companies.id AS company_id, 
                       contacts.id AS contact_id
                FROM contacts
                INNER JOIN companies
                ON companies.id=company_id
                WHERE contacts.id = :id ;
            ";
    }

    private function createQuery(): string
    {
        return "
                INSERT INTO contacts 
                            (
                             contacts_name, 
                             contacts_firstname,
                             company_id, 
                             email, 
                             contacts_phone, 
                             contacts_created_at, 
                             contacts_updates_at
                             ) 
                VALUES (
                        :name,
                        :firstname,
                        :company_id, 
                        :email, 
                        :phone, 
                        :created_at, 
                        :updated_at
                        ) ;
            ";
    }

    private function updateQuery(): string
    {
        return "
                UPDATE contacts
                SET contacts_name = :name,
                    contacts_firstname = :firstname, 
                    email = :email, 
                    contacts_phone = :phone, 
                    company_id = :company_id, 
                    contacts_updates_at = :updated_at 
                WHERE id = :contact_id;
        ";
    }

    private function deleteQuery(): string
    {
        return "
                DELETE FROM contacts 
                WHERE id = :id;
        ";

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