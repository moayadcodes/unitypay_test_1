<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        // TODO: Get companies along with its total users

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
        $company->load('users:id');
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

    // TODO: Write functions like show, update, showCompanyUsers and addUserToCompany here
}
