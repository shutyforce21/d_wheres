<?php


namespace App\Http\Requests;

use App\Http\Requests\Rule\PasswordValidationRules;
use App\Packages\User\UseCase\User\Register\Dto\InputData;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegisterUserRequest extends FormRequest
{
    use PasswordValidationRules;

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'email_confirmation' => 'メールアドレス(確認用)',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード(確認用)',
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:people' ,'regex:/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/ui'],
            'email_confirmation' => ['required', 'same:email'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'same:password'],
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
            //配列用に.以前を取得
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
        $inputData = new InputData(
            $this->spaceTrim($data['name']),
            $this->spaceTrim($data['email']),
            $data['password']
        );

        return $inputData;
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
