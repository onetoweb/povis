.. title:: Taxes

`Back to index <index.rst>`_

=====
Taxes
=====

.. contents::
    :local:


List Tax Classes
````````````````

.. code-block:: php
    
    $taxClasses = $client->get('taxclasses');


Get a Tax Class
```````````````

.. code-block:: php
    
    $id = 'id';
    $taxClass = $client->get("taxclasses/$id");
