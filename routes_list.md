# Routes list.

## General ( yellow ).

- / : homepage
- /companies : show all companies
- /contacts : show all contacts
- /invoices : show all invoices
- /contact/*contactId* : show contact that has id *contactId*
- /company/*companyId* : show company that has id *companyId*

## Dashboard / Admin ( purple )

- /admin : show admin dashboard home. template : dashboard/dashboard_home
- /admin/contacts : show admin contacts list. template : dashboard/dashboard_contacts
- /admin/companies : show admin companies list. template : dashboard/dashboard_companies
- /admin/invoices : show admin invoice list. template : dashboard/dashboard_invoices
- /admin/contact/create : show admin contact create. template : dashboard/dashboard_create_contact. Redirect to the page /admin/contacts with a positive confirmation message. or /admin/create with a negative confirmation message.
- /admin/contact/update/*contactId* : show admin contact update that has id *contactId*. template : dashboard/dashboard_update_contact. Redirect to the page /admin/contacts with a positive confirmation message. or /admin/create with a negative confirmation message.
  /admin/contact/delete/*contactId* : delete the contact with that has id *contactId*. Redirect to the page /admin/contacts with a confirmation message.
- /admin/company/create : show admin company create. template : dashboard/dashboard_create_company
- /admin/company/update/*companyId* : show admin company update that has id *companyId*. template : dashboard/dashboard_update_company
- /admin/invoice/create : show admin invoice create. template : dashboard/dashboard_create_invoice
- /admin/invoice/update/*invoiceId* : show admin invoice update that has id *invoiceId*. template : dashboard/dashboard_update_invoice

## Submit routes

- /admin/contact/create : Send form to PHP to create a new contact.
- /admin/contact/update : Send form to PHP to update a contact.

- /submitest : test submitting forms. Template : test/submit_test . Use it as example for forms.