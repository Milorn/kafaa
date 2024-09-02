<?php

namespace App\Http\Requests\Register;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'type' => ['required', Rule::enum(UserType::class)->except(UserType::Admin)],
        ];

        $userTypeRules = $this->getRulesByUserType();

        return [...$rules, ...$userTypeRules];
    }

    private function getRulesByUserType(): array
    {
        return match ($this->type) {
            UserType::Company->value => [
                'responsible_name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:100'],
                'company_name' => ['required', 'string', 'max:200'],
                'website' => ['required', 'url'],
                'responsible_job' => ['required', 'string', 'max:100'],
                'activity_area' => ['required', 'exists:activity_areas,id'],
                'registry' => ['required', File::types(['pdf'])],
                'employees' => ['nullable', 'array'],
                'employees.*.fname' => ['required', 'string', 'max:100'],
                'employees.*.lname' => ['required', 'string', 'max:100'],
                'employees.*.address' => ['required', 'string', 'max:100'],
                'employees.*.phone' => ['required', 'string', 'max:20'],
                'employees.*.email' => ['required', 'email'],
                'employees.*.label' => ['required', Rule::enum(LabelType::class)],
            ],
            UserType::Expert->value => [
                'fname' => ['required', 'string', 'max:100'],
                'lname' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', Password::min(8)],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:100'],
                'diploma' => ['required', 'string', 'max:100'],
                'number_of_years' => ['required', 'numeric', 'integer', 'min:0'],
                'number_of_projects' => ['required', 'numeric', 'integer', 'min:0'],
                'number_of_metric' => ['required', 'numeric', 'integer', 'min:0'],
                'professional_status' => ['required', Rule::enum(ProfessionalStatus::class)],
                'resumee' => ['required', File::types(['pdf'])],
                'label' => ['required', Rule::enum(LabelType::class)],
            ],
            UserType::Provider->value => [
                'responsible_name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:100'],
                'provider_name' => ['required', 'string', 'max:200'],
                'website' => ['required', 'url'],
                'responsible_job' => ['required', 'string', 'max:100'],
                'activity_area' => ['required', 'exists:activity_areas,id'],
                'registry' => ['required', File::types(['pdf'])],
            ],
            default => []
        };
    }
}
