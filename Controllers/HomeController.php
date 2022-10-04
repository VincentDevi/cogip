<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyData;
use App\models\contactData;
use App\models\InvoiceData;

class HomeController extends Controller
{
    /**
     * Returns the last five companies, invoices, contacts
     * and number of entries in companies, invoices, contacts.
     *
     * @param int $limit
     * @return array
     */
    public function read(int $limit = SHORT_LIST_ITEM_QUANTITY): array
    {
        return [
                "companies"  => (new CompanyData())->getLastCompaniesData($limit),
                "invoices"=> (new InvoiceData())->getLastInvoicesData($limit),
                "contacts"=> (new contactData())->getLastContactsData($limit),
                "stats"=> $this->getStats()
            ];
    }

    /**
     * Returns number of entries in companies, invoices, contacts.
     *
     * @return array
     */
    private function getStats(): array
    {
        return [
                "companies" => (new CompanyData())->getRowCount()[0],
                "invoices"=> (new InvoiceData())->getRowCount()[0],
                "contacts"=> (new contactData())->getRowCount()[0]
            ];
    }
}
