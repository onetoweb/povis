.. title:: Index

===========
Basic Usage
===========

Setup client

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    session_start();
    
    use Onetoweb\Povis\Client;
    use Onetoweb\Povis\Token;
    
    // params
    $apiKey = 'api_key';
    $clientId = 'client_id';
    $clientSecret = 'client_secret';
    $posId = 'pos_id';
    $testModus = true;
    
    // get client
    $client = new Client($apiKey, $clientId, $clientSecret, $posId, $testModus);
    
    // load token from storage
    if (isset($_SESSION['token'])) {
        
        $token = new Token(
            $_SESSION['token']['value'],
            $_SESSION['token']['expires']
        );
        
        $client->setToken($token);
    }
    
    // set update token callback
    $client->setUpdateTokenCallback(function(Token $token) {
        
        // store token
        $_SESSION['token'] = [
            'value' => $token->getValue(),
            'expires' => $token->getExpires()
        ];
        
    });


========
Examples
========

* `Applications <applications.rst>`_
* `ClosedCashJournalReports <closedcashjournalreports.rst>`_
* `Category <category.rst>`_
* `Customers <customers.rst>`_
* `Employees <employees.rst>`_
* `Orders <orders.rst>`_
* `Products <products.rst>`_
* `ProductAttributes <productattributes.rst>`_
* `Taxes <taxes.rst>`_
* `Floors <floors.rst>`_
* `Tables <tables.rst>`_
* `Login <login.rst>`_
