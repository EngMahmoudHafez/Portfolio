<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        protected ContactRepository $contactRepo,
    ) {}

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $this->contactRepo->create($request->validated());

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
