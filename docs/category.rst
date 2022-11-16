.. title:: Categories

`Back to index <index.rst>`_

==========
Categories
==========

.. contents::
    :local:


List all Categories
```````````````````

.. code-block:: php
    
    $result = $client->get('categories', [
        'page' => 0,
        'size' => 50
    ]);


Get a Category
``````````````

.. code-block:: php
    
    $id = 'id';
    $category = $client->get("categories/$id");


Create a Category
`````````````````

.. code-block:: php
    
    $category = $client->post('categories', [
        'name' => 'string',
        'parentId' => 'string',
    ]);


Update a Category
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->put("categories/$id", [
        'name' => 'string',
        'parentId' => 'string',
    ]);


Delete a Category
`````````````````

.. code-block:: php
    
    $id = 'id';
    $client->delete("categories/$id");
