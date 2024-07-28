@extends('master')
@section('title')
    Productos según marcas
@endsection
@section('content')
    <main class="main__content_wrapper">
        <!-- Start shop section -->
        <div class="shop__section section--padding">
            <div class="container">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ session::get('success') }}</p>
                    </div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">
                        <p>{{ session::get('fail') }}</p>
                    </div>
                @endif
                <div class="row">
                    <div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel">Lista de productos</h5>

                                </div>
                                <div class="modal-body">
                                    <div id="modal-product-list">
                                        <!-- Dynamic product list will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                        <div class="shop__sidebar--widget widget__area d-none d-lg-block">


                            <div class="single__widget price__filter widget__bg">
                                <h2 class="widget__title h3">Filtrar por precio</h2>
                                <!-- Modal Structure -->


                                <div class="container mt-5">
                                    <form id="price-filter-form" class="price__filter--form" action="#" method="GET">
                                        <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                                            <div class="price__filter--group">
                                                <label class="price__filter--label" for="Filter-Price-GTE2">De</label>
                                                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                                    <span class="price__filter--currency">BS</span>
                                                    <input class="price__filter--input__field border-0" name="min_price"
                                                        id="Filter-Price-GTE2" type="number" placeholder="0" min="0"
                                                        max="250.00">
                                                </div>
                                            </div>
                                            <div class="price__divider">
                                                <span>-</span>
                                            </div>
                                            <div class="price__filter--group">
                                                <label class="price__filter--label" for="Filter-Price-LTE2">A</label>
                                                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                                    <span class="price__filter--currency">BS</span>
                                                    <input class="price__filter--input__field border-0" name="max_price"
                                                        id="Filter-Price-LTE2" type="number" min="0"
                                                        placeholder="250.00" max="250.00">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="primary__btn price__filter--btn" type="submit">Filtrar</button>
                                    </form>

                                </div>

                                <!-- Bootstrap JS and jQuery (required for Bootstrap modals) -->
                                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                                </script>
                                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
                                    integrity="sha384-erWWAYt4w8PpIwLxyWH6h/KLjgAtwggvCeNbNlmn/fN5UgCnzA/V/CMrPvvcU1y8" crossorigin="anonymous">
                                </script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                                    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh/jFc/JzVj5VVew9+8z8zO4g+2k9qK52LCY6" crossorigin="anonymous">
                                </script>

                                <!-- Your custom JavaScript -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const priceFilterForm = document.getElementById('price-filter-form');
                                        const modalProductList = document.getElementById('modal-product-list');

                                        priceFilterForm.addEventListener('submit', function(e) {
                                            e.preventDefault(); // Prevent the form from submitting normally

                                            const minPrice = document.getElementById('Filter-Price-GTE2').value;
                                            const maxPrice = document.getElementById('Filter-Price-LTE2').value;

                                            // Create an AJAX request to fetch filtered products
                                            fetch(`/filter-products?min_price=${minPrice}&max_price=${maxPrice}`, {
                                                    method: 'GET',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-Requested-With': 'XMLHttpRequest' // Mark this request as AJAX
                                                    }
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Clear previous content
                                                    modalProductList.innerHTML = '';

                                                    // Populate modal with new product list
                                                    data.products.forEach(product => {
                                                        console.log(product);
                                                        const productElement = document.createElement('div');
                                                        productElement.className =
                                                        'product-grid'; // Adjust classes as needed
                                                        productElement.innerHTML = `

                            <div class="product-card">

  <a href="{{ url('product-details') }}/${product.slug}" class="product-link">
                                    <img src="{{ asset('product_images') }}/${product.f_thumbnail}" alt="${product.title}" class="product-image">
                                    <div class="product-info">
                                        <h5 class="product-title">${product.title}</h5>
                                        <span class="current__price">${product.price}</span>
                                    </div>
                                </a>
                            </div>


                    `;
                                                        modalProductList.appendChild(productElement);
                                                    });

                                                    // Show the modal
                                                    $('#productModal').modal('show'); // Assuming you're using Bootstrap modal
                                                })
                                                .catch(error => console.error('Error:', error));
                                        });
                                    });
                                </script>

                            </div>

                            <div class="single__widget widget__bg">
                                <h2 class="widget__title h3">Marcas</h2>
                                <ul class="widget__tagcloud">
                                    @php
                                        $brands = \App\Models\Brand::all();
                                    @endphp
                                    @foreach ($brands as $row)
                                        <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="{{ url('productbybrand') }}/{{ $row->id }}">
                                                {{ $row->name }}
                                            </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                        <div class="shop__right--sidebar">
                            <!-- Start categories section -->
                            
                            <!-- End categories section -->
                            <div class="shop__product--wrapper">
                                <div class="shop__header d-flex align-items-right justify-content-between mb-30">
                                    <div class="product__view--mode d-flex align-items-right">


                                        <div class="product__view--mode__list">
                                            <div
                                                class="product__tab--one product__grid--column__buttons d-flex justify-content-right">
                                                <button class="product__grid--column__buttons--icons active"
                                                    aria-label="grid btn" data-toggle="tab" data-target="#product_grid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                        viewBox="0 0 9 9">
                                                        <g transform="translate(-1360 -479)">
                                                            <rect id="Rectangle_5725" data-name="Rectangle 5725"
                                                                width="4" height="4"
                                                                transform="translate(1360 479)" fill="currentColor" />
                                                            <rect id="Rectangle_5727" data-name="Rectangle 5727"
                                                                width="4" height="4"
                                                                transform="translate(1360 484)" fill="currentColor" />
                                                            <rect id="Rectangle_5726" data-name="Rectangle 5726"
                                                                width="4" height="4"
                                                                transform="translate(1365 479)" fill="currentColor" />
                                                            <rect id="Rectangle_5728" data-name="Rectangle 5728"
                                                                width="4" height="4"
                                                                transform="translate(1365 484)" fill="currentColor" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <button class="product__grid--column__buttons--icons"
                                                    aria-label="list btn" data-toggle="tab" data-target="#product_list">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                        viewBox="0 0 13 8">
                                                        <g id="Group_14700" data-name="Group 14700"
                                                            transform="translate(-1376 -478)">
                                                            <g transform="translate(12 -2)">
                                                                <g id="Group_1326" data-name="Group 1326">
                                                                    <rect id="Rectangle_5729" data-name="Rectangle 5729"
                                                                        width="3" height="2"
                                                                        transform="translate(1364 483)"
                                                                        fill="currentColor" />
                                                                    <rect id="Rectangle_5730" data-name="Rectangle 5730"
                                                                        width="9" height="2"
                                                                        transform="translate(1368 483)"
                                                                        fill="currentColor" />
                                                                </g>
                                                                <g id="Group_1328" data-name="Group 1328"
                                                                    transform="translate(0 -3)">
                                                                    <rect id="Rectangle_5729-2" data-name="Rectangle 5729"
                                                                        width="3" height="2"
                                                                        transform="translate(1364 483)"
                                                                        fill="currentColor" />
                                                                    <rect id="Rectangle_5730-2" data-name="Rectangle 5730"
                                                                        width="9" height="2"
                                                                        transform="translate(1368 483)"
                                                                        fill="currentColor" />
                                                                </g>
                                                                <g id="Group_1327" data-name="Group 1327"
                                                                    transform="translate(0 -1)">
                                                                    <rect id="Rectangle_5731" data-name="Rectangle 5731"
                                                                        width="3" height="2"
                                                                        transform="translate(1364 487)"
                                                                        fill="currentColor" />
                                                                    <rect id="Rectangle_5732" data-name="Rectangle 5732"
                                                                        width="9" height="2"
                                                                        transform="translate(1368 487)"
                                                                        fill="currentColor" />
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="product__showing--count"></p>
                                </div>
                                <div class="tab_content">
                                    <div id="product_grid" class="tab_pane active show">
                                        <div class="product__section--inner">
                                            <div class="row mb--n30">
                                                @foreach ($products as $row)
                                                    @if ($user_session->price == 'price1')
                                                        @php
                                                            $price = $row->price1;
                                                        @endphp
                                                    @elseif ($user_session->price == 'price2')
                                                        @php
                                                            $price = $row->price2;
                                                        @endphp
                                                    @elseif ($user_session->price == 'price3')
                                                        @php
                                                            $price = $row->price3;
                                                        @endphp
                                                    @elseif ($user_session->price == 'price4')
                                                        @php
                                                            $price = $row->price4;
                                                        @endphp
                                                    @elseif ($user_session->price == 'price5')
                                                        @php
                                                            $price = $row->price5;
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $IsVariation = \App\Models\ProductVariations::where(
                                                            'product_id',
                                                            $row->id,
                                                        )
                                                            ->orderBy('id', 'asc')
                                                            ->first();
                                                        if (!empty($IsVariation)) {
                                                            $IsVariationProductDetails = \App\Models\Product::where(
                                                                'sku',
                                                                $IsVariation->sku,
                                                            )->first();
                                                        } else {
                                                            $IsVariationProductDetails = '';
                                                        }
                                                    @endphp
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                                        <article class="product__card">
                                                            <div class="product__card--thumbnail">
                                                                <a class="product__card--thumbnail__link display-block"
                                                                    href="{{ url('product-details') }}/{{ $row->slug }}"
                                                                    data-product-id="{{ $row->id }}">

                                                                    @if (!empty($IsVariation))
                                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                                            src="{{ asset('product_images/' . $IsVariationProductDetails->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                                            src="{{ asset('product_images/' . $IsVariationProductDetails->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                    @else
                                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                                            src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                                            src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                    @endif
                                                                </a>

                                                                <ul
                                                                    class="product__card--action d-flex align-items-center justify-content-center">
                                                                    @if (empty($IsVariation))
                                                                        <li class="product__card--action__list">
                                                                            <a class="product__card--action__btn"
                                                                                title="Wishlist"
                                                                                href="{{ url('addToWishlist') }}/{{ $price }}/{{ $row->id }}">
                                                                                <svg class="product__card--action__btn--svg"
                                                                                    width="18" height="18"
                                                                                    viewBox="0 0 16 13" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                        fill="currentColor" />
                                                                                </svg>
                                                                                <span
                                                                                    class="visually-hidden">Wishlist</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                </ul>
                                                            </div>
                                                            <div class="product__card--content">
                                                                <h3 class="product__card--title"><a
                                                                        href="{{ url('product-details') }}/{{ $row->slug }}"
                                                                        data-product-id="{{ $row->id }}">{{ $row->title }}</a>
                                                                </h3>
                                                                <div class="product__card--price">
                                                                    <span
                                                                        class="current__price">{{ 'BS ' . $price }}</span>
                                                                    {{-- <span class="old__price"> $362.00</span> --}}
                                                                </div>
                                                                <div class="product__card--footer">
                                                                    @if (empty($IsVariation))
                                                                        <a class="product__card--btn primary__btn"
                                                                            href="{{ url('addToCart') }}/{{ $price }}/{{ $row->id . '/1' }}">
                                                                            <svg width="14" height="11"
                                                                                viewBox="0 0 14 11" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                                                    fill="currentColor" />
                                                                            </svg>
                                                                            Añadir al carrito
                                                                        </a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </article>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                    <div id="product_list" class="tab_pane">
                                        <div class="product__section--inner product__section--style3__inner">
                                            <div class="row row-cols-1 mb--n30">
                                                @foreach ($products as $row)
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
                                                    @php
                                                        $IsVariation = \App\Models\ProductVariations::where(
                                                            'product_id',
                                                            $row->id,
                                                        )
                                                            ->orderBy('id', 'asc')
                                                            ->first();
                                                        if (!empty($IsVariation)) {
                                                            $IsVariationProductDetails = \App\Models\Product::where(
                                                                'sku',
                                                                $IsVariation->sku,
                                                            )->first();
                                                        } else {
                                                            $IsVariationProductDetails = '';
                                                        }
                                                    @endphp
                                                    <div class="col mb-30">
                                                        <div class="product__card product__list d-flex align-items-center">
                                                            <div class="product__card--thumbnail product__list--thumbnail">
                                                                <a class="product__card--thumbnail__link display-block"
                                                                    href="{{ url('product-details') }}{{ '/' . $row->slug }}"
                                                                    data-product-id="{{ $row->id }}">
                                                                    @if (!empty($IsVariation))
                                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                                            src="{{ asset('product_images/' . $IsVariationProductDetails->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                                            src="{{ asset('product_images/' . $IsVariationProductDetails->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                    @else
                                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                                            src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                                            src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                                                                            alt="product-img">
                                                                    @endif
                                                                </a>

                                                                <ul
                                                                    class="product__card--action d-flex align-items-center justify-content-center">
                                                                    @if (empty($IsVariation))
                                                                        <li class="product__card--action__list">
                                                                            <a class="product__card--action__btn"
                                                                                title="Wishlist" href="wishlist">
                                                                                <svg class="product__card--action__btn--svg"
                                                                                    width="18" height="18"
                                                                                    viewBox="0 0 16 13" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                        fill="currentColor" />
                                                                                </svg>
                                                                                <span
                                                                                    class="visually-hidden">Wishlist</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif


                                                                </ul>
                                                            </div>
                                                            <div class="product__card--content product__list--content">
                                                                <h3 class="product__card--title"><a
                                                                        href="{{ url('product-details') }}{{ '/' . $row->slug }}"
                                                                        data-product-id="{{ $row->id }}">{{ $row->title }}
                                                                    </a></h3>

                                                                <div class="product__list--price">
                                                                    <span class="current__price">{{ 'BS ' . $price }}
                                                                    </span>

                                                                </div>
                                                                <p class="product__card--content__desc mb-20">
                                                                    {{ $row->short }}</p>
                                                                @if (empty($IsVariation))
                                                                    <a class="product__card--btn primary__btn"
                                                                        href="{{ url('addToCart') }}/{{ $price }}/{{ $row->id . '/1' }}">+
                                                                        Añadir al carrito</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pagination__area">
                                    <nav class="pagination justify-content-center">
                                        @include('admin.pagination', ['paginator' => $products])

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End shop section -->


        <!-- Start shipping section -->
        <section class="shipping__section">
            <div class="container">
                <div class="shipping__inner style2 d-flex">
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping1.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Envíamos tus compras</h2>
                            <p class="shipping__content--desc">La mejor gestiòn de envìo</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping2.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Soporte 24/7</h2>
                            <p class="shipping__content--desc">Contáctanos las 24 horas del día</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping3.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Sólo lo mejor</h2>
                            <p class="shipping__content--desc">La mejor calidad garantizada</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="{{ asset('assets/img/other/shipping4.webp') }}" alt="icon-img">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Pago seguro</h2>
                            <p class="shipping__content--desc">Compra con seguridad y confianza</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>
@endsection
