.. title:: Applications

`Back to index <index.rst>`_

============
Applications
============

.. contents::
    :local:


Get general information of a system
```````````````````````````````````

.. code-block:: php
    
    $result = $client->get('applications', [
        'page' => 0,
        'size' => 50
    ]);
