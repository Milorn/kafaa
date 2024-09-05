<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\Expert;
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
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'diploma' => $data['diploma'],
            'professional_status' => $data['professional_status'],
            'label' => $data['label'],
            'years_of_experience' => $data['years_of_experience'],
            'number_of_projects' => $data['number_of_projects'],
            'number_of_metric' => $data['number_of_metric'],
        ]);

        if (isset($data['resumee'])) {
            $expert->addMediaFromRequest('resumee')
                ->toMediaCollection('experts_resumees', 'private');
        }

        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
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
