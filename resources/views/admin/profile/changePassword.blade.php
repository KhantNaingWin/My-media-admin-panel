@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert Start --}}
                @if(session('fail'))
                <div class="alert alert-danger alert-dismissible fade show btn-close close " aria-label="Close" role="alert">
                    {{ session('fail') }}
               </div>

                @endif

                 {{-- alert End --}}
              <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="POST">
                @csrf
                <div class="form-group row">

                  <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="oldPassword" placeholder="Enter old password">
                    @error('oldPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="newPassword" placeholder="Enter new password">
                    @error('newPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="confirmPassword" placeholder="Enter confirm password">
                      @error('confirmPassword')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
