<?php

namespace App\models;

class InvoiceModel extends InvoiceQueries
{
    /**
     * Returns the data's from all the invoices.
     *
     * @param $contactId
     * @return array
     */
    public function getInvoiceData($id = NULL): array
    {
        if ($id) {
            $query = $this->getQuery();

            return $this->fetchData($query,["id"=>$id]);
        } else {
            return $this->getData('invoices');
        }
    }

    public function getLastInvoicesData($limit) {
        return $this->getData("invoices", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('invoices');

        return $this->fetchData($query, NULL, $this);
    }
}