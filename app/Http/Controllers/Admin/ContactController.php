<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact): View
    {
        $contact->markAsRead();
        return view('admin.contacts.show', compact('contact'));
    }

    public function toggleRead(Contact $contact): RedirectResponse
    {
        if ($contact->is_read) {
            $contact->markAsUnread();
        } else {
            $contact->markAsRead();
        }
        return back()->with('success', 'Contact status updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
