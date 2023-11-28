<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable'],
            'bio' => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,bmp']
        ];
    }

    public function handleRequest()
    {
        $profileData = $this->validated();
        $profile = $this->user();

        if($this->hasFile('profile_picture'))
        {
            $picture = $this->profile_picture;
            $filename = "profile_picture-{$profile->id}." . $picture->getClientOriginalExtension();
            $this->profile_picture->move(public_path('uploads'), $filename);

            $profileData['profile_picture'] = $filename;
        }

        return $profileData;
    }
}
