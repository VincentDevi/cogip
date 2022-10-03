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
            $query = "SELECT contacts_name, contacts_phone, email, companies.companies_name FROM contacts INNER JOIN companies ON companies.id=company_id WHERE contacts.id = :id ;";

            return $this->fetchData($query,["id"=>$contactId]);
        } else {
            return $this->getData('contacts');
        }
    }

    public function getLastContactsData($limit) {
        return $this->getData("contacts", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('contacts');

        return $this->fetchData($query, NULL, $this);
    }
}