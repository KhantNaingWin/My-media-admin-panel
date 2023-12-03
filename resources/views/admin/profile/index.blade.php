@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert Start --}}
                @if(session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show btn-close " aria-label="Close" role="alert">
                    {{ session('updateSuccess') }}
               </div>

                @endif

                 {{-- alert End --}}
              <form class="form-horizontal" action="{{ route('admin#update') }}" method="POST">
                @csrf
                <div class="form-group row">

                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputName" placeholder="Name" value="{{ old('inputName',$user->name) }}">
                    @error('inputName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="inputEmail" placeholder="Email" value="{{ old('inputEmail',$user->email) }}">
                    @error('inputEmail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputPhone" placeholder="Phone" value="{{ $user->phone }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea  class="form-control" placeholder="address" name="inputAddress" cols="30" rows="10">{{ $user->address }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="inputGender"  class="form-control">
                        <option value="empty" @if($user->gender == null ) selected @endif>Choose Gender</option>
                        <option value="male"  @if($user->gender == "male" ) selected @endif>Male</option>
                        <option value="female"  @if($user->gender == "female" ) selected @endif>Female</option>
                      </select>
                    </div>
                  </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{ route('admin#directChangePassword') }}">Change Password</a>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
