<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class PizzaController extends Controller
{
    public function getPizzas(){
        $pizzas = Pizza::query()->get();
        return $pizzas;
    }

    public function createPizzas(Request $request){
        try {
            // dump($request->input('name'));
            // dump($request->input('type'));
            // dump($request->all());
            // dump($request->only(['name']));

            // DB::table('pizzas')->insert([
            //     'name' => $request->input('name'),
            //     'name' => $request->input('type')
            // ]);

            Log::info("Create Pizza");

            $validator = Validator::make($request->all(), [
                'name' => 'required | regex:/^[a-zA-Z0-9 ]*$/',
                'type' => 'required',
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $name = $request->input('name');
            $type = $request->input('type');

            $pizza = new Pizza();
            $pizza->name = $name;
            $pizza->type = $type;
            $pizza->save();

            return response()->json([
                'success' => true,
                'message' => 'Pizza created',
                'data' => $pizza],200);
        } catch (\Throwable $th){
            Log::error('CREATING PIZZA: '.$th->getMessage());
            return response()->json([ 
                'success' => false,
                'message' => "Error creating pizza"],500);
        }
    }

    public function updatePizzas(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'regex:/^[a-zA-Z0-9 ]*$/',
                'type' => [
                    Rule::in(['fina', 'original', 'rellena_de_queso'])
                    ]
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors(),400);
            }

            $pizza = Pizza::find($id);

            if(!$pizza) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pizza does not exist',
                ],404);
                
            }

            $name = $request->input('name');
            $type = $request->input('type');

            if(isset($name)){
                $pizza->name =$request->input('name');
            }

            if(isset($type)){
                $pizza->type =$request->input('type');
            }
            
            $pizza->save();

            return response()->json([
                'success' => true,
                'message' => 'Pizza updated',
                'data' => $pizza],200);
        } catch (\Throwable $th){
            return response()->json([ 
                'success' => false,
                'message' => $th->getMessage()],500);
        }   
    }

    public function deletePizzas($id){
        try {
            Pizza::destroy($id);

            // Pizza::where('name', 'carbonara')->where('type', 'fina')->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pizza deleted'
            ],200);
        } catch (\Throwable $th){
            return response()->json([ 
                'success' => false,
                'message' => $th->getMessage()],500);
        }  
    }

    public function getPizzasById($id){
        try {
            $pizza = Pizza::query()->find($id);
            return response()->json([
                'success' => true,
                'message' => 'Pizza found',
                'data' => [
                    'id' => $pizza->id,
                    'name' => $pizza->name,
                    'isActive' => $pizza->isActive,
                ]
            ],200);
        } catch (\Throwable $th){
            return response()->json([ 
                'success' => false,
                'message' => $th->getMessage()],500);
        } 
    }

    public function getPizzasByIdWithReviews(Request $request, $id){
        try {
            $pizzaByIdWithReviews = Pizza::with(['reviews', 'reviews.users'])->find($id);

            return [
                'success' => true,
                'data' => $pizzaByIdWithReviews
            ];
        } catch (\Throwable $th){
            return response()->json([ 
                'success' => false,
                'message' => $th->getMessage()],500);
        } 
    }

    public function getPizzasByIdWithIngredientes(Request $request, $id){
        try {
            // $pizzaByIdWithIngredientes = Pizza::with(['ingredientes'])->find($id);

            $IngredientesByIdWithPizza = Pizza::find($id);

            $IngredientesByIdWithPizza->ingredientes;

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

    public function addIngredienteToPizzaId(Request $request, $id){
        try {
            $ingredienteId = $request->input('ingrediente_id');

            // DB::table('ingredientes_pizza')->insert([
            //     'ingrediente_id' => $ingredienteId,
            //     'pizza_id' => $id
            // ]);

            $pizza = Pizza::find($id);

            if(!$pizza){
                return response()->json([
                    'success' => false,
                    'data' => "Pizza not found"
                ],404);
            }

            $pizza->ingredientes()->attach($ingredienteId);
            $pizza->ingredientes;

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Ingredient added',
                    'data' => $pizza
                ],404
            );

        } catch (\Throwable $th){
            Log::error('Error addind ingrediente to Pizza: '.$th->getMessage());
            return response()->json([ 
                'success' => false,
                'message' => 'Error addind ingrediente to Pizza'],500);
        }
    }

    public function deleteIngredienteToPizzaId(Request $request, $id){
        try {
            $ingredienteId = $request->input('ingrediente_id');

            // DB::table('ingredientes_pizza')->insert([
            //     'ingrediente_id' => $ingredienteId,
            //     'pizza_id' => $id
            // ]);

            $pizza = Pizza::find($id);

            if(!$pizza){
                return response()->json([
                    'success' => false,
                    'data' => "Pizza not found"
                ],404);
            }

            $pizza->ingredientes()->detach($ingredienteId);
            $pizza->ingredientes;

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Ingredient delete',
                    'data' => $pizza
                ],404
            );

        } catch (\Throwable $th){
            Log::error('Error deleting ingrediente to Pizza: '.$th->getMessage());
            return response()->json([ 
                'success' => false,
                'message' => 'Error deleting ingrediente to Pizza'],500);
        }
    } 
}
