.. title:: Floors

`Back to index <index.rst>`_

======
Floors
======

.. contents::
    :local:


List Floors
```````````

.. code-block:: php
    
    $result = $client->get('floors', [
        'page' => 0,
        'limit' => 50
    ]);


Get a Floor
```````````

.. code-block:: php
    
    $id = 'id';
    $floor = $client->get("floors/$id");
