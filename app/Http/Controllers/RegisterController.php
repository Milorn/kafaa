<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\Expert;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerPage()
    {
        return view('pages/register');
    }

    public function register(RegisterRequest $request)
    {
        $response = match ($request->type) {
            UserType::Expert->value => $this->registerExpert($request->validated()),
            UserType::Company->value => $this->registerCompany($request->validated()),
            UserType::Provider->value => $this->registerProvider($request->validated()),
        };

        return $response;
    }

    /** ------------------------------ */
    private function registerExpert(array $data)
    {
        $expert = Expert::create([
            'type' => $data['label'],
            'diploma' => $data['diploma'],
            'years_of_experience' => $data['number_of_years'],
            'number_of_projects' => $data['number_of_projects'],
            'number_of_metric' => $data['number_of_metric'],
            'professional_status' => $data['professional_status'],
        ]);

        if (isset($data['resumee'])) {
            File::create([
                'fileable_type' => Expert::class,
                'fileable_id' => $expert->id,
                'name' => $data['resumee']->getClientOriginalName(),
                'path' => $data['resumee']->store('experts/resumees', 'private'),
            ]);
        }

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'type' => UserType::Expert,
            'userable_type' => Expert::class,
            'userable_id' => $expert->id,
        ]);

        return ['status' => 'success'];
    }

    private function registerCompany(array $data)
    {
    }

    private function registerProvider(array $data)
    {
    }
}
