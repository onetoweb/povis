.. title:: ProductAttributes

`Back to index <index.rst>`_

=================
ProductAttributes
=================

.. contents::
    :local:


List Attribute Sets
```````````````````

.. code-block:: php
    
    $productAttributeSets = $client->get('productattributesets', [
        'page' => 0,
        'limit' => 50
    ]);


Get an Attribute Set
````````````````````

.. code-block:: php
    
    $id = '';
    $productAttributeSet = $client->get("productattributesets/$id");


Create an Attribute Set
```````````````````````

.. code-block:: php
    
    $productAttributeSet = $client->post('productattributesets', [
        'name' => 'clothing',
        'attributes' => [
            [
                'name' => 'size',
                'values' => [
                    [
                        'value' => 'L'
                    ], [
                        'value' => 'XL'
                    ]
                ]
            ], [
                'name' => 'color',
                'values' => [
                    [
                        'value' => 'red'
                    ], [
                        'value' => 'blue'
                    ]
                ]
            ]
        ]
    ]);


Add an Attribute Value
``````````````````````

.. code-block:: php
    
    $attributeId = 'attribute_id';
    $value = $client->post("productattributesets/attributes/$attributeId/values", [
        'value' => 'string',
    ]);


Delete an Attribute Set
```````````````````````

.. code-block:: php
    
    $id = 'id';
    $client->delete("productattributesets/$id");
