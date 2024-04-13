<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::query()
        ->whereNotIn('id', [1])
        ->when(request('q'), function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();

        $context = compact('users'); 

        return view('users.index', $context);
    }

  

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $states = State::orderBy('name')->get()->pluck('name', 'id');
        $cities = City::whereStateId($user->state_id)->orderBy('name')->get()->pluck('name', 'id');

        $context = compact('user', 'states', 'cities');

        return view('users.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
            'state_id' => ['required', 'exists:' . State::class . ',id'],
            'city_id' => ['required', 'exists:' . City::class . ',id'],
            'document' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'has_whatsapp' => ['required'],
            'visit_by_tronex' => ['required'],
        ]);
        $user->update($validate);

        return to_route('users.index')->with('success', 'Usuario actualizado');
    }

 
    public function code(Request $request, User $user)
    {

        $validate = $request->validate([
            'code' => ['required', 'string', 'max:255'],
        ]);

        $code = $validate['code'];


        $response = UserRepository::getCustomRuteroId($code);
        
        if($response){

            $orders = $user->orders()->where('status_id', Order::STATUS_PENDING)->get();
            
            foreach($orders as $order){
                OrderRepository::presalesOrder($order);
            }


            $user->update($response);

            //pending order to processed
           

            return back()->with('success', 'Código actualizado, ya este cliente puede comprar');
        }

        return back()->with('error', 'Código no encontrado');

    }


    public function password(Request $request, User $user)
    {

        $validate = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validate['password'] = Hash::make($validate['password']);


        $user->update($validate);

        return back()->with('success', 'Contraseña actualizada');
    }
}
