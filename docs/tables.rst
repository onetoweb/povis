.. title:: Tables

`Back to index <index.rst>`_

======
Tables
======

.. contents::
    :local:


List Tables
```````````

.. code-block:: php
    
    $result = $client->get('tables', [
        'page' => 0,
        'limit' => 50
    ]);


Get a Table
```````````

.. code-block:: php
    
    $id = 'id';
    $table = $client->get("tables/$id");


Update a Table
``````````````

.. code-block:: php
    
    $id = 'id';
    $client->put("tables/$id", [
        'waiter' => 'string',
        'locked' => true,
        'openedBy' => 'string',
        'customer' => 'string'
    ]);
 