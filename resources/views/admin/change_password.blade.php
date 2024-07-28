@extends('admin.Master')
@section('title')
Change Password
@endsection
@section('content')
@section('content')
    <div class="page-wrapper page-settings">

        <div class="content w-100">
            <div class="content-page-header">
                <h5>Change Password</h5>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="theme-form" action="update_password" method="post">
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
                                <input type="hidden" name="id" value="{{$user_session->id}}">
                                <div class="row g-1">

                                   <div class="col-md-6">
                                      <div class="mb-3">
                                         <label class="col-form-label">Old Password</label>
                                         <input class="form-control" type="password" name="old_password" value="{{old('old_password')}}"
                                           >
                                         <span class="text-danger">@error('old_password'){{$message}}@enderror</span>
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                      <div class="mb-3">
                                         <label class="col-form-label">New Password</label>
                                         <input class="form-control" type="password" name="new_password" value="{{old('new_password')}}"
                                            >
                                         <span class="text-danger">@error ('new_password'){{$message}}@enderror</span>
                                      </div>
                                   </div>
                                </div>
                                <div class="mb-3">
                                   <label class="col-form-label">Confirm Password</label>
                                   <input class="form-control" type="password" name="confirm_password" value="{{old('confirm_password')}}"
                                      >
                                   <span class="text-danger">@error ('confirm_password'){{$message}}@enderror</span>

                                </div>


                                <div class="row g-2">
                                   <div class="col-sm-4">
                                      <button class="btn btn-primary" type="submit">Update</button>
                                   </div>

                                </div>

                             </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
