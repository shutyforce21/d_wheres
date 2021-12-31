<?php

namespace App\Http\Requests;

use App\Http\Requests\Rule\PasswordValidationRules;
use App\Packages\User\UseCase\User\Login\Dto\InputData;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserLoginRequest extends FormRequest
{
    use PasswordValidationRules;

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
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
            'email' => ['required', 'string', 'exists:users,email' ,'regex:/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/ui'],
            'password' => ['required', 'string'],
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
        })->values()->toArray()[0]);
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
            $data['email'],
            $data['password']
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

