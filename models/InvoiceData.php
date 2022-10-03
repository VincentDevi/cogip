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
}