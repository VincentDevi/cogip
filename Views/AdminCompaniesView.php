<?php

namespace App\Views;

use App\Controllers\AdminCompanyController;
use App\Controllers\CompanyController;

class AdminCompaniesView extends Views
{
    public function showAll() {
        $data = (new AdminCompanyController())->read();
        $this->view('dashboard/dashboard_companies', $data);
    }

    /**
     * Show the view with form to create a new contact.
     * Send the companies data's to allow the possibility to create
     * a select input with companies.
     *
     * @return void
     */
    public function showCreateForm(): void
    {
        $this->view('dashboard/dashboard_create_company');
    }

    /**
     * Submit the create form by calling tha appropriate controller.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard crete contact page with a fail message in sent data's.
     *
     * @param $inputs
     * @return void
     */
    public function showCreateSubmit($inputs): void
    {
        $created = (new CompanyController())->create($inputs);

        if ($created === TRUE) {
            $data['message'] = COMPANY_CREATION_SUCCESS_MESSAGE;

            $this->showAll($data);
        } else {
            $data['message'] = COMPANY_CREATION_ERROR_MESSAGE;

            $this->view('dashboard/dashboard_create_contact', $data);
        }
    }
}