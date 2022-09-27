<?php

namespace App\Http\Controllers;

use App\Models\counter;
use App\Models\invoice;
use App\Models\invoiceItem;
use Illuminate\Http\Request;

class invoiceController extends Controller
{

    public function get_all_invoice()
    {
        $invoices = invoice::with('customer')->orderBy('id', 'DESC')->get();
        return response()->json([
            'invoices' => $invoices
        ], 200);
    }


    public function search_invoice(Request $request)
    {
        $search = $request->get('s');
        if ($search != null) {
            $invoices = invoice::with('customer')
                ->where('id', 'LIKE', "%$search%")
                ->get();
            return response()->json([
                'invoices' => $invoices
            ], 200);
        } else {
            return $this->get_all_invoice();
        }
    }

    public function create_invoice(Request $request)
    {
        $counter = counter::where('key', 'facture')->first();
        $random =  $counter = counter::where('key', 'facture')->first();

        $invoice = invoice::orderBy('id', 'DESC')->first();

        if ($invoice) {
            $invoice = $invoice->id + 1;
            $counters = $counter->value + $invoice;
        } else {
            $counters = $counter->value;
        }
        $formData = [
            'number' => $counter->prefix . $counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => 'Default Terms and Conditions',
            'items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1,
                ]
            ]
        ];
        return response()->json($formData);
    }

    public function add_invoice(Request $request){

        $invoiceitem = $request->input("invoice_item");
        $invoicedata['sub_total'] = $request->input("subtotal");
        $invoicedata['total'] = $request->input("total");
        $invoicedata['customer_id'] = $request->input("customer_id");
        $invoicedata['number'] = $request->input("number");
        $invoicedata['date'] = $request->input("date");
        $invoicedata['due_date'] = $request->input("due_date");
        $invoicedata['discount'] = $request->input("discount");
        $invoicedata['reference'] = $request->input("reference");
        $invoicedata['terms_and_conditions'] = $request->input("terms_and_conditions");

        $invoice = invoice::create($invoicedata);

        foreach (json_decode($invoiceitem) as $item){
            $itemdata['product_id'] = $item->id;
            $itemdata['invoice_id'] = $invoice->id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;
            invoiceItem::create($itemdata);
        }

    }
    public function show_invoice($id){
        $invoice = Invoice::with(['customer','invoice_items.product'])->find($id);
        return response()->json([
          'invoices' => $invoice
        ],200);
      }

    public function edit_invoice($id){
        $invoice = invoice::with(['customer', 'invoice_items.product'])->find($id);
        return response()->json([
            'invoices' => $invoice
        ],200);
    }

    public function delete_invoice_items($id)
    {
        $invoiceitem = invoiceItem::findOrFail($id);
        $invoiceitem->delete();
    }

    public function update_invoice(Request $request, $id){
        $invoice = invoice::where('id',$id)->first();
        $invoice->sub_total = $request->subtotal;
        $invoice->total = $request->total;
        $invoice->customer_id = $request->customer_id;
        $invoice->number = $request->number;
        $invoice->date = $request->date;
        $invoice->due_date = $request->due_date;
        $invoice->discount = $request->discount;
        $invoice->reference = $request->reference;
        $invoice->terms_and_conditions = $request->terms_and_conditions;

        $invoice->update($request->all());

        $invoiceitem = $request->input("invoice_item");
        $invoice->invoice_items()->delete();
        foreach(json_decode($invoiceitem) as $item){

            $itemdata['product_id'] = $item->product_id;
            $itemdata['invoice_id'] = $invoice->id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;
            invoiceItem::create($itemdata);

        }
    }
        public function delete_invoice($id)
        {
            $invoice = invoice::findOrFail($id);
            $invoice->invoice_items()->delete();
            $invoice->delete();
        }

    }

