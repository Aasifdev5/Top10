@extends('master')
@section('title')
    Wishlist
@endsection
@section('content')
    <main class="main__content_wrapper">
        <!-- cart section start -->
        <section class="cart__section section--padding">
            <div class="container-fluid">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>{{session::get('success')}}</p>
                </div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">
                    <p>{{session::get('fail')}}</p>
                </div>
                @endif
                <div class="cart__section--inner">
                    <form action="#">
                        <h2 class="cart__title mb-30">Wishlist</h2>
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list text-center">STOCK STATUS</th>
                                        <th class="cart__table--header__list text-right">ADD TO CART</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    @foreach ($wishlist as $item)
                                    @php

                                        $product_details = \App\Models\Product::find($item->product_id);
                                    @endphp
                                    @if ($product_details)
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <a href="{{ route('remove.wish', $item->id) }}"
                                                        class="cart__remove--btn" aria-label="remove button"
                                                        type="button">
                                                        <svg fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" width="16px" height="16px">
                                                            <path
                                                                d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                                        </svg>
                                                    </a>
                                                    <div class="cart__thumbnail">
                                                        <a
                                                            href="{{ url('product-details/' . $product_details->slug) }}">
                                                            <img class="border-radius-5"
                                                                src="{{ asset('product_images/' . $product_details->f_thumbnail) }}"
                                                                alt="cart-product">
                                                        </a>
                                                    </div>
                                                    <div class="cart__content">
                                                        <h3 class="cart__content--title h4">
                                                            <a
                                                                href="{{ url('product-details/' . $product_details->slug) }}">{{ $product_details->title }}</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price">{{ 'BS ' . $item->price }}</span>
                                            </td>
                                            <td class="cart__table--body__list text-center">
                                                <span class="in__stock text__secondary">in stock</span>
                                            </td>
                                            <td class="cart__table--body__list text-right">
                                                <a class="wishlist__cart--btn primary__btn" href="{{ url('addToCart') }}/{{ $item->price }}/{{ $product_details->id.'/1' }}">Add To Cart</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="cart__table--body__items">
                                            <td colspan="4" class="cart__table--body__list">
                                                <div class="alert alert-danger" role="alert">
                                                    Product not found for wishlist item with ID:
                                                    {{ $item->id }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach


                                </tbody>
                            </table>
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="{{ url('shop') }}">Continue shopping</a>
                                <a class="continue__shopping--clear" href="{{ url('shop') }}">View All Products</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        <!-- cart section end -->

        <!-- Start product section -->
        <section class="product__section section--padding  pt-0">
            <div class="container">
                <div class="section__heading border-bottom mb-30">
                    <h2 class="section__heading--maintitle">New <span>Products</span></h2>
                </div>
                <div class="product__section--inner pb-15 product__swiper--activation swiper">
                    <div class="swiper-wrapper">
                        @if (!empty($latest_products))
                            @foreach ($latest_products as $row)
                            @if ($user_session->price == 'price1')
                            @php
                                $price = $row->price1;
                            @endphp
                        @endif
                        @if ($user_session->price == 'price2')
                            @php
                                $price = $row->price2;
                            @endphp
                        @endif
                        @if ($user_session->price == 'price3')
                            @php
                                $price = $row->price3;
                            @endphp
                        @endif
                        @if ($user_session->price == 'price4')
                            @php
                                $price = $row->price4;
                            @endphp
                        @endif
                        @if ($user_session->price == 'price5')
                            @php
                                $price = $row->price5;
                            @endphp
                        @endif
                                <div class="swiper-slide">
                                    <article class="product__card">
                                        <div class="product__card--thumbnail">
                                            <a class="product__card--thumbnail__link display-block"
                                                href="{{ url('product-details') }}{{ '/' . $row->slug }}">
                                                <img class="product__card--thumbnail__img product__primary--img"
                                                    src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                    alt="product-img">
                                                <img class="product__card--thumbnail__img product__secondary--img"
                                                    src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                    alt="product-img">
                                            </a>

                                            <ul
                                                class="product__card--action d-flex align-items-center justify-content-center">


                                                <li class="product__card--action__list">
                                                    <a class="product__card--action__btn" title="Wishlist"
                                                        href="{{ url('addToWishlist') }}/{{ $price }}/{{ $row->id }}">
                                                        <svg class="product__card--action__btn--svg" width="18"
                                                            height="18" viewBox="0 0 16 13" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                        <span class="visually-hidden">Wishlist</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__card--content">

                                            <h3 class="product__card--title"><a
                                                    href="{{ url('product-details') }}{{ '/' . $row->slug }}">{{ $row->title }}
                                                </a></h3>
                                            <div class="product__card--price">
                                                <span class="current__price">

                                                    {{ 'BS ' . $price }}
                                                </span>
                                                {{-- <span class="old__price"> $362.00</span> --}}
                                            </div>
                                            <div class="product__card--footer">
                                                <a class="product__card--btn primary__btn"
                                                    href="{{ url('addToCart') }}/{{ $price }}/{{ $row->id.'/1' }}">
                                                    <svg width="14" height="11" viewBox="0 0 14 11"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    Add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        @else
                            <p>no related product available now</p>
                        @endif


                    </div>
                    <div class="swiper__nav--btn swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class=" -chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class=" -chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <!-- End product section -->

        <!-- Start shipping section -->
        <section class="shipping__section">
            <div class="container">
                <div class="shipping__inner style2 d-flex">
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping1.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Free Shipping</h2>
                            <p class="shipping__content--desc">Free shipping over $100</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping2.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Support 24/7</h2>
                            <p class="shipping__content--desc">Contact us 24 hours a day</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping3.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">100% Money Back</h2>
                            <p class="shipping__content--desc">You have 30 days to Return</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping4.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Payment Secure</h2>
                            <p class="shipping__content--desc">We ensure secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->



    </main>
@endsection
