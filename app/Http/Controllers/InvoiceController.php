<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceCreateRequest;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use DB;
use Exception;
use Illuminate\Support\Str;

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
            $invoice = Invoice::findOrFail($id);
            $items = InvoiceItem::select(['price', 'qty', 'amount', 'name'])
                ->where(['iv_number' => $invoice->iv_number])->get();

            return $this->success('invoice detail is retrived successfully', [
                'invoice' => $invoice,
                'items' => $items,
            ]);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function store(InvoiceCreateRequest $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {

            $payload['iv_number'] = strtoupper(implode('', explode('-', Str::uuid()->toString())));

            collect($payload['items'])->map(function ($item) use ($payload) {
                $item['iv_number'] = $payload['iv_number'];
                $item['amount'] = $item['price'] * $item['qty'];
                $item['item_id'] = $item['id'];
                InvoiceItem::create($item);
            });

            $openInvoice = Invoice::create($payload->toArray());
            DB::commit();

            return $this->success('invoice is opened successfully', [
                'invoice' => $openInvoice,
                'items' => $payload['items'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }
}
