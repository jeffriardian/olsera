<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use App\Models\Tax;
use App\Models\ItemTax;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use DB;

class ItemsController extends Controller
{
    public function index()
    {
       $query = DB::table('items')
                ->select('items.id', 'items.nama',
                DB::raw("CONCAT(
                    '[',
                        GROUP_CONCAT(
                            JSON_OBJECT(
                                'id', taxes.id,
                                'nama', taxes.nama,
                                'rate', taxes.rate
                            )
                        ),
                    ']'
                    ) AS tax"))
                ->join('item_taxes', 'items.id', '=', 'item_taxes.item_id')
                ->join('taxes', 'taxes.id', '=', 'item_taxes.tax_id')
                ->groupBy('items.id')
                ->get();

        $data = json_decode($query);
        
        return response([
            'success' => true,
            'message' => 'List of All Items',
            'data' => $data
        ], 200);
    }

    public function store(ItemRequest $request)
    {
        $data= $request->validated();

        $items = Item::create($data);

        foreach ( $data['tax_name'] as $tax_data)
        {
            $tax = Tax::select('id')->where('nama', $tax_data)->get();
            $items->taxes()->attach($tax);
        }
        
        if ($items) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Items Saved! ',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => $data,
                'message' => 'Items Failed to Save!',
            ], 400);
        }
    }

    public function update(ItemRequest $request)
    {
        $data= $request->validated();            
        
        $items = Item::whereId($request->get('id'))->update([
            'nama'   => $request->get('nama'),
        ]);

        $items = Item::find($request->get('id'));

        $tax = Tax::select('id')->whereIn('nama', $request->tax_name)->get();
        $items->taxes()->sync($tax);
        
        if ($items) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Items Updated! ',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => $data,
                'message' => 'Items Failed to Update!',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $items = Item::findOrFail($id);

        $items->delete();

        $items->taxes()->where('item_id', $id)->detach();
        
        if ($items) {
            return response()->json([
                'success' => true,
                'message' => 'Item Successfully Deleted!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item Failed to Delete!',
            ], 500);
        }
    }
}
