<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required',
            'description'       => 'required',
            'release_date'      => 'required|date',
            'rating'            => 'required|numeric|min:1|max:5',
            'ticket_price'      => 'required|numeric',
            'country'           => 'required',
            'gerne'             => 'required|array',
            'photo_binary'      => request()->routeIs('films.update') ? 'nullable' : 'required|mimes:jpeg,jpg,png,gif',
        ];
    }

    protected function passedValidation()
    {
        if (!$this->hasFile('photo_binary')) {
            $path = pathinfo(request('photo'), PATHINFO_BASENAME);
            $this->merge(['photo' => $path]);
            return;
        }

        $path = $this->photo_binary->store('public');

        $path = pathinfo($path, PATHINFO_BASENAME);

        $this->merge(['photo' => $path]);

        // dd($this->all());
    }

    public function message()
    {
        return [
            'release_date.required' => 'The release date is required.',
            'ticket_price.required' => 'The ticket price is required.',
            'photo_binary.required' => 'The photo field is required.',
            'photo_binary.mimes'    => 'The phone must be in the following types [jpeg,jpg,png,gif]',
        ];
    }
}
