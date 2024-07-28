@extends('admin.Master')
@section('title')
Socialite 
@endsection
@section('content')
<!-- page-wrapper Start-->
<div class="page-body">
   <div class="container-fluid">
      <!-- sign up page start-->
      <div class="auth-bg-video">
      <video id="bgvid" poster="{{asset('admin/images/coming-soon-bg.jpg')}}" playsinline="" autoplay="" muted="" loop="">
               <source src="{{asset('admin/video/auth-bg.mp4')}}" type="video/mp4">
            </video>
         <div class="container">
            <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
            <div class="card mt-4 p-4">
               <h4 class="text-center">Inicio de Sesión Socialite</h4>

               <form class="theme-form" action="{{route('update_social_login_settings')}}" method="post">
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
                  @csrf

                  <div class="row g-1">


                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">Inicio de Sesión de Google</label>
                           <select class="form-control select2" name="google_login">
                              <option value="">Please Select</option>
                              <option value="yes" @if($settings->google_login=="yes") selected @endif>Sí</option>
                              <option value="no" @if($settings->google_login=="no") selected @endif>No</option>

                           </select>
                           <span class="text-danger">@error('google_login'){{$message}}@enderror</span>

                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">ID de Cliente de Google</label>
                           <input class="form-control" type="text" name="google_client_id"
                              value="{{$settings->google_client_id}}">
                           <span class="text-danger">@error('google_client_id'){{$message}}@enderror</span>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">ID Secreto de Google</label>
                           <input class="form-control" type="text" name="google_secret_id"
                              value="{{$settings->google_client_secret}}">
                           <span class="text-danger">@error('google_secret_id'){{$message}}@enderror</span>
                        </div>
                     </div>
                     <hr>

                     <!-- facebook -->

                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">ID Secreto de Google</label>
                           <select class="form-control select2" name="Facebook_login" >
                              <option value="">Por favor selecciona</option>
                              <option value="yes" @if($settings->facebook_login=="yes") selected @endif>Sí</option>
                              <option value="no" @if($settings->facebook_login=="no") selected @endif>No</option>

                           </select>

                           <span class="text-danger">@error('Facebook_login'){{$message}}@enderror</span>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">ID de Cliente de Facebook</label>
                           <input class="form-control" type="text" name="Facebook_client_id"
                              value="{{$settings->facebook_app_id}}">
                           <span class="text-danger">@error('Facebook_client_id'){{$message}}@enderror</span>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="mb-3">
                           <label class="col-form-label">ID de Aplicación de Facebook</label>
                           <input class="form-control" type="text" name="Facebook_app_id"
                              value="{{$settings->facebook_client_secret}}">
                           <span class="text-danger">@error('Facebook_app_id'){{$message}}@enderror</span>
                        </div>
                     </div>
                  </div>
                  <hr>


                  <!-- linkedin -->


                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">Inicio de Sesión de LinkedIn</label>

                        <select class="form-control select2" name="linkedin_login" >
                           <option value="">Please Select</option>
                           <option value="yes" @if($settings->linkedin_login=="yes") selected @endif>Yes</option>
                              <option value="no" @if($settings->linkedin_login=="no") selected @endif>No</option>

                        </select>
                        <span class="text-danger">@error('linkedin_login'){{$message}}@enderror</span>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">linkedin Client Id</label>
                        <input class="form-control" type="text" name="linkedin_client_id"
                           value="{{$settings->linkedin_client_id}}">
                        <span class="text-danger">@error('linkedin_client_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">linkedin App Id</label>
                        <input class="form-control" type="text" name="linkedin_app_id"
                           value="{{$settings->linkedin_app_id}}">
                        <span class="text-danger">@error('linkedin_app_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <hr>

                  <!-- insta -->
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">Inicio de Sesión de Instagram</label>

                        <select class="form-control select2" name="Instagram_login">
                           <option value="">Please Select</option>
                           <option value="yes" @if($settings->Instagram_login=="yes") selected @endif>Yes</option>
                              <option value="no" @if($settings->Instagram_login=="no") selected @endif>No</option>

                        </select>
                        <span class="text-danger">@error('Instagram_login'){{$message}}@enderror</span>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">ID de Aplicación de Instagram</label>
                        <input class="form-control" type="text" name="Instagram_client_id"
                           value="{{$settings->Instagram_client_id}}">
                        <span class="text-danger">@error('Instagram_client_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">Instagram App Id</label>
                        <input class="form-control" type="text" name="instagram_app_id"
                           value="{{$settings->instagram_app_id}}">
                        <span class="text-danger">@error('instagram_app_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <hr>

                  <!-- git  -->


                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">Inicio de Sesión de Git</label>
                        <select class="form-control select2" name="git_login">
                           <option value="">Please Select</option>
                           <option value="yes" @if($settings->git_login=="yes") selected @endif>Yes</option>
                              <option value="no" @if($settings->git_login=="no") selected @endif>No</option>

                        </select>

                        <span class="text-danger">@error('git_login'){{$message}}@enderror</span>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">ID de Cliente de Git</label>
                        <input class="form-control" type="text" name="git_client_id" value="{{$settings->git_client_id}}">
                        <span class="text-danger">@error('git_client_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">ID de Aplicación de Git</label>
                        <input class="form-control" type="text" name="git_app_id" value="{{$settings->git_app_id}}">
                        <span class="text-danger">@error('git_app_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <hr />

                  <!-- twitter -->

                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">Inicio de Sesión de Twitter</label>
                        <select class="form-control select2" name="twitter_login">
                           <option value="">Please Select</option>
                           <option value="yes" @if($settings->twitter_login=="yes") selected @endif>Yes</option>
                              <option value="no" @if($settings->twitter_login=="no") selected @endif>No</option>

                        </select>
                        <span class="text-danger">@error('twitter_login'){{$message}}@enderror</span>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">ID de Cliente de Twitter</label>
                        <input class="form-control" type="text" name="twitter_client_id"
                           value="{{$settings->twitter_client_id}}">
                        <span class="text-danger">@error('twitter_client_id'){{$message}}@enderror</span>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="mb-3">
                        <label class="col-form-label">ID de Aplicación de Twitter</label>
                        <input class="form-control" type="text" name="twitter_app_id" value="{{$settings->twitter_app_id}}">
                        <span class="text-danger">@error('twitter_app_id'){{$message}}@enderror</span>
                     </div>
                  </div>

                  <div class="row g-2">
                     <div class="col-sm-4">
                        <button class="btn btn-primary" type="submit">Guardar</button>
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