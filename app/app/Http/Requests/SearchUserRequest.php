<?php

namespace App\Http\Requests;

use App\Packages\User\UseCase\User\UpdateProfile\Dto\InputData;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SearchUserRequest extends FormRequest
{
    /**
     * @return array|string[]
     */
    public function attributes()
    {
        return [
            'background' => '背景画像',
            'image' => 'プロフィール画像',
            'name' => '名前',
            'user_code' => 'ユーザーコード',
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
            'background' => ['required', 'string'],
            'image' => ['required', 'string'],
            'name' => ['required', 'string'],
            'user_code' => ['required', 'string'],
            'biography' => ['required', 'string'],
            'genres' => ['required', 'string'],
        ];
    }

    /**
     * @param ValidationValidator $validator
     */
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

    /**
     * @return InputData
     */
    public function getInputData()
    {
        $data = $this->validated();
        return new InputData(
            $data['background'],
            $data['image'],
            $this->spaceTrim($data['name']),
            $data['user_code'],
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
