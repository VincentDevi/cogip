<?php

namespace App\Controllers;

use App\Core\Controller;
use App\models\CompanyModel;
use App\models\ContactModel;
use App\models\InvoiceModel;

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
                "companies"  => (new CompanyModel())->getLastCompaniesData($limit),
                "invoices"=> (new InvoiceModel())->getLastInvoicesData($limit),
                "contacts"=> (new ContactModel())->getLastContactsData($limit),
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
                "companies" => (new CompanyModel())->getRowCount()[0],
                "invoices"=> (new InvoiceModel())->getRowCount()[0],
                "contacts"=> (new ContactModel())->getRowCount()[0]
            ];
    }
}
