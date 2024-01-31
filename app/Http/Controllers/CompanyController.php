<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

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

    // TODO: Write functions like show, update, showCompanyUsers and addUserToCompany here
}
