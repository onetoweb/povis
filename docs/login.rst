.. title:: Login

`Back to index <index.rst>`_

=====
Login
=====

.. contents::
    :local:


Login at the POS
````````````````

.. code-block:: php
    
    $client->post('login', [
        'posUsername' => 'string',
        'posPassword' => 'pa$$word',
        'sessionId' => 'string'
    ]);


Logout at the POS
`````````````````

.. code-block:: php
    
    $client->post('logout');
