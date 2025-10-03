<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::orderBy('name')->get();
        return view('employers.index', compact('employers'));
    }


    public function edit(Employer $employer)
    {
        return view('employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employers,name,' . $employer->id,
            'logo' => ['nullable', File::types(['png', 'jpg', 'webp', 'svg'])],
        ]);

        $employer->name = $validated['name'];

        if ($request->hasFile('logo')) {
            $logoPath = $request->logo->store('logos');
            $employer->logo = $logoPath;
        }

        $employer->save();

        return redirect()
            ->route('employers.edit', $employer)
            ->with('success', 'Employer updated successfully.');
    }
}
