<?php

namespace App\Http\Requests;

use Gate;
use App\User;
use App\Reply;
use App\Rules\SpamFree;
use App\Exceptions\ThrottleException;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', new Reply);
    }

    protected function failedAuthorization()
    {
        throw new ThrottleException('You are replying too frequently. Please take a break :).');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => ['required', new SpamFree]
        ];
    }

    public function persist($thread)
    {
        return $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ])->load('owner');
    }
}
