<?php

namespace Icekristal\LaravelDraft\Http\Requests;


use Illuminate\Validation\Rule;

class StoreRequest extends BaseRequest
{

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'now_count_drafts' => auth()->user()->drafts()->count() ?? 0
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'min:1', 'max:255'],
            'info' => ['required', 'json'],
            'is_public' => ['filled', Rule::in([true, false, 0, 1])],
            'now_count_drafts' => ['required', 'min:0', 'max:' . config('settings.limit_drafts_one_client', 200)],
        ];
    }
}
