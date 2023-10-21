<?php

namespace App\Actions\Order;

use App\Models\File;
use App\Models\Order;
use App\Models\User;
use App\Notifications\WriterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadFile
{

    public static function run(Order $order, Request $request)
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
        return redirect()->back()->with('success', 'New File Upload was successful.');
    }
}
