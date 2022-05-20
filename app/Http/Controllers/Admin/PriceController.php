<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Price;

class PriceController extends Controller {
    public function update(Request $request){

        $validate = $this->validate($request, [
            'price_id' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,1})?$/'],
            'descuento' => ['nullable', 'alpha_num', 'min:0'],
        ]);


        $id = $request->get('price_id');
        $precio = $request->get('precio');
        $descuento = $request->get('descuento');
        $price = Price::find($id);

        if($price){
            $price->price = $precio;
            $price->discount = $descuento;
            $price->update();
        }else{
            return back();
        }


        return back()->with('exito', 'El precio de '. $price->type .' ha sido actualizado.');
    }
}