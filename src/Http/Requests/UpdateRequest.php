<?php

namespace Icekristal\LaravelDraft\Http\Requests;


use Icekristal\LaravelDraft\Models\Draft;
use Illuminate\Validation\Rule;

/**
 * @property Draft $draft
 */
class UpdateRequest extends BaseRequest
{

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_update_public' =>
                !$this->has('is_public')
                || $this->has('is_public') && auth()->user()->id == $this->draft->owner_id
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return ($this->draft->owner_id == auth()->user()->id && $this->draft->owner_type == get_class(auth()->user()))
            || ($this->draft->is_public);
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
            'is_update_public' => [Rule::in([true])]
        ];
    }
}
