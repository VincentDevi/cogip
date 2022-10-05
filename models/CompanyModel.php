<?php

namespace App\models;

class CompanyModel extends CompanyQueries
{

    /**
     * Returns the data's from the company according to the provided ID.
     * If no id is provided, returns all the companies data's.
     *
     * @param $companyId
     * @return array
     */
    public function getCompanyData($id = NULL): array
    {
        // todo : return NULL and show error if fetch return nothing or empty array.
        if ($id) {
            $query = $this->getAllQuery();
            $rawData = $this->fetchData($query,["id"=>$id]);

            return [
                'companies' => $this->getCompany($rawData),
                'contacts' => removeDuplicateRows($this->getContactsInCompany($rawData)) ,
                'invoices' => removeDuplicateRows($this->getInvoicesInCompany($rawData))
            ];
        } else {
            return $this->getData('companies');
        }
    }

    private function getCompany($data) {
        return [
            'company_id' => $data[0]['company_id'],
            'company_name' => $data[0]['company_name'],
            'company_vat' => $data[0]['company_vat']
        ];
    }

    function mapContacts($data): array {
        return [
            'contact_id' => $data['contact_id'],
            'contact_name' => $data['contact_name'],
            'contact_firstname' => $data['contact_firstname'],
        ];
    }

    private function getContactsInCompany($data) {
        return array_map([$this, 'mapContacts'], $data);
    }

    private function mapInvoices($data) {
        return [
            'invoice_ref' => $data['invoice_ref'],
            'invoice_due_date' => $data['invoice_due_date'],
            'invoice_created_at' => $data['invoice_created_at'],
            'invoice_id' => $data['invoice_id']
        ];

    }

    private function getInvoicesInCompany($data) {
        return array_map([$this, 'mapInvoices'], $data);
    }

    public function getLastCompaniesData($limit) {
        return $this->getData("companies", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('companies');

        return $this->fetchData($query, NULL, $this);
    }
}