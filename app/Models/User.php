<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\DB;   
use Illuminate\Database\Eloquent\SoftDeletes;                                  

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //データベースに入れるデータ
        'username',
        'phonetic',
        'password',
        'email',
        'user_type_id',
        'last_login',
    ];

    public static $validationAttributes = [
        'username' => '名前',
        'phonetic' => 'フリガナ',
        'password' =>  'パスワード',
        'email' => 'メールアドレス'
    ];

    public static $messages = [
        'username.required' => ':Attributeは必須です。',
        'phonetic.required' => ':Attributeは必須です。',
        'password.required' => ':Attributeは必須です。',
        'exists:users,email' => '入力パスワードは登録されていませんでした。',
        'exists:users,password' => '入力されたパスワードは登録されていません。',
        'password_confirmation.required' => ':Attributeは必須です。',
        'email' => 'メールアドレスを正しく入力してください。',
        'email.required' => ':Attributeは必須です。',
        'max' => ':max文字以内で入力してください。',
    ];


    public function getLastLogin()
    {
        $session = DB::table('sessions')
        ->where('user_id', $this->id)
        ->orderBy('last_activity', 'desc')
        ->first();

        // セッションが存在すれば最終ログイン情報を返す
        if ($session) {
            return $session->last_activity;
        }

        return null; // セッションが存在しない場合はnullを返す
    }

    protected static function boot()
    {
        parent::boot();

        // トピックが削除される前に、関連するハイライトを削除
        static::deleting(function ($user) {
            $user->reports()->delete();
        });
    }

        public function topics()
    {
        return $this->hasMany(Topic::class, 'user_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function highlights()
    {
        return $this->hasMany(Highlight::class, 'highlighted_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reported_by');
    }

    public function trustVotes()
    {
        return $this->hasMany(TrustVote::class, 'user_id');
    }
}
