<?php

namespace App\Views;

use App\Controllers\CompanyController;
use App\Controllers\ContactController;
use App\Controllers\InvoiceController;

class AdminInvoicesView extends Views
{
    public function showAll($incomingData = null): void
    {
        $data = (new InvoiceController())->read();

        if ($incomingData) $data = array_merge($data, $incomingData);

        $this->view('dashboard/dashboard_invoices', $data);
    }

    /**
     * Show the view with form to create a new invoice.
     *
     * @return void
     */
    public function showCreateForm(): void
    {
        $data['companies'] = (new CompanyController())->read();

        $this->view('dashboard/dashboard_create_invoice', $data);
    }

    /**
     * Submit the create form by calling tha appropriate controller.
     * Then redirect to dashboard invoices page with a success message in sent data's.
     * If no success : redirect to dashboard crete invoices page with a fail message in sent data's.
     *
     * @param $inputs
     * @return void
     */
    public function showCreateSubmit($inputs): void
    {
        $created = (new InvoiceController())->create($inputs);

        if ($created === TRUE) {
            $data['message'] = INVOICE_CREATION_SUCCESS_MESSAGE;

            $this->showAll($data);
        } else {
            $data['message'] = INVOICE_CREATION_ERROR_MESSAGE;

            $this->view('dashboard/dashboard_create_invoice', $data);
        }
    }




    /**
     * Delete the invoice that have the provided id.
     * Then redirect to dashboard invoices page with a success message in sent data's.
     * If no success : redirect to dashboard invoices page with a fail message in sent data's.
     * @param $id
     * @return void
     */
    public function deleteEntry($id): void
    {
        $deleted = (new InvoiceController())->delete($id);

        // todo : solve this : if entry does no exist SQL return no problem, when we try to delete non existent data, we should retrieve an error.
        if ($deleted === TRUE) {
            $data['message'] = INVOICE_DELETE_SUCCESS_MESSAGE;

        } else {
            $data['message'] = INVOICE_DELETE_ERROR_MESSAGE;

        }
        $this->showAll($data);
    }
}