<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\FileUploaded;
use App\Models\File;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFile
{

    /**
     * upload files in the incoming request
     */
    public static function run(Order $order, Request $request): bool
    {
        foreach ($request->file() as $filer) {
            foreach ($filer as $file) {
                $filename = $order->id.'_'.$file->getClientOriginalName();
                $newFile = new File([
                    'order_id' => $order->id,
                    'type' => $request->fileType,
                    'name' => $filename,
                    'location' => Storage::putFileAs('orders', $file, $filename ),
                    'uploaded_by' => \auth()->user()->role
                ]);
                $newFile->save();
            }
        }

        (new FileUploaded($order))->notify();

        return true;
    }
}
