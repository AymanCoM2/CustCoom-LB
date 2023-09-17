<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Documents;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PdfUploadReuqest;
use Brian2694\Toastr\Facades\Toastr;

class LocalStorageController extends Controller
{
    public function handleUploadForm(PdfUploadReuqest $request)
    {
        $allPdfFiles  = $request->pdfFiles;
        $codeId  = $request->code;
        $customer = Customers::where('CardCode', $codeId)->first();
        if ($customer) {
            $customerId  = $customer->id;
        } else {
            $newCustomer =  new Customers();
            $newCustomer->CardCode = $codeId;
            $newCustomer->save();
            $customerId = $newCustomer->id;
        }

        foreach ($allPdfFiles as $aPdfFile) {
            $aDocument  = new Documents();
            $fileName  = $aPdfFile->getClientOriginalName();
            $mimeParts  = explode('/', $aPdfFile->getMimeType());
            $realExtension  = end($mimeParts);
            $newFileName  = time() . '--' . $fileName; // With timestamp
            $path = 'pdf/' . $codeId;
            $responsePath =  Storage::putFileAs(
                $path,
                $aPdfFile,
                $newFileName
            );
            $aDocument->path = $responsePath;
            $aDocument->customer_id  = $customerId;
            $aDocument->uploaded_id  = $request->user()->id; // TODO the Typo
            $aDocument->mimeType  = $realExtension;
            $aDocument->save();
        }
        Toastr::success('File successfully Uploaded.');
        return back();
    }

    public function getArchivedFiles($cardCode)
    {
        $selectedCustomer   = Customers::where('CardCode', $cardCode)->first();
        $customerId  = $selectedCustomer->id;

        $arcihedFiles =   Documents::onlyTrashed()
            ->where('customer_id', $customerId)
            ->get();
        return view('pages.archive-drive', compact(['arcihedFiles', 'cardCode']));
    }
}
