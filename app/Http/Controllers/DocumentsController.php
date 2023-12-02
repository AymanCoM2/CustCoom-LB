<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function deleteBeforeApprove(Request $request)
    {
        $deletedDocument  = Documents::where('id', $request->docIdBeforeApprove)->first();
        $deletedDocument->delete();
        return back();
    }
    public function localGoogleDrive($cardCode)
    {
        $customer = Customers::where('CardCode', $cardCode)->first();
        if ($customer) {
            $customerDocs  = Documents::where('customer_id', $customer->id)->get();
        } else {
            $customerDocs = false;
        }
        return view('pages.local-google-drive', compact(['customerDocs', 'cardCode']));
    }


    public function standAloneLocalGoogleDrive($cardCode)
    {
        $customer = Customers::where('CardCode', $cardCode)->first();
        if ($customer) {
            $customerDocs  = Documents::where('customer_id', $customer->id)->get();
        } else {
            $customerDocs = false;
        }
        return view('pages.stand-lone-local-google-drive', compact(['customerDocs', 'cardCode']));
    }

    public function deleteCustomerDocument(Request $request)
    {
        $deletedDocument  = Documents::where('id', $request->docId)->first();
        $deletedDocument->delete();
        return  back();
    }

    public function restoreDocument(Request $request)
    {
        $documentId  = $request->docId;
        $document = Documents::withTrashed()->find($documentId);

        if ($document) {
            if ($document->trashed()) {
                $document->restore();
                return back();
            } else {
                return back();
            }
        } else {
            return back();
        }
    }
}
