@extends('admin.layouts.master')

@section('title', __('Add User'))

@section('head_style')
  <link rel="stylesheet" type="text/css" href="{{ asset('/dist/plugins/intl-tel-input-17.0.19/css/intlTelInput.min.css') }}">
@endsection

@section('page_content')

    <div class="box box-info" id="card-create">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Add Card') }}</h3>
        </div>
        <form action="{{ url(config('adminPrefix').'/cards/store') }}" class="form-horizontal" id="card_form" method="POST">
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
            <div class="box-body">

                <!-- FirstName -->
                <div class="form-group row">
                    <label class="col-sm-3 mt-11 control-label text-sm-end f-14 fw-bold" for="first_name">{{ __('UID') }}</label>
                    <div class="col-sm-6">
                        <input class="form-control f-14" placeholder="{{ __('Enter :x', ['x' => __('UID')]) }}" name="UID" type="text" id="UID" value="{{ old('UID') }}" required data-value-missing="{{ __('This field is required.') }}" maxlength="30" data-max-length="{{ __(':x length should be maximum :y charcters.', ['x' => __('First name'), 'y' => __('30')]) }}">
                        @if($errors->has('UID'))
                            <span class="error">
                                {{ $errors->first('UID') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group row">
                    <label class="col-sm-3 mt-11 control-label require text-sm-end f-14 fw-bold" for="status">{{ __('Status') }}</label>
                    <div class="col-sm-6">
                        <select class="select2 f-14" name="status" id="status" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                            <option value='0'>{{ __('Unlinked') }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 offset-md-3">
                        <button type="submit" class="btn btn-theme f-14" id="users_create"><i class="fa fa-spinner fa-spin d-none"></i> <span id="users_create_text">{{ __('Create') }}</span></button>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
@push('extra_body_scripts')
@endpush


