.. title:: Orders

`Back to index <index.rst>`_

======
Orders
======

.. contents::
    :local:


List Orders
```````````

.. code-block:: php
    
    $result = $client->get('orders', [
        'page' => 0,
        'limit' => 50
    ]);


Get an Order
````````````

.. code-block:: php
    
    $id = 'id';
    $order = $client->get("orders/$id");


Create a Order
``````````````

.. code-block:: php
    
    $order = $client->post('orders', [
        'orderLines' => [
            [
                'productReference' => 'string',
                'units' => 0,
                'price' => 0,
                'attributeValueIds' => [
                    'string'
                ],
                'complementaryProducts' => [
                    [
                        'productReference' => 'string',
                        'units' => 0,
                        'price' => 0
                    ]
                ],
                'note' => 'string'
            ]
        ],
        'platform' => 'string',
        'externalReference' => 'string',
        'orderType' => 'takeaway',
        'isPaid' => true,
        'deliveryMethod' => 'pickup',
        'customerId' => 'string',
        'customer' => [
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
        ],
        'employeeId' => 'string',
        'note' => 'string',
        'requestedDeliveryTime' => '2019-08-24T14:15:22Z',
        'preferredPaymentMethod' => 'cash',
        'paysWith' => 0,
        'table' => 'string'
    ]);


Pay an Open Order
`````````````````

.. code-block:: php
    
    $id = 42;
    $order = $client->post("orders/$id/pay", [
        'paymentMethod' => 'cash',
        'amount' => 0,
        'deviceNumber' => 1,
        'employeeId' => 'string'
    ]);
