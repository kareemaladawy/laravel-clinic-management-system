@extends('platform::auth')
@section('title', __('Sign up'))

@section('content')
    <h1 class="h4 text-black mb-4">{{ __('Sign up') }}</h1>

    <form class="m-t-md" role="form" method="POST" data-controller="form"
        data-form-need-prevents-form-abandonment-value="false" data-action="form#submit" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">

            <label class="form-label">
                {{ __('Full name') }}
            </label>

            {!! \Orchid\Screen\Fields\Input::make('name')->type('text')->required()->tabindex(1)->autofocus()->inputmode('text')->placeholder(__('Enter your full name')) !!}
        </div>

        <div class="mb-3">

            <label class="form-label">
                {{ __('Email address') }}
            </label>

            {!! \Orchid\Screen\Fields\Input::make('email')->type('email')->required()->tabindex(1)->autofocus()->autocomplete('email')->inputmode('email')->placeholder(__('Enter your email')) !!}
        </div>

        <div class="mb-3">
            <label class="form-label w-100">
                {{ __('Password') }}
            </label>

            {!! \Orchid\Screen\Fields\Password::make('password')->required()->autocomplete('current-password')->tabindex(2)->placeholder(__('Enter your password')) !!}
        </div>

        <div class="row align-items-center">
            <div class="col-md-6 col-xs-12">
                <label class="form-check">
                    <input type="hidden" name="remember">
                    <input type="checkbox" name="remember" value="true" class="form-check-input"
                        {{ !old('remember') || old('remember') === 'true' ? 'checked' : '' }}>
                    <span class="form-check-label"> {{ __('Remember Me') }}</span>
                </label>
            </div>
            <div class="col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
                    <x-orchid-icon path="bs.box-arrow-in-right" class="small me-2" />
                    {{ __('Sign up') }}
                </button>
            </div>
        </div>

    </form>
@endsection
