<?php

namespace App\Http\Requests\Register;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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
            'fname' => ['required', 'string', 'max:100'],
            'lname' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email'],
        ];

        $userTypeRules = $this->getRulesByUserType();

        return [...$rules, ...$userTypeRules];
    }

    private function getRulesByUserType(): array
    {
        return match ($this->type) {
            UserType::Company->value => [
                'company_name' => ['required'],
            ],
            UserType::Expert->value => [
                'diploma' => ['required', 'string', 'max:100'],
                'number_of_years' => ['required', 'numeric', 'integer', 'min:0'],
                'number_of_projects' => ['required', 'numeric', 'integer', 'min:0'],
                'number_of_metrics' => ['required', 'numeric', 'integer', 'min:0'],
                'professional_status' => ['required', Rule::enum(ProfessionalStatus::class)],
                'resumee' => ['required', File::types(['pdf'])],
                'label' => ['required', Rule::enum(LabelType::class)],
            ],
            UserType::Provider->value => [

            ],
            default => []
        };
    }
}
