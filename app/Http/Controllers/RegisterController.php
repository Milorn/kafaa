<?php

namespace App\Http\Controllers;

use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\Company;
use App\Models\Expert;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerPage()
    {
        return view('pages/register');
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $response = match ($request->type) {
                UserType::Expert->value => $this->registerExpert($request->validated()),
                UserType::Company->value => $this->registerCompany($request->validated()),
                UserType::Provider->value => $this->registerProvider($request->validated()),
            };

            return $response;
        });
    }

    /** ------------------------------ */
    private function registerExpert(array $data)
    {
        $expert = Expert::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
            'diploma' => $data['diploma'] ?? null,
            'professional_status' => $data['professional_status'] ?? null,
            'label' => $data['label'],
            'years_of_experience' => $data['years_of_experience'] ?? null,
            'number_of_projects' => $data['number_of_projects'] ?? null,
            'number_of_metric' => $data['number_of_metric'] ?? null,
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
        $company = Company::create([
            'name' => $data['company_name'],
            'responsible_name' => $data['responsible_name'],
            'responsible_job' => $data['responsible_job'] ?? null,
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
            'website' => $data['website'] ?? null,
            'activity_area_id' => $data['activity_area'] ?? null,
        ]);

        if (isset($data['registry'])) {
            $company->addMediaFromRequest('registry')
                ->toMediaCollection('companies_registries', 'private');
        }

        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => UserType::Company,
            'userable_type' => Company::class,
            'userable_id' => $company->id,
        ]);

        if (isset($data['employees'])) {
            foreach ($data['employees'] as $employee) {
                Expert::create([
                    'company_id' => $company->id,
                    'fname' => $employee['fname'],
                    'lname' => $employee['lname'],
                    'address' => $employee['address'] ?? null,
                    'phone' => $employee['phone'] ?? null,
                    'email' => $employee['email'] ?? null,
                    'label' => $employee['label'],
                    'professional_status' => ProfessionalStatus::Employed,
                ]);
            }
        }

        return ['status' => 'success'];
    }

    private function registerProvider(array $data)
    {
        $provider = Provider::create([
            'name' => $data['provider_name'],
            'responsible_name' => $data['responsible_name'],
            'responsible_job' => $data['responsible_job'] ?? null,
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
            'website' => $data['website'] ?? null,
            'activity_area_id' => $data['activity_area'] ?? null,
        ]);

        if (isset($data['registry'])) {
            $provider->addMediaFromRequest('registry')
                ->toMediaCollection('providers_registries', 'private');
        }

        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => UserType::Provider,
            'userable_type' => Provider::class,
            'userable_id' => $provider->id,
        ]);

        return ['status' => 'success'];
    }
}
