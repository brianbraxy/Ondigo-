@extends('admin.layouts.master')

@section('title', __('Edit Profile'))

@section('head_style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/dist/plugins/intl-tel-input-17.0.19/css/intlTelInput.min.css') }}">
@endsection

@section('page_content')
    <div id="card-edit">
        

       


        <div class="box mt-20">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <form action="{{ url(config('adminPrefix') . '/cards/update') }}" class="form-horizontal"
                            id="card_form" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" value="{{ $cards->id }}" name="id" id="id" />

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <!-- UID -->
                                        <div class="form-group row">
                                            <label class="col-sm-3 mt-11 control-label text-sm-end f-14 fw-bold"
                                                for="first_name">{{ __('UID') }}</label>
                                            <div class="col-sm-6">
                                                <input class="form-control f-14"
                                                    placeholder="{{ __('Enter :x', ['x' => __('UID')]) }}" name="UID"
                                                    type="text" id="UID" value="{{ $cards->UID }}" required 
                                                    data-value-missing="{{ __('This field is required.') }}" maxlength="30"
                                                    data-max-length="{{ __(':x length should be maximum :y charcters.', ['x' => __('First name'), 'y' => __('30')]) }}">
                                                @if ($errors->has('UID'))
                                                    <span class="error">
                                                        {{ $errors->first('UID') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group row">
                                            <label class="col-sm-3 mt-11 control-label require text-sm-end f-14 fw-bold"
                                                for="status">{{ __('Status') }}</label>
                                            <div class="col-sm-6">
                                                <select class="select2 f-14" name="status" id="status" required
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                    <option value='0' {{ $cards->status == '0' ? 'selected' : '' }}>{{ __('Unlinked') }}</option>
                                                    <option value='1' {{ $cards->status == '1' ? 'selected' : '' }}>{{ __('Linked') }}</option>
                                                    <option value='2' {{ $cards->status == '2' ? 'selected' : '' }}>{{ __('Blocked') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="row form-group align-items-center">
                                            <div class="col-sm-6 offset-md-3">
                                                <button type="submit" class="btn btn-theme f-14" id="cards_edit">
                                                    <i class="fa fa-spinner fa-spin f-14 d-none"></i> <span
                                                        id="cards_edit_text">{{ __('Update') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


