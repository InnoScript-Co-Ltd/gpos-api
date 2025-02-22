<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceCreateRequest;
use App\Models\Invoice;
use DB;
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

    public function store(InvoiceCreateRequest $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {

            $openInvoice = '';
            DB::commit();

            return $this->success('invoice is opened successfully', $openInvoice);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }
}
