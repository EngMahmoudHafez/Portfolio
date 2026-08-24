<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $subscribers = Newsletter::query()
            ->when($search, fn ($query) => $query->where('email', 'like', "%{$search}%"))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.newsletter.index', [
            'subscribers' => $subscribers,
            'search' => $search,
            'activeCount' => Newsletter::where('is_active', true)->count(),
            'totalCount' => Newsletter::count(),
        ]);
    }

    public function toggle(Newsletter $newsletter): RedirectResponse
    {
        $newsletter->update(['is_active' => ! $newsletter->is_active]);

        return back()->with('success', 'Subscriber ' . ($newsletter->is_active ? 'reactivated.' : 'unsubscribed.'));
    }

    public function destroy(Newsletter $newsletter): RedirectResponse
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletter.index')->with('success', 'Subscriber removed.');
    }

    /**
     * Stream the active subscriber list as CSV.
     */
    public function export(): StreamedResponse
    {
        $filename = 'logicore-subscribers-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['email', 'status', 'subscribed_at']);

            Newsletter::orderBy('created_at')->chunk(500, function ($subscribers) use ($handle) {
                foreach ($subscribers as $subscriber) {
                    fputcsv($handle, [
                        $subscriber->email,
                        $subscriber->is_active ? 'active' : 'unsubscribed',
                        $subscriber->created_at?->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
