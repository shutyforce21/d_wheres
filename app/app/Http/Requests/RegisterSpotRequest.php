<?php

namespace App\Http\Requests;

use App\packages\User\UseCase\Spot\Register\Dto\InputData;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegisterSpotRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'name' => '名前',
            'image' => 'イメージ',
            'prefecture_id' => '都道府県',
            'address' => '住所',
            'content' => '内容',
            'location' => '緯度・経度',
            'location.latitude' => '緯度',
            'location.longitude' => '経度',
            'open_on' => '開場時間',
            'close_on' => '閉場時間'

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
            'image' => ['nullable', 'image'],
            'prefecture_id' => ['required', 'exists:prefectures,id'],
            'address' => ['nullable', 'string'],
            'content' => ['nullable', 'string', 'max:500'],
            'location' => ['required', 'array'],
            'location.latitude' => ['required', 'string'],
            'location.longitude' => ['required', 'string'],
            'open_on' => ['nullable', 'string'],
            'close_on' => ['nullable', 'string']
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

    /**
     * @return InputData
     */
    public function getInputData()
    {
        $data = $this->validated();
        $inputData = new InputData(
            $this->spaceTrim($data['name']),
            $data['image'],
            $data['prefecture_id'],
            $data['address'],
            $this->spaceTrim($data['content']),
            $data['location']['latitude'],
            $data['location']['longitude'],
            $data['open_on'],
            $data['close_on']
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
