<?php


namespace App\Http\Requests;

use App\Packages\User\UseCase\User\RegisterProfile\Dto\InputData;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegisterUserProfileRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'image' => 'プロフィール画像',
            'biography' => 'Bio',
            'genres' => 'ジャンル',
        ];
    }

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
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['nullable', 'file', 'image', 'max:512', 'mimes:jpeg,jpg,png'],
            'biography' => ['nullable', 'string'],
            'genres' => ['nullable', 'array'],
            'genres.*' => ['integer', 'exists:genres,id'],
        ];
    }

    public function messages()
    {
        return [
            // 'last_name.string' => ':attributeは文字列を指定してください。',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        $name = $this->attributes();

        $errors = collect();
        $errors->push(collect($validator->messages())->map(function ($v, $k) use ($name) {
            $k = explode('.', $k)[0];
            return [
                'field' => $k,
                'name' => collect($name)->get($k),
                'message' => collect($v)->first()
            ];
        })->values()->toArray());
        if ($errors->isNotEmpty()) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Validation Error',
                    'errors' => $errors->toArray()
                ], Response::HTTP_BAD_REQUEST)
            );
        }
    }

    public function getInputData()
    {
        $data = $this->validated();
        return new InputData(
            $data['image'],
            $this->spaceTrim($data['biography']),
            $data['genres']
        );
    }

    /**
     * 前後の全角半角スペース除去
     * @param $str
     * @return string|string[]|null
     */
    public function spaceTrim($str)
    {
        // 行頭の半角、全角スペースを、空文字に置き換える
        $str = preg_replace('/^[ 　]+/u', '', $str);
        // 末尾の半角、全角スペースを、空文字に置き換える
        $str = preg_replace('/[ 　]+$/u', '', $str);
        return $str;
    }
}