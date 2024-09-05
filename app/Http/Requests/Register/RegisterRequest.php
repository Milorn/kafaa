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
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', Password::min(8)],
                'company_name' => ['required', 'string', 'max:200'],
                'responsible_name' => ['required', 'string', 'max:100'],
                'responsible_job' => ['nullable', 'string', 'max:100'],
                'address' => ['nullable', 'string', 'max:100'],
                'phone' => ['nullable', 'string', 'max:20'],
                'website' => ['nullable', 'url'],
                'activity_area' => ['nullable', 'exists:activity_areas,id'],
                'registry' => ['nullable', File::types(['pdf'])],
                'employees' => ['nullable', 'array'],
                'employees.*.fname' => ['required', 'string', 'max:100'],
                'employees.*.lname' => ['required', 'string', 'max:100'],
                'employees.*.address' => ['nullable', 'string', 'max:100'],
                'employees.*.phone' => ['nullable', 'string', 'max:20'],
                'employees.*.email' => ['nullable', 'email'],
                'employees.*.label' => ['nullable', Rule::enum(LabelType::class)],
            ],
            UserType::Expert->value => [
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', Password::min(8)],
                'fname' => ['required', 'string', 'max:100'],
                'lname' => ['required', 'string', 'max:100'],
                'phone' => ['nullable', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:100'],
                'diploma' => ['nullable', 'string', 'max:100'],
                'years_of_experience' => ['nullable', 'numeric', 'integer', 'min:0'],
                'number_of_projects' => ['nullable', 'numeric', 'integer', 'min:0'],
                'number_of_metric' => ['nullable', 'numeric', 'integer', 'min:0'],
                'professional_status' => ['nullable', Rule::enum(ProfessionalStatus::class)],
                'resumee' => ['nullable', File::types(['pdf'])],
                'label' => ['required', Rule::enum(LabelType::class)],
            ],
            UserType::Provider->value => [
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', Password::min(8)],
                'provider_name' => ['required', 'string', 'max:200'],
                'responsible_name' => ['required', 'string', 'max:100'],
                'responsible_job' => ['nullable', 'string', 'max:100'],
                'address' => ['nullable', 'string', 'max:100'],
                'phone' => ['nullable', 'string', 'max:20'],
                'website' => ['nullable', 'url'],
                'activity_area' => ['nullable', 'exists:activity_areas,id'],
                'registry' => ['nullable', File::types(['pdf'])],
            ],
            default => []
        };
    }
}
