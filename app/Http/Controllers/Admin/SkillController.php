<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::ordered()->paginate(20);
        return view('admin.skills.index', compact('skills'));
    }

    public function create(): View
    {
        return view('admin.skills.form');
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        Skill::create($request->validated());
        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
