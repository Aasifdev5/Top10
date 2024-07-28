@extends('master')
@section('title')
    {{ __('Explorar Proyecto') }} || {{ $title }}
@endsection
@section('content')
    <!--Project Page Two Start-->
    <section class="project-page-two">
        <div class="container">
            <div class="row">
                <!--Recommended One Single Start-->
                @foreach ($campaigns as $row)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="recommended-one__single">
                        <div class="recommended-one__img-box">
                            <div class="recommended-one__img">
                                <img src="{{ getImageFile($row->image) }}" alt="">
                            </div>

                            @php
                                $likeCount = \App\Models\Like::where('project_id', $row->id)->count();
                            @endphp

                            <div class="recomanded-one__icon">
                                <i class="far fa-heart fas text-danger" id="heart-icon{{ $row->id }}" data-project-id="{{ $row->id }}"></i>
                                <br>
                                <span id="like-count{{ $row->id }}" class="like-count" style="color:#fff">
                                    {{ $likeCount }}
                                </span>
                            </div>
                        </div>

                        <div class="recommended-one__content">
                            <div class="recommended-one__tag-and-remaining">
                                <div class="recommended-one-tag">
                                    @php
                                        $category = \App\Models\Category::find($row->category_id);
                                        $days_left = $row->days_left();
                                        $amount_prefilled = $row->amount_prefilled();
                                    @endphp
                                    <p>{{ $category->name }}</p>
                                </div>
                                <div class="recommended-one__remaing">
                                    <div class="icon">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div class="text">
                                        <p>{{ $days_left }} {{ __('Días Restantes') }}</p>
                                    </div>
                                </div>
                            </div>
                            <h3 class="recommended-one__title"><a href="{{ url('project-details/') }}{{ '/' . $row->slug }}">{{ $row->title }}</a></h3>
                            <div class="progress-levels">
                                <!--Skill Box-->
                                <div class="progress-box">
                                    <div class="inner count-box">
                                        <div class="bar">
                                            <div class="bar-innner">
                                                <?php
                                                // Output the percentage raised in your HTML
                                                ?>
                                                @foreach ($percentRaisedArray as $projectId => $percentRaised)
                                                    @if ($row->id == $projectId)
                                                        <div class="skill-percent">
                                                            <span class="count-text" data-speed="3000" data-stop="{{ $percentRaised }}">0</span>
                                                            <span class="percent">%</span>
                                                        </div>
                                                        <div class="bar-fill" data-percent="{{ $percentRaised }}"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="project-one__goals">
                                <p class="project-one__goals-one">
                                    <span>BS @foreach ($totalRaisedArray as $projectId => $Raised)
                                            @if ($row->id == $projectId)
                                                {{ $Raised }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <br>{{ __('Meta de') }} BS {{ $row->goal }}
                                </p>
                                <p class="project-one__goals-one">
                                    <span class="odometer project-one__plus" data-count="{{ \App\Models\Payment::where('campaign_id', $row->id)->where('accepted', 1)->get()->count() }}"></span>
                                    <br>{{ __('Patrocinadores que Hemos Obtenido') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


                <!--Recommended One Single End-->

            </div>
        </div>
    </section>


       <!-- Toastr CSS -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

       <!-- jQuery (required) -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       <!-- Toastr JavaScript -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


       <script>
           $(document).ready(function() {
                   toastr.options = {
                       "closeButton": true,
                       "progressBar": true,
                       "positionClass": "toast-top-right",
                       "preventDuplicates": true,
                       "showDuration": "300",
                       "hideDuration": "1000",
                       "timeOut": "5000",
                       "extendedTimeOut": "1000",
                   };


                   $('[id^="heart-icon"]').click(function() {
                       var projectId = $(this).data('project-id');
                       var icon = $(this);

                       $.ajax({
                           type: 'POST',
                           url: "{{ route('like') }}", // Use the named route
                           data: {
                               projectId: projectId,
                           },
                           headers: {
                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                           success: function(data) {
                               if (data.success) {
                                   toastr.success(data.message, "", {
                                       onHidden: function() {
                                           window.location.reload(); // Reload the page after toastr is hidden
                                       }
                                   });
                               } else {
                                   toastr.error(data.message); // Display error message
                               }
                           },
                           error: function(xhr, status, error) {
                               console.error(xhr.responseText);
                               toastr.error("Like Request Failed. Please try again later.");
                           }
                       });
                   });
               });
       </script>

    <!--Project Page Two End-->
@endsection
@php
    use App\Http\Controllers\UserController;
@endphp
<div style="display: none;">
    Route::post('/like', [UserController::class,'storeLikes'])->name('like');
</div>
