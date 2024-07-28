@extends('master')
@section('title')
     {{ __('Noticias') }} || {{ $title }}
@endsection
@section('content')



    <section class="news-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-sidebar__left">
                        <div class="news-sidebar__content">
                            @foreach ($news as $blog_details)
                                <div class="news-sidebar__single">
                                    <div class="news-sidebar__img">
                                        <img src="{{ getImageFile($blog_details->image) }}" alt="">
                                        <div class="news-sidebar__date">
                                            <p>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('d') }}</p>
                                            <span>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('F') }}</span>
                                        </div>
                                    </div>
                                    <div class="news-sidebar__content-box">
                                        <ul class="list-unstyled news-sidebar__meta">
                                            <li><a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"><i
                                                        class="fas fa-user-circle"></i>{{ __('por Administrador') }}</a>
                                            </li>
                                            <li><a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"><i
                                                        class="fas fa-comments"></i>@php
                                                        $blogComments = \App\Models\BlogComment::active()->where('blog_id', $blog_details->id)->whereNull('parent_id')->get();
                                                    @endphp {{ @$blogComments->count() }} {{ __('Comentarios') }}</a>
                                            </li>
                                        </ul>
                                        <h3 class="news-sidebar__title">
                                            <a
                                                href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}">{{ $blog_details->title }}</a>
                                        </h3>
                                        <p class="news-sidebar__text">{!! new \Illuminate\Support\HtmlString(\Illuminate\Support\Str::words($blog_details->details, 15, '...')) !!}</p>


                                        <div class="news-sidebar__bottom">
                                            <a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"
                                                class="news-sidebar__read-more">{{ __('LEER MÁS') }}</a>
                                            <a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"
                                                class="news-sidebar__arrow"><span class="icon-right-arrow"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__search">
                            <form action="#" class="sidebar__search-form">
                                <input type="search" placeholder="Buscar Aquí">
                                <button type="submit"><i class="icon-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">{{ __('Últimas Entradas') }}</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                @foreach ($latest_posts as $lp)
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="{{ getImageFile($lp->image_path) }}" alt="">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i
                                                        class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($lp->created_at)->format('j F, Y') }}
                                                </span>
                                                <a
                                                    href="{{ url('blog_details/') }}{{ '/' . $lp->slug }}">{{ $lp->title }}</a>
                                            </h3>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__category">
                            <h3 class="sidebar__title">{{ __('Categorías') }}</h3>
                            <ul class="sidebar__category-list list-unstyled">
                                @php
                                    $categoryList = \App\Models\BlogCategory::all();
                                @endphp

                                @foreach ($categoryList as $category)
                                    <li class="{{ $title == $category->slug ? 'active' : '' }}">
                                        <a href="{{ url('news-category') }}{{ '/'.$category->slug }}">{{ $category->name }}<span
                                                class="icon-right-arrow"></span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__tags">
                            <h3 class="sidebar__title">{{ __('Etiquetas') }}</h3>
                            <div class="sidebar__tags-list">
                                @php
                                    $tagList = \App\Models\Tag::all();
                                @endphp
                                @foreach ($tagList as $row)
                                    <a href="#">{{ $row->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar__single sidebar__comments">
                            <h3 class="sidebar__title">{{ __('Comentarios') }}</h3>
                            <ul class="sidebar__comments-list list-unstyled">
                                @foreach ($blogComments as $row)
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p>{{ new \Illuminate\Support\HtmlString(\Illuminate\Support\Str::words($row->comment, 15, '...')) }}</p>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
