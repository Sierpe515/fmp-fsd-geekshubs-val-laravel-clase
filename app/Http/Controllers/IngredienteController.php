<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function getIngredientesByIdWithPizza(Request $request, $id){
        try {
            // $IngredientesByIdWithPizza = Ingredientes::with('pizzas')->find($id);

            $IngredientesByIdWithPizza = Ingredientes::find($id);

            $IngredientesByIdWithPizza->pizzas;


            return [
                'success' => true,
                'data' => $IngredientesByIdWithPizza
            ];
        } catch (\Throwable $th){
            return response()->json([ 
                'success' => false,
                'message' => $th->getMessage()],500);
        } 
    }
}
