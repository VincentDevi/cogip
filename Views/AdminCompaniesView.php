<?php

namespace App\Views;

use App\Controllers\AdminCompanyController;
use App\Controllers\CompanyController;
use App\Controllers\ContactController;

class AdminCompaniesView extends Views
{
    public function showAll($incomingData = null) {
        $data = (new AdminCompanyController())->read();

        if ($incomingData) $data = array_merge($data, $incomingData);

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

            $this->view('dashboard/dashboard_create_company', $data);
        }
    }

    /**
     * Delete the contact that have the provided id.
     * Then redirect to dashboard contacts page with a success message in sent data's.
     * If no success : redirect to dashboard contacts page with a fail message in sent data's.
     * @param $id
     * @return void
     */
    public function deleteEntry($id): void
    {
        $deleted = (new CompanyController())->delete($id);

        // todo : solve this : if entry does no exist SQL return no problem, when we try to delete non existent data, we should retrieve an error.
        if ($deleted === TRUE) {
            $data['message'] = COMPANY_DELETE_SUCCESS_MESSAGE;

            $this->view('dashboard/dashboard_companies', $data);
        } else {
            $data['message'] = COMPANY_DELETE_ERROR_MESSAGE;

            $this->view('dashboard/dashboard_companies', $data);
        }
    }
}