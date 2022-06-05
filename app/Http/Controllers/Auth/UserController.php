<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Address;
use App\Models\Phone;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     */
    public function current(Request $request)
    {
        $user = $request->user();
        $user->role = $request->user()->role;

        return response()->json($user);
    }

    public function registerComplements(Request $request, $id){
        if(count($request->phones) > 0){
            foreach ($request->phones as $phone) {
                Phone::create(['number_phone' => $phone['number'], 'type_phone' =>$phone['type'] == 2 ? 'Celular' : 'Telefone', 'user_id' => $id]);
            }
        }
        
        foreach($request->addresses as $address){
            Address::create(['street' => $address['street'], 'adress_number' => $address['number'], 'district' => $address['district'], 'city' => $address['city'], 'state' => $address['state'], 'cep' => $address['cep'], 'is_default' => $address['is_default'], 'user_id' => $id]);
        }

        $user = User::find($id);
        $user->role = $user->role;
        $user->phones = $user->phones;
        $user->adresses = $user->adresses;

        return $this->successResponse($user, "Complementos cadastrados com sucesso!", 201);


    }
}
