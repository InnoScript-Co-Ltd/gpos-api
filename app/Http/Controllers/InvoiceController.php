<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Exception;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $invoices = Invoice::sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            return $this->success('invoice list is retrived successfully', $invoices);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $invoice = Invoice::with(['items'])->findOrFail($id);

            return $this->success('invoice detail is retrived successfully', $invoice);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }
}
