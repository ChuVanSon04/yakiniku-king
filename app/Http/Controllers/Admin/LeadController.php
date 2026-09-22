<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::orderByDesc('id')->get();

        return view('admin.menu.leads.index', compact('leads'));
    }

    public function create()
    {
        return view('admin.menu.leads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'message' => 'nullable|string',

            'status' => 'required|in:new,read,contacted',
        ]);

        Lead::create($validated);

        return redirect()
            ->route('admin.menu.leads.index')
            ->with('success', 'Thêm lead thành công.');
    }

    public function show(Lead $lead)
    {
        return redirect()->route(
            'admin.menu.leads.edit',
            $lead
        );
    }

    public function edit(Lead $lead)
    {
        return view('admin.menu.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'message' => 'nullable|string',

            'status' => 'required|in:new,read,contacted',
        ]);

        $lead->update($validated);

        return redirect()
            ->route('admin.menu.leads.index')
            ->with('success', 'Cập nhật lead thành công.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
            ->route('admin.menu.leads.index')
            ->with('success', 'Xóa lead thành công.');
    }
}