<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('users')->get();

        return view('companies.index', ['companies' => $companies]);
    }

    public function add()
    {
        return view('companies.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Company $company, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function addUsers(Company $company)
    {
        $users = User::orderBy('name')->get();

        return view('companies.add-users', compact('company', 'users'));
    }

    public function updateUsers(Company $company, Request $request)
    {
        $validatedData = $request->validate([
            'users.*.id' => 'nullable|numeric|integer|exists:users,id',
        ]);

        $user_ids = isset($validatedData['users']) ? collect($validatedData['users'])->pluck('id') : [];

        $company->users()->sync($user_ids);

        return redirect()->route('companies.index')->with('success', "{$company->name} users successfully updated");
    }
}
