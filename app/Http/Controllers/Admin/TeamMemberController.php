<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamMemberRequest;
use App\Models\TeamMember;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function index(): View
    {
        $members = TeamMember::ordered()->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.team.form');
    }

    public function store(TeamMemberRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->upload($request->file('photo'), 'team');
        }
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team.form', ['member' => $teamMember]);
    }

    public function update(TeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->replace($teamMember->photo, $request->file('photo'), 'team');
        }
        $teamMember->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $this->imageService->delete($teamMember->photo);
        $teamMember->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
