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
     * Show the view with form to create a new company.
     *
     * @return void
     */
    public function showCreateForm(): void
    {
        $data['companies_type'] = $this->companyTypes();

        $this->view('dashboard/dashboard_create_company', $data);
    }

    /**
     * Return the possibles companies types.
     *
     * @return \string[][]
     */
    private function companyTypes(): array
    {
        return [
            [
                'id' => '1',
                'type_name' => 'supplier'
            ],
            [
                'id' => '2',
                'type_name' => 'client'
            ]
        ];
    }

    /**
     * Submit the create form by calling tha appropriate controller.
     * Then redirect to dashboard company page with a success message in sent data's.
     * If no success : redirect to dashboard create company page with a fail message in sent data's.
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
     * Show the view with form to update the companies with provided id.
     * Send the company data to allow the possibility to prefill the form.
     *
     * @param $id
     * @return void
     */
    public function showUpdateForm($id): void
    {
        $data['companies'] = (new CompanyController())->read($id);
        $data['companies_type'] = $this->companyTypes();

        $this->view('dashboard/dashboard_update_company', $data);
    }

    /**
     * Submit the update form by calling tha appropriate controller.
     * Then redirect to dashboard companies page with a success message in sent data's.
     * If no success : redirect to dashboard crete company page with a fail message in sent data's.
     * If no success and id is not provided : redirect to all companies page.
     *
     * @param $inputs
     * @return void
     */
    public function showUpdateSubmit($inputs): void
    {
        $created = (new CompanyController())->update($inputs);

        if ($created === TRUE && array_key_exists("company_id", $inputs)) {
            $data['message'] = COMPANY_UPDATE_SUCCESS_MESSAGE;

            $this->showAll($data);
        } elseif ($created !== TRUE && array_key_exists("company_id", $inputs)) {
            $data['message'] = COMPANY_UPDATE_ERROR_MESSAGE;

            // todo: make message appear when redirect.
            redirect(getRoot().'/admin/company/update/'.$inputs['contact_id']);
        } elseif ($created !== TRUE && !(array_key_exists("company_id", $inputs))) {
            $data['message'] = COMPANY_UPDATE_ERROR_MESSAGE;

            $this->showAll($data);
        }
    }

    /**
     * Delete the COMPANY that have the provided id.
     * Then redirect to dashboard COMPANY page with a success message in sent data's.
     * If no success : redirect to dashboard COMPANY page with a fail message in sent data's.
     * @param $id
     * @return void
     */
    public function deleteEntry($id): void
    {
        $deleted = (new CompanyController())->delete($id);

        // todo : solve this : if entry does no exist SQL return no problem, when we try to delete non existent data, we should retrieve an error.
        if ($deleted === TRUE) {
            $data['message'] = COMPANY_DELETE_SUCCESS_MESSAGE;

            $this->showAll($data);
        } else {
            $data['message'] = COMPANY_DELETE_ERROR_MESSAGE;

            $this->showAll($data);
        }
    }
}