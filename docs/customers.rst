.. title:: Customers

`Back to index <index.rst>`_

=========
Customers
=========

.. contents::
    :local:


List Customers
``````````````

.. code-block:: php
    
    $result = $client->get('customers', [
        'page' => 0,
        'limit' => 50
    ]);


Get a Customer
``````````````

.. code-block:: php
    
    $id = 'id';
    $customer = $client->get("customers/$id");


Create a Customer
`````````````````

.. code-block:: php
    
    $customer = $client->post('customers', [
        'address' => 'string',
        'name' => 'string',
        'postalCode' => 'string',
        'city' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'searchKey' => 'string',
        'address2' => 'string',
        'region' => 'string',
        'country' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'phone2' => 'string',
        'notes' => 'string',
        'visible' => true,
        'maxDebt' => 0,
        'curDebt' => 0,
        'accountNumber' => 'string'
    ]);


Update a Customer
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->put("customers/$id", [
        'address' => 'string',
        'name' => 'string',
        'postalCode' => 'string',
        'city' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'searchKey' => 'string',
        'address2' => 'string',
        'region' => 'string',
        'country' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'phone2' => 'string',
        'notes' => 'string',
        'visible' => true,
        'maxDebt' => 0,
        'curDebt' => 0,
        'accountNumber' => 'string'
    ]);


Delete a Customer
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->delete("customers/$id");
