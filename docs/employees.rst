.. title:: Employees

`Back to index <index.rst>`_

=========
Employees
=========

.. contents::
    :local:


List Employees
``````````````

.. code-block:: php
    
    $result = $client->get('employees', [
        'page' => 0,
        'limit' => 50
    ]);


Get a Employee
``````````````

.. code-block:: php
    
    $id = 'id';
    $employee = $client->get("employees/$id");


Create a Employee
`````````````````

.. code-block:: php
    
    $employee = $client->post('employees', [
        'name' => 'string'
    ]);


Update a Employee
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->put("employees/$id", [
        'name' => 'string'
    ]);


Delete a Employee
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->delete("employees/$id");
