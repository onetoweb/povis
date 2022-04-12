.. title:: Products

`Back to index <index.rst>`_

========
Products
========

.. contents::
    :local:


List all Products
`````````````````

.. code-block:: php
    
    $result = $client->get('products', [
        'page' => 0,
        'limit' => 50
    ]);


Get a Product
`````````````

.. code-block:: php
    
    $id = 'id';
    $product = $client->get("products/$id");


Create a Product
````````````````

.. code-block:: php
    
    $product = $client->post('products', [
        'name' => 'string',
        'productCode' => 'string',
        'codeType' => 'string',
        'productReference' => 'string',
        'categoryId' => 'string',
        'priceSell' => 0,
        'priceBuy' => 0,
        'taxClassId' => 'string',
        'hasVariablePrice' => false,
        'stock' => 0,
        'tooltipText' => 'string',
        'attributeSetId' => 'string'
    ]);


Update a Product
````````````````

.. code-block:: php
    
    $id = 'id';
    $client->put("products/$id", [
        'name' => 'string',
        'productCode' => 'string',
        'codeType' => 'string',
        'productReference' => 'string',
        'categoryId' => 'string',
        'priceSell' => 0,
        'priceBuy' => 0,
        'taxClassId' => 'string',
        'hasVariablePrice' => false,
        'stock' => 0,
        'tooltipText' => 'string',
        'attributeSetId' => 'string'
    ]);


Delete a Product
````````````````

.. code-block:: php
    
    $id = 'id';
    $client->delete("products/$id");


Upsert Products in bulk
```````````````````````

.. code-block:: php
    
    $client->post('/products/bulk', [
        [
            'name' => 'string',
            'productCode' => 'string',
            'codeType' => 'string',
            'productReference' => 'string',
            'categoryId' => 'string',
            'priceSell' => 0,
            'priceBuy' => 0,
            'taxClassId' => 'string',
            'hasVariablePrice' => false,
            'stock' => 0,
            'tooltipText' => 'string',
            'attributeSetId' => 'string'
        ], [
            'name' => 'string',
            'productCode' => 'string',
            'codeType' => 'string',
            'productReference' => 'string',
            'categoryId' => 'string',
            'priceSell' => 0,
            'priceBuy' => 0,
            'taxClassId' => 'string',
            'hasVariablePrice' => false,
            'stock' => 0,
            'tooltipText' => 'string',
            'attributeSetId' => 'string'
        ]
    ]);


Patch Products in bulk
``````````````````````

.. code-block:: php
    
    $client->patch('/products/bulk', [
        [
            'name' => 'string',
            'productCode' => 'string',
            'codeType' => 'string',
            'productReference' => 'string',
            'categoryId' => 'string',
            'priceSell' => 0,
            'priceBuy' => 0,
            'taxClassId' => 'string',
            'hasVariablePrice' => false,
            'stock' => 0,
            'tooltipText' => 'string',
            'attributeSetId' => 'string'
        ], [
            'name' => 'string',
            'productCode' => 'string',
            'codeType' => 'string',
            'productReference' => 'string',
            'categoryId' => 'string',
            'priceSell' => 0,
            'priceBuy' => 0,
            'taxClassId' => 'string',
            'hasVariablePrice' => false,
            'stock' => 0,
            'tooltipText' => 'string',
            'attributeSetId' => 'string'
        ]
    ]);
