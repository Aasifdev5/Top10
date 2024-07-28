@extends('master')
@section('title')
    {{ $product->title }}
@endsection
@section('content')
    <main class="main__content_wrapper">
        <!-- Start product details section -->
        <section class="product__details--section section--padding">

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
                <div class="row row-cols-lg-2 row-cols-md-2">
                     @if(!empty($IsVariationProductDetails))
                    <div class="col">



                        <div class="product__details--media">
                            <div class="single__product--preview swiper mb-25">
                                @php

                                    // Fetch product images for the default color 'm'
                                    $productImages = \App\Models\Pro_image::where('product_id', $product->id)

                                        ->orderBy('id', 'asc')
                                        ->first();


                                @endphp
                                <div class="swiper-wrapper" id="productMediaSlider">

                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox"
                                                    data-gallery="product-media-preview"
                                                    href="{{ asset( $productImages->thumbnail) }}">
                                                    <img class="product__media--preview__items--img"
                                                        src="{{ asset($productImages->thumbnail) }}"
                                                        alt="product-media-img">
                                                </a>
                                                <div class="product__media--view__icon">
                                                    <a class="product__media--view__icon--link glightbox"
                                                        href="{{ asset($productImages->thumbnail) }}"
                                                        data-gallery="product-media-zoom">
                                                        <svg class="product__items--action__btn--svg"
                                                            xmlns="http://www.w3.org/2000/svg" width="22.51"
                                                            height="22.443" viewBox="0 0 512 512">
                                                            <path
                                                                d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                                stroke-width="32"></path>
                                                            <path fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-miterlimit="10"
                                                                stroke-width="32" d="M338.29 338.29L448 448"></path>
                                                        </svg>
                                                        <span class="visually-hidden">product view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                            </div>
                            <!--<div class="single__product--nav swiper" id="productMediaNav">-->
                            <!--    <div class="swiper-wrapper">-->

                            <!--            <div class="swiper-slide">-->
                            <!--                <div class="product__media--nav__items">-->
                            <!--                    <img class="product__media--nav__items--img"-->
                            <!--                        src="{{ asset($productImages->thumbnail) }}" alt="product-nav-img">-->
                            <!--                </div>-->
                            <!--            </div>-->

                            <!--    </div>-->
                            <!--    <div class="swiper__nav--btn swiper-button-next">-->
                            <!--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"-->
                            <!--            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"-->
                            <!--            stroke-linecap="round" stroke-linejoin="round" class="-chevron-right">-->
                            <!--            <polyline points="9 18 15 12 9 6"></polyline>-->
                            <!--        </svg>-->
                            <!--    </div>-->
                            <!--    <div class="swiper__nav--btn swiper-button-prev">-->
                            <!--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"-->
                            <!--            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"-->
                            <!--            stroke-linecap="round" stroke-linejoin="round" class="-chevron-left">-->
                            <!--            <polyline points="15 18 9 12 15 6"></polyline>-->
                            <!--        </svg>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>

                    </div>
                    <div class="col">
                        <div class="product__details--info">
                            <form action="#">
                                <h2 class="product__details--info__title mb-15">{{ $IsVariationProductDetails->title }}</h2>
                                <div class="product__details--info__price mb-12">
                                    <span class="current__price">
                                        @if ($user_session->price == 'price1')
                                            @php
                                                $price = $IsVariationProductDetails->price1;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price2')
                                            @php
                                                $price = $IsVariationProductDetails->price2;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price3')
                                            @php
                                                $price = $IsVariationProductDetails->price3;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price4')
                                            @php
                                                $price = $IsVariationProductDetails->price4;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price5')
                                            @php
                                                $price = $IsVariationProductDetails->price5;
                                            @endphp
                                        @endif
                                        {{ 'BS ' . $price }}
                                    </span>
                                    {{-- <span class="old__price">$68.00</span> --}}
                                </div>

                                <div class="product__variant">
                                    <div class="product__variant--list mb-10">
                                        <fieldset class="variant__input--fieldset">
                                            <legend class="product__variant--title mb-8">Color :</legend>
                                            <div class="variant__color d-flex">
                                                @php
                                                    // Fetch all product variations for the current product
                                                    $variations = \App\Models\ProductVariations::where(
                                                        'product_id',
                                                        $product->id,
                                                    )->get();

                                                    // Initialize an empty collection for filtered images
                                                    $filteredProductImages = collect();

                                                    // Fetch images for the main product (based on $product->id)
                                                    $mainProductImages = \App\Models\Product::where('id', $product->id)
                                                        ->orderBy('id', 'desc')
                                                        ->get();

                                                    // Merge main product images into the collection
                                                    $filteredProductImages = $filteredProductImages->merge(
                                                        $mainProductImages,
                                                    );

                                                    // Loop through each variation to fetch variation-specific images
                                                    foreach ($variations as $variation) {
                                                        // Fetch product images where SKU matches the variation SKU
                                                        $variationImages = \App\Models\Product::where(
                                                            'sku',
                                                            $variation->sku,
                                                        )
                                                            ->orderBy('id', 'desc')
                                                            ->get();

                                                        // Merge variation-specific images into the collection
                                                        $filteredProductImages = $filteredProductImages->merge(
                                                            $variationImages,
                                                        );
                                                    }

                                                    // Convert filtered product images collection to JSON for JavaScript
                                                    $filteredProductImagesJson = $filteredProductImages->toJson();
                                                @endphp
<style>
    .variant__color--list:hover .color-tooltip {
        visibility: visible;
        opacity: 1;
    }

    .variant__color--value {
        display: block;
        width: 60px;
        height: 60px;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 50%;
        overflow: hidden;
        transition: border-color 0.3s ease;
        position: relative;
    }

    .variant__color--value:hover {
        border-color: #000;
    }

    .color-tooltip {
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.75);
        color: black;
        text-align: center;
        border-radius: 5px;
        padding: 2px 5px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        z-index: 10;
    }
    .selected {
    border: 2px solid #000; /* Blue border to indicate selection */

    border-radius: 50%;
}
</style>
@foreach ($filteredProductImages as $row)

            @if ($row->id != $product->id)
           @php
    // Fetch the product variation by SKU
    $color = \App\Models\ProductVariations::where('sku', $row->sku)->first()->color;


@endphp
@if($row->id == $IsVariationProductDetails->id)
    <div class="variant__color--list selected" style="display: inline-block; margin: 10px; position: relative;">
@else
    <div class="variant__color--list" style="display: inline-block; margin: 10px; position: relative;">
@endif
            <a href="{{ url('product-details') }}/{{ $row->slug }}" class="variant__color--value" title="{{ $color }}" data-toggle="tooltip" data-placement="bottom">
                <img class="variant__color--value__img"
                     src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                     alt="variant-color-img"
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <span class="color-tooltip">{{ $color }}</span>
            </a>
        </div>

            @endif
        @endforeach

<!-- Ensure jQuery is loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include any other scripts that depend on jQuery here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize tooltips after jQuery is loaded -->
    <script>
       $(document).ready(function () {
            // Initialize tooltips
            $('.variant__color--value').tooltip({
                trigger: 'manual', // Use manual trigger
                animation: false // Disable animation for immediate tooltip update
            });

            // Handle mouse enter event
            $('.variant__color--value').mouseenter(function () {
                var color = $(this).find('.color-tooltip').data('color'); // Get color from data attribute
                $(this).attr('title', color); // Set the title attribute
                $(this).tooltip('show'); // Show the tooltip
            });

            // Handle mouse leave event
            $('.variant__color--value').mouseleave(function () {
                $(this).tooltip('hide'); // Hide the tooltip
            });
        });
    </script>







                                            </div>

                                            <div class="variant__color d-flex">



                                                <?php
    // Fetch the initial product variation by SKU
    $variation = \App\Models\ProductVariations::where('sku', $product->sku)->first();

    if ($variation) {
        // Fetch the product associated with the variation
        $product = \App\Models\Product::find($variation->product_id);

        if ($product) {
            // Fetch all other variants of the same product
            $otherVariants = \App\Models\ProductVariations::where('product_id', $product->id)->get();

            // Initialize an empty array for other variation images
            $otherVariationImages = [];

            // Loop through each variant to fetch its images
            foreach ($otherVariants as $variant) {
                // Fetch product images where SKU matches the variant SKU
                $images = \App\Models\Product::where('sku', $variant->sku)->get();

                // Add images to the array, keyed by variant SKU
                $otherVariationImages[$variant->sku] = $images;
            }
            ?>
            <style>
    .variant__color--list:hover .color-tooltip {
        visibility: visible;
        opacity: 1;
    }

    .variant__color--value {
        display: block;
        width: 60px;
        height: 60px;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 50%;
        overflow: hidden;
        transition: border-color 0.3s ease;
        position: relative;
    }

    .variant__color--value:hover {
        border-color: #000;
    }

    .color-tooltip {
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.75);
        color: black;
        text-align: center;
        border-radius: 5px;
        padding: 2px 5px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        z-index: 10;
    }
</style>
            @foreach ($otherVariationImages as $sku => $images)
    @foreach ($images as $image)
        @php
            $color = \App\Models\ProductVariations::where('sku', $image->sku)->first()->color;
        @endphp

        <div class="variant__color--list" style="display: inline-block; margin: 10px; position: relative;">
            <a href="{{ url('product-details') }}/{{ $image->slug }}" class="variant__color--value" title="{{ $color }}" data-toggle="tooltip" data-placement="bottom">
                 <img class="variant__color--value__img"
                     src="{{ asset('product_images/' . $image->f_thumbnail) }}"
                     alt="variant-color-img"
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <span class="color-tooltip">{{ $color }}</span>
            </a>
        </div>
    @endforeach
@endforeach
<script>
    $(document).ready(function () {
    // Initialize tooltips
    $('.variant__color--value').tooltip({
        trigger: 'manual', // Use manual trigger
        animation: false, // Disable animation for immediate tooltip update
        title: function () {
            return $(this).find('.color-tooltip').data('color'); // Set title dynamically from data attribute
        }
    });

    // Handle mouse enter event
    $('.variant__color--value').mouseenter(function () {
        $(this).tooltip('show'); // Show the tooltip
    });

    // Handle mouse leave event
    $('.variant__color--value').mouseleave(function () {
        $(this).tooltip('hide'); // Hide the tooltip
    });
});

</script>
            <?php
        }
    }
?>




                                            </div>



                                        </fieldset>
                                    </div>


                                    <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                       <div class="quantity__box">
    <button type="button" class="quantity__value quickview__value--quantity decrease decrease-btn" aria-label="quantity value" value="Decrease Value">-</button>
    <label>
        <input type="number" class="quantity__number quickview__value--number quantity-input" value="1" data-counter />
    </label>
    <button type="button" class="quantity__value quickview__value--quantity increase increase-btn" aria-label="quantity value" value="Increase Value">+</button>
</div>

<a class="primary__btn quickview__cart--btn" id="addToCartBtn-unique" href="{{ url('addToCart') }}/{{ $price }}/{{ $IsVariationProductDetails->id }}">Añadir al carrito</a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseButton = document.querySelector('.decrease-btn');
        const increaseButton = document.querySelector('.increase-btn');
        const quantityInput = document.querySelector('.quantity-input');
        const addToCartBtn = document.getElementById('addToCartBtn-unique');
        const baseUrl = '{{ url('addToCart') }}/{{ $price }}/{{ $IsVariationProductDetails->id }}';

        const updateQuantity = () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 1) {
                quantity = 1;
                quantityInput.value = 1;
            }
            addToCartBtn.setAttribute('href', `${baseUrl}/${quantity}`);
        };

        decreaseButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateQuantity();
            }
        });

        increaseButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
            updateQuantity();
        });

        quantityInput.addEventListener('change', () => {
            updateQuantity();
        });

        // Initialize the href with the default quantity
        updateQuantity();
    });
</script>

                                    </div>
                                    <div class="product__variant--list mb-15">
                                        <a class="variant__wishlist--icon mb-15"
                                            href="{{ url('addToWishlist') }}/{{ $price }}/{{ $IsVariationProductDetails->id }}"
                                            title="Add to wishlist">
                                            <svg class="quickview__variant--wishlist__svg"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            Añadir a la lista de deseos
                                        </a>
                                        <a class="text-center variant__buy--now__btn primary__btn"
                                            href="{{ url('BuyaddToCart') }}/{{ $price }}/{{ $IsVariationProductDetails->id . '/1' }}">Comprar ahora</a>
                                    </div>
                                    <div class="product__variant--list mb-15">
                                        <div class="product__details--info__meta">


                                        </div>
                                    </div>
                                </div>
                                <div class="quickview__social d-flex align-items-center mb-15">
                                    <label class="quickview__social--title">Compartir en redes sociales:</label>
                                    <ul class="quickview__social--wrapper mt-0 d-flex">
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.facebook.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                                    viewBox="0 0 7.667 16.524">
                                                    <path data-name="Path 237"
                                                        d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                                        transform="translate(-960.13 -345.407)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Facebook</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://twitter.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384"
                                                    viewBox="0 0 16.489 13.384">
                                                    <path data-name="Path 303"
                                                        d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z"
                                                        transform="translate(-951.23 -1140.849)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Twitter</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.instagram.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492"
                                                    viewBox="0 0 19.497 19.492">
                                                    <path data-name="Icon awesome-instagram"
                                                        d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z"
                                                        transform="translate(0.004 -1.492)" fill="currentColor"></path>
                                                </svg>
                                                <span class="visually-hidden">Instagram</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.youtube.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582"
                                                    viewBox="0 0 16.49 11.582">
                                                    <path data-name="Path 321"
                                                        d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z"
                                                        transform="translate(-951.269 -1359.8)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Youtube</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="guarantee__safe--checkout">
                                    <h5 class="guarantee__safe--checkout__title">Compra garantizada segura</h5>

                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="col">



                        <div class="product__details--media">
                            <div class="single__product--preview swiper mb-25">
                                @php
                                    // Fetch product images for the default color 'm'
                                    $productImages = \App\Models\Pro_image::where('product_id', $product->id)
                                        ->where('color', 'm')
                                        ->orderBy('id', 'desc')
                                        ->get();

                                @endphp
                                <div class="swiper-wrapper" id="productMediaSlider">
                                    @if (!empty($productImages) && count($productImages) > 0)
                                        @foreach ($productImages as $row)
                                            <div class="swiper-slide">
                                                <div class="product__media--preview__items">
                                                    <a class="product__media--preview__items--link glightbox"
                                                        data-gallery="product-media-preview"
                                                        href="{{ asset($row->thumbnail) }}">
                                                        <img class="product__media--preview__items--img"
                                                            src="{{ asset($row->thumbnail) }}" alt="product-media-img">
                                                    </a>
                                                    <div class="product__media--view__icon">
                                                        <a class="product__media--view__icon--link glightbox"
                                                            href="{{ asset($row->thumbnail) }}"
                                                            data-gallery="product-media-zoom">
                                                            <svg class="product__items--action__btn--svg"
                                                                xmlns="http://www.w3.org/2000/svg" width="22.51"
                                                                height="22.443" viewBox="0 0 512 512">
                                                                <path
                                                                    d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                                    fill="none" stroke="currentColor"
                                                                    stroke-miterlimit="10" stroke-width="32"></path>
                                                                <path fill="none" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-miterlimit="10"
                                                                    stroke-width="32" d="M338.29 338.29L448 448"></path>
                                                            </svg>
                                                            <span class="visually-hidden">product view</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox"
                                                    data-gallery="product-media-preview"
                                                    href="{{ asset('product_images/' . $product->f_thumbnail) }}">
                                                    <img class="product__media--preview__items--img"
                                                        src="{{ asset('product_images/' . $product->f_thumbnail) }}"
                                                        alt="product-media-img">
                                                </a>
                                                <div class="product__media--view__icon">
                                                    <a class="product__media--view__icon--link glightbox"
                                                        href="{{ asset('product_images/' . $product->f_thumbnail) }}"
                                                        data-gallery="product-media-zoom">
                                                        <svg class="product__items--action__btn--svg"
                                                            xmlns="http://www.w3.org/2000/svg" width="22.51"
                                                            height="22.443" viewBox="0 0 512 512">
                                                            <path
                                                                d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                                stroke-width="32"></path>
                                                            <path fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-miterlimit="10"
                                                                stroke-width="32" d="M338.29 338.29L448 448"></path>
                                                        </svg>
                                                        <span class="visually-hidden">product view</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="single__product--nav swiper" id="productMediaNav">
                                <div class="swiper-wrapper">
                                    @foreach ($productImages as $row)
                                        <div class="swiper-slide">
                                            <div class="product__media--nav__items">
                                                <img class="product__media--nav__items--img"
                                                    src="{{ asset($row->thumbnail) }}" alt="product-nav-img">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper__nav--btn swiper-button-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                                <div class="swiper__nav--btn swiper-button-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="-chevron-left">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="product__details--info">
                            <form action="#">
                                <h2 class="product__details--info__title mb-15">{{ $product->title }}</h2>
                                <div class="product__details--info__price mb-12">
                                    <span class="current__price">
                                        @if ($user_session->price == 'price1')
                                            @php
                                                $price = $product->price1;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price2')
                                            @php
                                                $price = $product->price2;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price3')
                                            @php
                                                $price = $product->price3;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price4')
                                            @php
                                                $price = $product->price4;
                                            @endphp
                                        @endif
                                        @if ($user_session->price == 'price5')
                                            @php
                                                $price = $product->price5;
                                            @endphp
                                        @endif
                                        {{ 'BS ' . $price }}
                                    </span>
                                    {{-- <span class="old__price">$68.00</span> --}}
                                </div>

                                <div class="product__variant">
                                    <div class="product__variant--list mb-10">
                                        <fieldset class="variant__input--fieldset">
                                            <legend class="product__variant--title mb-8">Color :</legend>
                                            <div class="variant__color d-flex">
                                                @php
                                                    // Fetch all product variations for the current product
                                                    $variations = \App\Models\ProductVariations::where(
                                                        'product_id',
                                                        $product->id,
                                                    )->get();

                                                    // Initialize an empty collection for filtered images
                                                    $filteredProductImages = collect();

                                                    // Fetch images for the main product (based on $product->id)
                                                    $mainProductImages = \App\Models\Product::where('id', $product->id)
                                                        ->orderBy('id', 'desc')
                                                        ->get();

                                                    // Merge main product images into the collection
                                                    $filteredProductImages = $filteredProductImages->merge(
                                                        $mainProductImages,
                                                    );

                                                    // Loop through each variation to fetch variation-specific images
                                                    foreach ($variations as $variation) {
                                                        // Fetch product images where SKU matches the variation SKU
                                                        $variationImages = \App\Models\Product::where(
                                                            'sku',
                                                            $variation->sku,
                                                        )
                                                            ->orderBy('id', 'desc')
                                                            ->get();

                                                        // Merge variation-specific images into the collection
                                                        $filteredProductImages = $filteredProductImages->merge(
                                                            $variationImages,
                                                        );
                                                    }

                                                    // Convert filtered product images collection to JSON for JavaScript
                                                    $filteredProductImagesJson = $filteredProductImages->toJson();
                                                @endphp
<style>
    .variant__color--list:hover .color-tooltip {
        visibility: visible;
        opacity: 1;
    }

    .variant__color--value {
        display: block;
        width: 60px;
        height: 60px;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 50%;
        overflow: hidden;
        transition: border-color 0.3s ease;
        position: relative;
    }

    .variant__color--value:hover {
        border-color: #000;
    }

    .color-tooltip {
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.75);
        color: black;
        text-align: center;
        border-radius: 5px;
        padding: 2px 5px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        z-index: 10;
    }
</style>
@foreach ($filteredProductImages as $row)

            @if ($row->id != $product->id)
           @php
    // Fetch the product variation by SKU
    $color = \App\Models\ProductVariations::where('sku', $row->sku)->first()->color;


@endphp

                <div class="variant__color--list" style="display: inline-block; margin: 10px; position: relative;">
            <a href="{{ url('product-details') }}/{{ $row->slug }}" class="variant__color--value" title="{{ $color }}" data-toggle="tooltip" data-placement="bottom">
                <img class="variant__color--value__img"
                     src="{{ asset('product_images/' . $row->f_thumbnail) }}"
                     alt="variant-color-img"
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <span class="color-tooltip">{{ $color }}</span>
            </a>
        </div>
            @endif
        @endforeach

<!-- Ensure jQuery is loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include any other scripts that depend on jQuery here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize tooltips after jQuery is loaded -->
    <script>
       $(document).ready(function () {
            // Initialize tooltips
            $('.variant__color--value').tooltip({
                trigger: 'manual', // Use manual trigger
                animation: false // Disable animation for immediate tooltip update
            });

            // Handle mouse enter event
            $('.variant__color--value').mouseenter(function () {
                var color = $(this).find('.color-tooltip').data('color'); // Get color from data attribute
                $(this).attr('title', color); // Set the title attribute
                $(this).tooltip('show'); // Show the tooltip
            });

            // Handle mouse leave event
            $('.variant__color--value').mouseleave(function () {
                $(this).tooltip('hide'); // Hide the tooltip
            });
        });
    </script>







                                            </div>

                                            <div class="variant__color d-flex">



                                                <?php
    // Fetch the initial product variation by SKU
    $variation = \App\Models\ProductVariations::where('sku', $product->sku)->first();

    if ($variation) {
        // Fetch the product associated with the variation
        $product = \App\Models\Product::find($variation->product_id);

        if ($product) {
            // Fetch all other variants of the same product
            $otherVariants = \App\Models\ProductVariations::where('product_id', $product->id)->get();

            // Initialize an empty array for other variation images
            $otherVariationImages = [];

            // Loop through each variant to fetch its images
            foreach ($otherVariants as $variant) {
                // Fetch product images where SKU matches the variant SKU
                $images = \App\Models\Product::where('sku', $variant->sku)->get();

                // Add images to the array, keyed by variant SKU
                $otherVariationImages[$variant->sku] = $images;
            }
            ?>
            <style>
    .variant__color--list:hover .color-tooltip {
        visibility: visible;
        opacity: 1;
    }

    .variant__color--value {
        display: block;
        width: 60px;
        height: 60px;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 50%;
        overflow: hidden;
        transition: border-color 0.3s ease;
        position: relative;
    }

    .variant__color--value:hover {
        border-color: #000;
    }

    .color-tooltip {
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.75);
        color: black;
        text-align: center;
        border-radius: 5px;
        padding: 2px 5px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        z-index: 10;
    }
     .selected {
    border: 2px solid #000; /* Blue border to indicate selection */

    border-radius: 50%;
}
</style>
            @foreach ($otherVariationImages as $sku => $images)
    @foreach ($images as $image)
        @php
            $color = \App\Models\ProductVariations::where('sku', $image->sku)->first()->color;
        @endphp
@if($image->id == $latestProductId)
    <div class="variant__color--list selected" style="display: inline-block; margin: 10px; position: relative;">
@else
    <div class="variant__color--list" style="display: inline-block; margin: 10px; position: relative;">
@endif

            <a href="{{ url('product-details') }}/{{ $image->slug }}" class="variant__color--value" title="{{ $color }}" data-toggle="tooltip" data-placement="bottom">
                 <img class="variant__color--value__img"
                     src="{{ asset('product_images/' . $image->f_thumbnail) }}"
                     alt="variant-color-img"
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <span class="color-tooltip">{{ $color }}</span>
            </a>
        </div>
    @endforeach
@endforeach
<script>
    $(document).ready(function () {
    // Initialize tooltips
    $('.variant__color--value').tooltip({
        trigger: 'manual', // Use manual trigger
        animation: false, // Disable animation for immediate tooltip update
        title: function () {
            return $(this).find('.color-tooltip').data('color'); // Set title dynamically from data attribute
        }
    });

    // Handle mouse enter event
    $('.variant__color--value').mouseenter(function () {
        $(this).tooltip('show'); // Show the tooltip
    });

    // Handle mouse leave event
    $('.variant__color--value').mouseleave(function () {
        $(this).tooltip('hide'); // Hide the tooltip
    });
});

</script>
            <?php
        }
    }
?>




                                            </div>



                                        </fieldset>
                                    </div>


                                    <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                        <div class="quantity__box">
                                            <button type="button"
                                                class="quantity__value quickview__value--quantity decrease"
                                                aria-label="quantity value" value="Decrease Value">-</button>
                                            <label>
                                                <input type="number" class="quantity__number quickview__value--number"
                                                    value="1" data-counter />
                                            </label>
                                            <button type="button"
                                                class="quantity__value quickview__value--quantity increase"
                                                aria-label="quantity value" value="Increase Value">+</button>
                                        </div>

                                        <a class="primary__btn quickview__cart--btn" id="addToCartBtn"
                                            href="{{ url('addToCart') }}/{{ $price }}/{{ $latestProductId }}">Añadir al carrito</a>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const decreaseButton = document.querySelector('.decrease');
                                                const increaseButton = document.querySelector('.increase');
                                                const quantityInput = document.querySelector('.quantity__number');
                                                const addToCartBtn = document.getElementById('addToCartBtn');
                                                const baseUrl = '{{ url('addToCart') }}/{{ $price }}/{{ $latestProductId }}';

                                                const updateQuantity = () => {
                                                    let quantity = parseInt(quantityInput.value);
                                                    if (quantity < 1) {
                                                        quantity = 1;
                                                        quantityInput.value = 1;
                                                    }
                                                    addToCartBtn.setAttribute('href', `${baseUrl}/${quantity}`);
                                                };

                                                decreaseButton.addEventListener('click', () => {
                                                    let currentValue = parseInt(quantityInput.value);
                                                    if (currentValue > 1) {
                                                        quantityInput.value = currentValue - 1;
                                                        updateQuantity();
                                                    }
                                                });

                                                increaseButton.addEventListener('click', () => {
                                                    let currentValue = parseInt(quantityInput.value);
                                                    quantityInput.value = currentValue;
                                                    updateQuantity();
                                                });

                                                quantityInput.addEventListener('change', () => {
                                                    updateQuantity();
                                                });

                                                // Initialize the href with the default quantity
                                                updateQuantity();
                                            });
                                        </script>
                                    </div>
                                    <div class="product__variant--list mb-15">
                                        <a class="variant__wishlist--icon mb-15"
                                            href="{{ url('addToWishlist') }}/{{ $price }}/{{ $latestProductId }}"
                                            title="Add to wishlist">
                                            <svg class="quickview__variant--wishlist__svg"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path
                                                    d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            Añadir a la lista de deseos
                                        </a>
                                        <a class="text-center variant__buy--now__btn primary__btn"
                                            href="{{ url('BuyaddToCart') }}/{{ $price }}/{{ $latestProductId . '/1' }}">Comprar ahora</a>
                                    </div>
                                    <div class="product__variant--list mb-15">
                                        <div class="product__details--info__meta">


                                        </div>
                                    </div>
                                </div>
                                <div class="quickview__social d-flex align-items-center mb-15">
                                    <label class="quickview__social--title">Compartir en redes sociales:</label>
                                    <ul class="quickview__social--wrapper mt-0 d-flex">
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.facebook.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                                    viewBox="0 0 7.667 16.524">
                                                    <path data-name="Path 237"
                                                        d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                                        transform="translate(-960.13 -345.407)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Facebook</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://twitter.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384"
                                                    viewBox="0 0 16.489 13.384">
                                                    <path data-name="Path 303"
                                                        d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z"
                                                        transform="translate(-951.23 -1140.849)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Twitter</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.instagram.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492"
                                                    viewBox="0 0 19.497 19.492">
                                                    <path data-name="Icon awesome-instagram"
                                                        d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z"
                                                        transform="translate(0.004 -1.492)" fill="currentColor"></path>
                                                </svg>
                                                <span class="visually-hidden">Instagram</span>
                                            </a>
                                        </li>
                                        <li class="quickview__social--list">
                                            <a class="quickview__social--icon" target="_blank"
                                                href="https://www.youtube.com/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582"
                                                    viewBox="0 0 16.49 11.582">
                                                    <path data-name="Path 321"
                                                        d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z"
                                                        transform="translate(-951.269 -1359.8)" fill="currentColor" />
                                                </svg>
                                                <span class="visually-hidden">Youtube</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="guarantee__safe--checkout">
                                    <h5 class="guarantee__safe--checkout__title">Compra garantizada segura</h5>

                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- End product details section -->




        <!-- Start product details tab section -->
        <section class="product__details--tab__section section--padding">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
    <ul class="product__tab--one product__details--tab d-flex mb-30">
        <li class="product__details--tab__list active" data-toggle="tab" data-target="#short_description">
            Breve descripción
        </li>
        <li class="product__details--tab__list" data-toggle="tab" data-target="#description">
            Descripción
        </li>
    </ul>
    <div class="product__details--tab__inner border-radius-10">
        <div class="tab-content">
            <div id="short_description" class="tab-pane active show">
                <div class="product__tab--content">
                    {!! $product->short_desc !!}
                </div>
            </div>
            <div id="description" class="tab-pane">
                <div class="product__tab--content">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </section>
        <!-- End product details tab section -->

        <!-- Start product section -->
        <section class="product__section section--padding ">
            <div class="container">
                <div class="section__heading border-bottom mb-30">
                    <h2 class="section__heading--maintitle">TAMBIÉN TE PODRÍA GUSTAR</h2>
                </div>
                <div class="product__section--inner pb-15 product__swiper--activation swiper">
                    <div class="swiper-wrapper">
                        @if (!empty($related_products))
                            @foreach ($related_products as $row)
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
                                                    href="{{ url('addToCart') }}/{{ $price }}/{{ $row->id . '/1' }}">
                                                    <svg width="14" height="11" viewBox="0 0 14 11"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    Añadir al carrito
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let startTime = performance.now(); // Record the start time when the page is loaded

            // Capture time spent when the user leaves the page (clicks on a link)
            $('a').on('click', function(event) {
                let endTime = performance.now(); // Record the end time when the user clicks on a link
                let timeSpent = endTime - startTime; // Calculate time spent on the page in milliseconds

                // Send the data to the server using Ajax
                $.ajax({
                    url: '{{ route('track.time') }}', // Replace with your route to track time
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        timeSpent: timeSpent,
                        url: window.location.href,
                        productId: '{{ $product->id }}' // Assuming $product->id is available in your Blade template
                    }),
                    success: function(data) {
                        console.log('Screen time tracked successfully:', data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error tracking screen time:', error);
                    }
                });
            });
        });
    </script>
@endsection
