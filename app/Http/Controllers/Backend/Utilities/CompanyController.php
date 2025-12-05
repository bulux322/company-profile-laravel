<?php

namespace App\Http\Controllers\Backend\Utilities;

use App\Helpers\StoreFileHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Utilities\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $title = 'Company';
        $company = Company::all()->first();

        return view('backend.utilities.company.index', compact('title', 'company'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name' => 'required',
            'nickname' => 'required|max:12',
            'logos' => 'nullable|max:800',
            'ico' => 'nullable|max:500',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'description' => 'nullable'
        ];

        $request->validate($rule);

        DB::beginTransaction();
        try {
            $findCompany = Company::all()->first();

            if ($findCompany == null) {
                $company = new Company;
                $company->name = $request->name;
                $company->nickname = $request->nickname;
                if ($request->hasFile('logos')) {
                    $logos = $request->file('logos');
                    $logosName = $request->name . "-" . Str::random(5);
                    $storeLogos = StoreFileHelper::storeLogos($logosName, $logos->getClientOriginalExtension());

                    $company->logos = $request->file('logos')->storeAs($storeLogos, $logos->getClientOriginalName(), 'public');
                }
                if ($request->hasFile('ico')) {
                    $ico = $request->file('ico');
                    $icoName = $request->name . "-" . Str::random(5);
                    $storeIco = StoreFileHelper::storeIco($icoName, $ico->getClientOriginalExtension());

                    $company->ico = $request->file('ico')->storeAs($storeIco, $ico->getClientOriginalName(), 'public');
                }
                $company->address = $request->address;
                $company->phone_number = $request->phone_number;
                $company->email = $request->email;
                $company->description = $request->description;
                $company->save();
            } else {
                $company = $findCompany;
                $company->name = $request->name;
                $company->nickname = $request->nickname;
                if ($request->hasFile('logos')) {
                    if ($company->logos !== null) {
                        Storage::delete($company->logos);
                    }
                    $logos = $request->file('logos');
                    $logosName = $request->name . "-" . Str::random(5);
                    $storeLogos = StoreFileHelper::storeLogos($logosName, $logos->getClientOriginalExtension());

                    $company->logos = $request->file('logos')->storeAs($storeLogos, $logos->getClientOriginalName(), 'public');
                }
                if ($request->hasFile('ico')) {
                    if ($company->ico !== null) {
                        Storage::delete($company->ico);
                    }
                    $ico = $request->file('ico');
                    $icoName = $request->name . "-" . Str::random(5);
                    $storeIco = StoreFileHelper::storeIco($icoName, $ico->getClientOriginalExtension());

                    $company->ico = $request->file('ico')->storeAs($storeIco, $ico->getClientOriginalName(), 'public');
                }
                $company->address = $request->address;
                $company->phone_number = $request->phone_number;
                $company->email = $request->email;
                $company->description = $request->description;
                $company->save();
            }

            DB::commit();

            return redirect(route('company.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }
}
