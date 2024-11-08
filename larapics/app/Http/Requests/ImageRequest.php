<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Image;
use App\Models\User;

class ImageRequest extends FormRequest
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

        if($this->method('PUT')){
            return[
                'title' => 'required'
            ];
        }

        return [
            'file' => 'required|image',
            'title' => 'nullable'
        ];
    }

    public function getData(){
        $data = $this->validated() + [
            'user_id' => $this->user()->id
        ];

        if($this->hasFile('file')){
            $directory = Image::makeDirectory();
            $data['file'] = $this->file->store($directory);
            $data['dimension'] = Image::getDimension($data['file']);
        }

        return $data;
    }

    

}
