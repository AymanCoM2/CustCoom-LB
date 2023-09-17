<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function deleteBeforeApprove(Request $request)
    {
        // docIdBeforeApprove
        $deletedDocument  = Documents::where('id', $request->docIdBeforeApprove)->first();
        $deletedDocument->delete();
        // TODO unlinking Files 
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
        // $request->docId ; 
        $deletedDocument->delete();
        // TODO unlinking Files  From storage 
        return  back();
    }

    public function restoreDocument(Request $request)
    {
        $documentId  = $request->docId;
        $document = Documents::withTrashed()->find($documentId);

        if ($document) {
            // Check if the document is soft-deleted
            if ($document->trashed()) {
                // Restore the soft-deleted document
                $document->restore();
                // Optionally, you can return a back i;ndicating success
                return back();
            } else {
                // The document is not soft-deleted, so you can handle this case accordingly
                return back();
            }
        } else {
            // Document with the given ID not found, you can handle this case accordingly
            return back();
        }
    }
}
