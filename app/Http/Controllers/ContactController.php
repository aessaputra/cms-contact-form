<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ContactController extends Controller
{
    protected $contactService;

    /**
     * Inject ContactService dependency.
     *
     * @param  ContactService  $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the contacts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all contacts from the service
        $contacts = $this->contactService->getAllContacts();
        
        // Number of items per page
        $perPage = 10;
        
        // Convert array to collection if it's not already
        $contactsCollection = collect($contacts);
        
        // Get current page from request
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        // Slice the collection to get the items to display in current page
        $currentPageItems = $contactsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        // Create our paginator
        $paginatedContacts = new LengthAwarePaginator(
            $currentPageItems,
            $contactsCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
        
        return view('contacts.index', ['contacts' => $paginatedContacts]);
    }

    /**
     * Show the form for creating a new contact.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created contact in the API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email:rfc,dns',
            'phone'   => 'required|max:20',
            'message' => 'required|max:500',
        ]);

        $contact = $this->contactService->createContact($validatedData);

        if ($contact) {
            return redirect()->route('contacts.index')
                             ->with('success', 'Contact created successfully.');
        }

        return back()->withErrors(['error' => 'Failed to create contact.'])->withInput();
    }

    /**
     * Display the specified contact.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $contact = $this->contactService->getContactById($id);

        if ($contact) {
            return view('contacts.show', compact('contact'));
        }

        return redirect()->route('contacts.index')
                         ->withErrors(['error' => 'Contact not found.']);
    }

    /**
     * Show the form for editing the specified contact.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $contact = $this->contactService->getContactById($id);

        if ($contact) {
            return view('contacts.edit', compact('contact'));
        }

        return redirect()->route('contacts.index')
                         ->withErrors(['error' => 'Contact not found.']);
    }

    /**
     * Update the specified contact in the API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email:rfc,dns',
            'phone'   => 'required|max:20',
            'message' => 'required|max:500',
        ]);

        $contact = $this->contactService->updateContact($id, $validatedData);

        if ($contact) {
            return redirect()->route('contacts.index')
                             ->with('success', 'Contact updated successfully.');
        }

        return back()->withErrors(['error' => 'Failed to update contact.'])->withInput();
    }

    /**
     * Remove the specified contact from the API.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $success = $this->contactService->deleteContact($id);

        if ($success) {
            return redirect()->route('contacts.index')
                             ->with('success', 'Contact deleted successfully.');
        }

        return back()->withErrors(['error' => 'Failed to delete contact.']);
    }
}
