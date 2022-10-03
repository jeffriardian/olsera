<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tax;
use App\Http\Requests\TaxRequest;

class TaxesController extends Controller
{
    public function index()
    {
        $taxes = Tax::latest()->get();
        
        return response([
            'success' => true,
            'message' => 'List of All Taxes',
            'data' => $taxes
        ], 200);
    }

    public function store(TaxRequest $request)
    {
        $data= $request->validated();

        $taxes = Tax::create($data);

        if ($taxes) {
            return response()->json([
                'success' => true,
                'message' => 'Taxes Saved! ',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tax Failed to Save!',
            ], 400);
        }
    }

    public function update(TaxRequest $request)
    {
        $data= $request->validated();            
        
        $taxes = Tax::whereId($request->get('id'))->update([
            'nama'   => $request->get('nama'),
            'rate'   => $request->input('rate'),
        ]);
        
        if ($taxes) {
            return response()->json([
                'success' => true,
                'message' => 'Tax Updated successfully!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tax Failed to Update!',
            ], 500);
        }
    }

    public function destroy($id)
    {
        $taxes = Tax::findOrFail($id);

        $taxes->delete();
        
        if ($taxes) {
            return response()->json([
                'success' => true,
                'message' => 'Tax Successfully Deleted!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tax Failed to Delete!',
            ], 500);
        }
    }

    public function show($id)
    {
        $taxes = Tax::whereId($id)->first();

        if ($taxes) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Tax!',
                'data'    => $taxes
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tax Not Found!',
                'data'    => ''
            ], 404);
        }
    }
}
