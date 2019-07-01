<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Users\Company;

use App\Http\Requests\Admin\Users\Companies\CreateCompanyRequest;
use App\Http\Requests\Admin\Users\Companies\UpdateCompanyRequest;

use Response;

class ManageCompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('admin.users.companies.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $input = $request->all();

        $name = $input["name"];

        $company = Company::create([
                'name'      => $name,
                'slug'       =>  Company::generateUniqueSlug($name)
        ]);

        if (!$company) {
            return Response::json([
                'error' => [trans('manage_companies.create.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => Company::find($company->id),
            'message' => [trans('manage_companies.create.success')],
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $input = $request->all();
        $name = $input["name"];
        $company->name = $name;
        $company->slug = $company->updateUniqueSlug($name);;

		if (!$company->save()) {
            return Response::json([
                'error' => [trans('manage_companies.update.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => $company,
            'message' => [trans('manage_companies.update.success')],
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (!$company->isDeletable()) {
             return Response::json([
                 'error' => [trans('manage_companies.deletable.error')]
             ], 422);
         }

         if (!$company->delete()) {
             return Response::json([
                 'error' => [trans('manage_companies.delete.error')]
             ], 422);
         }

         return Response::json([ // todo bien
             'message' => [trans('manage_companies.delete.success')],
             'success' => true
         ]);
    }
}
