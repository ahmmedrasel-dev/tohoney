<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display Contact Page Front Design
    public function contact()
    {
        return view('Frontend.pages.contact');
    }

    //  Store Data in Database from Frontend From.
    public function contactStore(Request $request){
        $request->validate([
            'name' => ['required', 'min:4', 'max:30'],
            'email' => 'email:rfc,dns',
            'subject' => 'required',
            'message' => ['required',  'min:30', 'max:500']
        ]);

        $contactInfo = New Contact;
        $contactInfo->name = $request->name;
        $contactInfo->email = $request->email;
        $contactInfo->subject = $request->subject;
        $contactInfo->message = $request->message;
        $contactInfo->save();

        $notification = array(
            'message' => 'Message send successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    public function message()
    {
        return view('backend.message.message', [
            'messages' => Contact::latest()->simplepaginate(10),
        ]);
    }

    public function ajaxReadStatus($id)
    {
        Contact::where('id', $id)->update(['read_status' => 2]);
    }

    public function messageview($id)
    {
        return view('backend.message.messae-view', [
            'messages' => Contact::where('id', $id)->first(),
        ]);
    }

    public function messageSoftDelete($id)
    {
        Contact::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Message move to trash successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    public function messageTrash()
    {
        return view('backend.message.message-trash', [
            'messageTrashList' => Contact::onlyTrashed()->simplePaginate(10),
        ]);
    }

    public function messageRestore($id)
    {
        Contact::onlyTrashed()->findOrFail($id)->restore();

        $notification = array(
            'message' => 'Message restore successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }

    public function messageDestroy($id)
    {
        Contact::onlyTrashed()->findOrFail($id)->forceDelete();

        $notification = array(
            'message' => 'Message deleted successfully',
            'alert-type' => 'success'
        );
        // Toastr Alert
        return back()->with($notification);
    }
}
