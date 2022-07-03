@extends('layouts.master')

@section('page_title', 'Edit password')

@section('content')

<div class="container-fluid mt-3">
    <x-alert></x-alert>
    <x-validation-errors></x-validation-errors>
    <div class="card">
        <div class="card-header">Change password</div>
        <div class="card-body ">
            <form method="post" action="{{route('update.password')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="old_password" value="" placeholder="Enter Old Password">
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_password" value="" placeholder="Enter New Password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="" placeholder="Enter Password Again">
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection