<?php

namespace App\models;

class InvoiceData extends DbData
{
    /**
     * Returns the data's from all the invoices.
     *
     * @param $contactId
     * @return array
     */
    public function getInvoiceData(): array
    {
        return $this->getData('invoices');
    }

    public function getLastInvoicesData($limit) {
        return $this->getData("invoices", $limit);
    }

    public function getRowCount() {
        $query = $this->getRowCountQuery('invoices');

        return $this->fetchData($query, NULL, $this);
    }
}