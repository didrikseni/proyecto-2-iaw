<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesReports extends Model
{
    protected $guarded = [];

    /**
     * Report reasons
     *
     * @var array
     */
    private const REASONS = [
        1 => 'Contenido sexual.',
        2 => 'Contenido violento o repulsivo.',
        3 => 'Contenido ofensivo o inapropiado.',
        4 => 'Spam o engaño.',
        5 => 'Infringe derechos de copyright, privacidad u otros.',
    ];

    public function getReason() {
        return self::REASONS[$this->reason];
    }

    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getArticlesWithReports() {
        return Article::join('articles_reports', 'articles.id', '=', 'articles_reports.article_id')
            ->groupBy('articles.id')
            ->orderByRaw('COUNT(articles_reports.article_id) DESC')
            ->select('articles.*')
            ->get();
    }

}
