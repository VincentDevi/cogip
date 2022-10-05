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

        $data['created_at'] = todayDate();
        $data['updated_at'] = todayDate();

        return $this->createEntry($query, $data);
    }

    private function getQuery(): string
    {
        return "
                SELECT contacts_name AS name, 
                       contacts_firstname AS firstname,
                       contacts_phone AS phone, 
                       email, 
                       companies.companies_name AS company_name
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
                ( contacts_name, 
                 contacts_firstname,
                 company_id, 
                 email, 
                 contacts_phone, 
                 contacts_created_at, 
                 contacts_updates_at) 
                VALUES (
                        :name,
                        :firstname,
                        :company_id, 
                        :email, 
                        :phone, 
                        :created_at, 
                        :updated_at) ;
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