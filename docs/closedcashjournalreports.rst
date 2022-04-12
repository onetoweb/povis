.. title:: ClosedCashJournalReports

`Back to index <index.rst>`_

========================
ClosedCashJournalReports
========================

.. contents::
    :local:


Get a list of summaries of financial transactions
`````````````````````````````````````````````````

.. code-block:: php
    
    $result = $client->get('closedcashjournalreports', [
        'page' => 0,
        'limit' => 50
    ]);


Get a single summary of financial transaction
`````````````````````````````````````````````
    
.. code-block:: php
    
    $hostSequence = 42;
    $closedcashjournalreport = $client->get("closedcashjournalreports/$hostSequence");
