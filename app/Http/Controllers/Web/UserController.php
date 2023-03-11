<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\IndexRequest;
use App\Http\Requests\Web\User\StoreRequest;
use App\Http\Requests\Web\User\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): Response
    {
        $users = User::paginate();

        return inertia('users/index')->with([
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $categories = Category::all();

        $countries = Cache::remember('countries', 7200, function () {
            return Http::acceptJson()
                ->get('https://restcountries.com/v3.1/subregion/South America?fields=cca3,translations')
                ->collect();
        });

        return inertia('users/create')->with([
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'surname' => $request->validated('surname'),
            'identifier' => $request->validated('identifier'),
            'category_id' => $request->validated('category'),
            'mobile' => $request->validated('mobile'),
            'email' => $request->validated('email'),
            'country' => $request->validated('country'),
            'address' => $request->validated('address'),
        ]);

        session()->flash('status', [
            'level' => 'success',
            'message' => 'Usuario creado exitosamente',
        ]);

        return redirect()->route('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return inertia('users/show')->with([
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $categories = Category::all();

        $countries = Cache::remember('countries', 7200, function () {
            return Http::acceptJson()
                ->get('https://restcountries.com/v3.1/subregion/South America?fields=cca3,translations')
                ->collect();
        });

        return inertia('users/edit')->with([
            'user' => $user,
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update([
            'name' => $request->validated('name'),
            'surname' => $request->validated('surname'),
            'identifier' => $request->validated('identifier'),
            'category_id' => $request->validated('category'),
            'mobile' => $request->validated('mobile'),
            'email' => $request->validated('email'),
            'country' => $request->validated('country'),
            'address' => $request->validated('address'),
        ]);

        session()->flash('status', [
            'level' => 'success',
            'message' => 'Usuario actualizado exitosamente',
        ]);

        return redirect()->route('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        session()->flash('status', [
            'level' => 'success',
            'message' => 'Usuario ' . $user['full_name'] . ' eliminado exitosamente',
        ]);

        return redirect()->route('users.index');
    }
}
