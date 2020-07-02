@forelse ($articles as $article)
    <li class="pt-2">
        <div class="row">
            <div class="col-8">
                <a href="/articles/{{ $article->id }}" class="custom-text"><h4>{{ $article->title }}</h4></a>
            </div>
            <div class="col-3 ml-auto">
                <p class="custom-text">Score: {{ (new \App\ArticleScore())->score($article) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <p class="custom-text">{{ $article->description }}</p>
            </div>
            <div class="col-4 ml-auto">
                <p class="custom-text">Autor:  <a href="/profile/{{ $article->user_id }}" class="custom-text">{{ \App\User::find($article->user_id)->name }}</a></p>
            </div>
        </div>
    </li>
    <hr>
@empty
    <p>{{ __('No hay nada para mostrar aún.') }}</p>
@endforelse
