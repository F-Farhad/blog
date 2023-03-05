@extends('layouts.main')

@section('content')
<main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{ $date->translatedFormat('F') }} {{ $date->day }}, {{ $date->year }} • {{ $date->format('H:i')}} • {{ $post->comments()->count() }} комментария</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100"> 
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        <!--   Для того что бы все теги которые применяются к постам отображались, следует выводить иначе {!! $post->content !!}  -->
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">

                    @auth
                    <section class="py-3">
                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                            @csrf
                                <span>{{ $post->liked_users_count }}</span>
                                <button type="submit" class="border-0 bg-transparent">
                                    @if(auth()->user()->likedPosts->contains($post->id))
                                        <i class="fas fa-heart"></i> <!-- like -->
                                    @else
                                        <i class="far fa-heart"></i>    
                                    @endif
                                </button>
                        </form>
                    </section>
                @endauth
                @guest()
                <section>
                    <span>{{ $post->liked_users_count }}</span>
                    <i class="far fa-heart"></i>    
                </section>
                @endguest

                @if($relatedPost->count() > 0)
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                        <div class="row">
                            @foreach($relatedPost as $postRel)
                            <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                <img src="{{ asset('storage/' . $postRel->preview_image) }}" alt="related post" class="post-thumbnail">
                                <p class="post-category">{{ $postRel->category->title }}</p>
                                <a href="{{ route('post.show', $postRel->id) }}"><h5 class="post-title">{{ $postRel->title }}</h5></a>
                            </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                    <section class="comment-list">
                    <h2 class="section-title mb-3" data-aos="fade-up">Комментарии к посту {{ $post->comments->count() }}</h2>
                        @foreach($post->comments as $comment)
                        <div class="comment-text mb-3">
                            <span class="username">
                                <div>
                                    {{ $comment->user->name }}
                                </div>
                            <span class="text-muted float-right">{{ $comment->DateAsCarbon->diffForHumans() }}</span>
                            </span>
                                    {{ $comment->message }}
                        </div>
                        @endforeach
                    </section>

                    @auth   <!-- Данная директива отображает форму для комментариев только для вошедших пользователей -->
                    <section class="comment-section">
                        <h2 class="section-title mb-2" data-aos="fade-up">Оставить комметарий</h2>
                        <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                <label for="message" class="sr-only">Комментарий</label>
                                <textarea name="message" id="comment" class="form-control" placeholder="Комментарий" rows="10"></textarea>
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Отправить комметарий" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                    @endauth
                </div>
            </div>
        </div>
    </main>
        

    </main>

@endsection