<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Exception;

class InvoiceItemController extends Controller
{
    public function index()
    {
        try {
            $invoiceItems = InvoiceItem::sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            return $this->success('invoice items list is retrived successfully', $invoiceItems);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $invoiceItem = InvoiceItem::findOrFail($id);

            return $this->success('invoice item is retrived successfully', $invoiceItem);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }
}
