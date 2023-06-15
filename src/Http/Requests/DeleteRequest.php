<?php

namespace Icekristal\LaravelDraft\Http\Draft;


use Icekristal\LaravelDraft\Models\Draft;

/**
 * @property Draft $draft
 */
class DeleteRequest extends BaseRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        //
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
            //
        ];
    }
}
