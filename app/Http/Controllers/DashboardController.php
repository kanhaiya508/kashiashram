<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $bookings = \App\Models\Booking::count();
        $ashrams = \App\Models\Ashram::count();
        $rooms = \App\Models\Room::count();
        $users = \App\Models\User::count();

        return view('dashboard', compact('bookings', 'ashrams', 'rooms', 'users'));
    }


    public function upload(Request $request)    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/ckeditor', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = '/storage/ckeditor/' . $filenametostore;
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
