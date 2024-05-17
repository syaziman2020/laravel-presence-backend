<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function show($id = 1)
    {
        $company = Company::findOrfail($id);
        return view('pages.company.show', ['company' => $company]);
    }

    public function edit($id)
    {
        try {

            $company = Company::findOrFail($id);

            return response()->json($company);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), $e->getCode()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'address' => 'required|string',
                'radius_km' => 'required|numeric',
                'time_in' => ['required', 'date_format:H:i:s'],
                'time_out' => ['required', 'date_format:H:i:s'],
            ]);

            $company = Company::findOrFail($id);

            $company->update($request->all());

            return response()->json(['message' => 'Company updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), $e->getCode()]);
        }
    }
}
