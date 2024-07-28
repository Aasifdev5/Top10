@extends('admin.Master')
@section('title')
Editar Project
@endsection
@section('content')
<!-- page-wrapper Start-->
<div class="page-wrapper">
   <div class="container-fluid">
      <!-- sign up page start-->
      <div class="auth-bg-video">
      <video id="bgvid" poster="{{asset('admin/images/coming-soon-bg.jpg')}}" playsinline="" autoplay="" muted="" loop="">
               <source src="{{asset('admin/video/auth-bg.mp4')}}" type="video/mp4">
            </video>
         <div class="col-sm-8">
            <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
            <div class="card mt-4 p-4">
               <h4 class="text-center">Editar Project</h4>


               <form action="{{ url('admin/update_course') }}" enctype="multipart/form-data" id="startCampaignForm" class=" theme-form form-horizontal" method="post">
                @if (Session::has('success'))
                        <div class="alert alert-success" style="background-color: green;">
                            <p style="color: #fff;">{{ session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger" style="background-color: red;">
                            <p style="color: #fff;">{{ session::get('fail') }}</p>
                        </div>
                    @endif
                @csrf
                <input type="hidden" name="id" value="{{$project_detail->id}}">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Información Disponible de Función
                    </div>
                </div>
                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    <label for="category" class="col-sm-4 control-label">Categoría <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="category">
                            <option value="">Selecciona una Categoría</option>
                            @foreach ($category as $cat)
                            <option value="{{ $cat->id }}" {{ $project_detail->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->has('category') ? '<p class="help-block">' . $errors->first('category') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="col-sm-4 control-label">Título <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" value="{{ $project_detail->title }}" name="title" placeholder="Title">
                        {!! $errors->has('title') ? '<p class="help-block">' . $errors->first('title') . '</p>' : '' !!}
                        <p class="text-info">Gran información de título</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                    <label for="short_description" class="col-sm-4 control-label">Descripción Corta</label>
                    <div class="col-sm-8">
                        <textarea name="short_description" id="" class=" form-control" rows="3">{{ $project_detail->short_description }}</textarea>
                        {!! $errors->has('short_description') ? '<p class="help-block">' . $errors->first('short_description') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description" class="col-sm-3 control-label">Descripción <span class="field-required">*</span></label>
                    <div class="col-sm-12">
                        <div class="alert alert-info">  Limitación de Inserción de Imagen </div>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="description" class="editor form-control description" rows="8">{{ $project_detail->description }}</textarea>
                        {!! $errors->has('description') ? '<p class="help-block">' . $errors->first('description') . '</p>' : '' !!}
                        <p class="text-info"> Texto de Información de Descripción</p>
                    </div>
                </div>


                <div class="alert alert-info">
                    <h3><i class="fa fa-money"></i> Obtendrás el 80% del Total Recaudado</h3>
                </div>

                <div class="form-group {{ $errors->has('goal') ? 'has-error' : '' }}">
                    <label for="goal" class="col-sm-4 control-label">Meta <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="goal" value="{{ $project_detail->goal }}" name="goal" placeholder="Goal">
                        {!! $errors->has('goal') ? '<p class="help-block">' . $errors->first('goal') . '</p>' : '' !!}
                    </div>
                </div>



                <div class="form-group {{ $errors->has('end_method') ? 'has-error' : '' }}">
                    <label for="end_method" class="col-sm-4 control-label">Método de Finalización de Campaña</label>
                    <div class="col-sm-8">
                        <label>
                            <input type="radio" name="end_method" value="goal_achieve" {{ $project_detail->end_method == 'goal_achieve' ? 'checked' : '' }}> Después de Alcanzar la Meta
                        </label> <br />

                        <label>
                            <input type="radio" name="end_method" value="end_date" {{ $project_detail->end_method == 'end_date' ? 'checked' : '' }}> Después de la Fecha de Finalización
                        </label> <br />

                        {!! $errors->has('end_method') ? '<p class="help-block">' . $errors->first('end_method') . '</p>' : '' !!}
                        <p class="text-info"> Texto de Información de Método de Finalización</p>
                    </div>
                </div>


                <div class="custom-form-group mb-25">
                    <label for="image" class="text-lg-right text-black mb-2">{{ __('Imagen') }}</label>
                    <div class="upload-img-box mb-25">
                        <img src="{{ $project_detail->image ? asset($project_detail->image) : '' }}" id="image_preview" style="max-width: 100%; max-height: 200px;" />
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">
                        <div class="upload-img-box-icon">
                            <i class="fa fa-camera"></i>
                            <p class="m-0">{{ __('Imagen') }}</p>
                        </div>
                    </div>
                    @if ($errors->has('image'))
                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                    @endif
                    <p>{{ __('Archivos de Imagen Aceptados') }}: PNG <br> {{ __('Tamaño Recomendado') }}: 60 x 60 (1MB)</p>
                </div>


                <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                    <label for="video" class="col-sm-4 control-label">Video</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="video" value="{{ old('video') }}" name="video" placeholder="Video">
                        {!! $errors->has('video') ? '<p class="help-block">' . $errors->first('video') . '</p>' : '' !!}
                        <p class="text-info"> Texto de Información de Video</p>
                    </div>
                </div>

                <div class="input__group mb-25">
                    <label>{{ __('Imagen OG') }}</label>
                    <div class="upload-img-box">
                        <img src="{{ $project_detail->og_image ? asset($project_detail->og_image) : '' }}" id="og_image_preview" style="max-width: 100%; max-height: 200px;" />
                        <input type="file" name="og_image" id="og_image" accept="image/*" onchange="previewFile(this)">
                        <div class="upload-img-box-icon">
                            <i class="fa fa-camera"></i>
                            <p class="m-0">{{ __('Imagen OG') }}</p>
                        </div>
                    </div>
                    @if ($errors->has('og_image'))
                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('og_image') }}</span>
                    @endif
                    <p><span class="text-black">{{ __('Archivos de Imagen Aceptados') }}:</span> PNG, JPG <br>
                        <span class="text-black">{{ __('Tamaño Recomendado') }}:</span> 1200 x 627
                    </p>
                </div>

                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                    <label for="country_id" class="col-sm-4 control-label">Country <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="country_id">
                            <option value="">Select a Country</option>
                            @foreach ($countries as $country)
                            @php
                            // Assuming $country['name'] is a JSON string
                            $countryData = json_decode($country['name'], true);

                            // Access the "en" value
                            $englishValue = isset($countryData['en']) ? $countryData['en'] : '';
                            @endphp
                            <option value="{{ $country->id }}" {{ $project_detail->country_id == $country->id ? 'selected' : '' }}>{{ $englishValue }}</option>
                            <!-- Add more table cells for additional fields as needed -->
                            @endforeach
                        </select>
                        {!! $errors->has('country_id') ? '<p class="help-block">' . $errors->first('country_id') . '</p>' : '' !!}
                    </div>
                </div>


                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="address" class="col-sm-4 control-label">Dirección</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" value="{{ $project_detail->address }}" name="address" placeholder="Dirección">
                        {!! $errors->has('address') ? '<p class="help-block">' . $errors->first('address') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <label for="start_date" class="col-sm-4 control-label">Fecha de Inicio</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="start_date" value="{{ $project_detail->start_date }}" name="start_date" placeholder="Fecha de Inicio">
                        {!! $errors->has('start_date') ? '<p class="help-block">' . $errors->first('start_date') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                    <label for="end_date" class="col-sm-4 control-label">Fecha de Finalización</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="end_date" value="{{ $project_detail->end_date }}" name="end_date" placeholder="Fecha de Finalización">
                        {!! $errors->has('end_date') ? '<p class="help-block">' . $errors->first('end_date') . '</p>' : '' !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="approval_status" class="col-sm-4 control-label">Estado de Aprobación <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="status">
                            <option value="">Seleccionar Estado de Aprobación</option>
                            <option value="0" {{ $project_detail->status == '0' ? 'selected' : '' }}>Pendiente</option>
                            <option value="1" {{ $project_detail->status == '1' ? 'selected' : '' }}>Aprobado</option>
                            <option value="-1" {{ $project_detail->status == '-1' ? 'selected' : '' }}>Bloqueado</option>
                        </select>
                        <!-- Display validation error if exists -->
                        {!! $errors->has('status') ? '<p class="help-block">' . $errors->first('status') . '</p>' : '' !!}
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Actualizar Campaña</button>
                    </div>
                </div>

            </form>
            </div>
         </div>
      </div>
   </div>

   <!-- sign up page ends-->
</div>
</div>
<!-- page-wrapper Ends-->
@endsection
