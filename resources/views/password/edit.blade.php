@extends('layout/mainUser')
@section('title', 'Form Ubah Password')
@section('container')
<link href="/css/password.css" rel="stylesheet">
<script src="/js/password.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  edit-pass reset">
                <h2 style="font-size: 20px;"> Update Password</h2>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <div class="input-group">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="toggleCurrentPassword"><i id="eye-icon-current" class="bi bi-eye-slash"></i></span>
                                </div>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password">{{ __('New Password') }}</label>
                            <div class="input-group">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="toggleNewPassword"><i id="eye-icon-new" class="bi bi-eye-slash"></i></span>
                                </div>
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">{{ __('Confirm New Password') }}</label>
                            <div class="input-group">
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="toggleNewPasswordConfirmation"><i id="eye-icon-confirm" class="bi bi-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
