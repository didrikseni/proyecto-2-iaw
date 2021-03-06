<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function votes() {
        return $this->hasMany(ArticleScore::class);
    }

    public static function getFeaturedUsers() {
        return User::withCount('articles')->orderBy('articles_count', 'desc')->take(5)->get();
    }

    public function reports() {
        return $this->hasMany(ArticlesReports::class);
    }

    public function bookmarks() {
        return $this->hasMany(SavedArticle::class);
    }

    public function averageScore() {
        $res = 0; $va = 0;
        $articleScore = new ArticleScore();
        foreach ($this->articles as $article) {
            $sc = $articleScore->score($article);
            if ($sc != 0) {
                $res += $sc;
                $va += 1;
            }
        }
        if ($va == 0)  return 'n/s';
        else return $res / $va;
    }
}
