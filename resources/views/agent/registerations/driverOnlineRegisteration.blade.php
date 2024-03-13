@extends('agent.layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/dist/plugins/intl-tel-input-17.0.19/css/intlTelInput.min.css') }}">

    <div class="bg-white shadow p-5">
        <p class="mb-0 f-26 gilroy-Semibold text-uppercase text-center text-dark">{{ __('Register New user') }}</p>

        @include('user.common.alert')

        <form method="post" action="{{ route('agent.new.driver.online') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="defaultCountry" id="defaultCountry" class="form-control">
            <input type="hidden" name="carrierCode" id="carrierCode" class="form-control">
            <input type="hidden" name="formattedPhone" id="formattedPhone" class="form-control">
            <input type="hidden" name="type" value="user" />

            <div class="form-section">
                <h5 class="mt-3">Personal Details</h5>
                <div>
                    <div class="right-avatar-img">
                        <img src="http://ondigo-dash.test/dist/images/default-avatar.png" alt="Profile" id="profileImage">
                    </div>
                    <div>
                        <a class="btn bg-primary green-btn" href="javascript:changeProfile()" id="changeProfile">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.1683 0.750003C7.1741 0.750004 7.17995 0.750006 7.18586 0.750006L10.8317 0.750003C10.9144 0.749983 10.9863 0.749965 11.0549 0.754121C11.9225 0.806667 12.6823 1.35427 13.0065 2.16076C13.0321 2.22455 13.0549 2.29277 13.081 2.3712L13.0865 2.38783C13.1213 2.49221 13.1289 2.5138 13.1353 2.52975C13.2433 2.79858 13.4966 2.98112 13.7858 2.99863C13.8028 2.99966 13.8282 3.00001 13.9458 3.00001C13.96 3.00001 13.974 3 13.9877 3C14.2239 2.99995 14.3974 2.99992 14.5458 3.01462C15.9687 3.15561 17.0944 4.28127 17.2354 5.70422C17.2501 5.85261 17.2501 6.01915 17.25 6.24402C17.25 6.25679 17.25 6.26976 17.25 6.28292V12.181C17.25 12.7847 17.25 13.283 17.2169 13.6889C17.1824 14.1104 17.1085 14.498 16.923 14.862C16.6354 15.4265 16.1765 15.8854 15.612 16.173C15.248 16.3585 14.8605 16.4324 14.4389 16.4669C14.033 16.5 13.5347 16.5 12.931 16.5H5.06902C4.4653 16.5 3.96703 16.5 3.56114 16.4669C3.13957 16.4324 2.75204 16.3585 2.38804 16.173C1.82355 15.8854 1.36461 15.4265 1.07699 14.862C0.891523 14.498 0.817599 14.1104 0.783156 13.6889C0.749993 13.283 0.75 12.7847 0.75001 12.181L0.75001 6.28292C0.75001 6.26976 0.750008 6.25679 0.750005 6.24402C0.749959 6.01915 0.749925 5.85261 0.764628 5.70422C0.905612 4.28127 2.03128 3.15561 3.45422 3.01462C3.60266 2.99992 3.77616 2.99995 4.01231 3C4.02606 3 4.04002 3.00001 4.0542 3.00001C4.1718 3.00001 4.19725 2.99966 4.21421 2.99863C4.50342 2.98112 4.75667 2.79858 4.86475 2.52975C4.87116 2.5138 4.8787 2.49222 4.9135 2.38783C4.91537 2.38222 4.91722 2.37666 4.91906 2.37115C4.94517 2.29275 4.96789 2.22453 4.99353 2.16076C5.31775 1.35427 6.0775 0.806667 6.94513 0.754121C7.01375 0.749965 7.08565 0.749983 7.1683 0.750003ZM7.18586 2.25001C7.07584 2.25001 7.05297 2.25034 7.03581 2.25138C6.7466 2.26889 6.49335 2.45143 6.38528 2.72026C6.37886 2.73621 6.37132 2.75779 6.33652 2.86218C6.33465 2.86779 6.3328 2.87335 6.33097 2.87886C6.30485 2.95726 6.28213 3.02548 6.25649 3.08925C5.93227 3.89574 5.17252 4.44334 4.30489 4.49589C4.23623 4.50005 4.16095 4.50003 4.07344 4.50001C4.06709 4.50001 4.06068 4.50001 4.0542 4.50001C3.75811 4.50001 3.66633 4.50095 3.60212 4.50731C2.89064 4.57781 2.32781 5.14064 2.25732 5.85211C2.25093 5.91658 2.25001 6.00223 2.25001 6.28292V12.15C2.25001 12.7924 2.25059 13.2292 2.27817 13.5667C2.30504 13.8955 2.35373 14.0637 2.4135 14.181C2.55731 14.4632 2.78678 14.6927 3.06902 14.8365C3.18632 14.8963 3.35448 14.945 3.68329 14.9718C4.02086 14.9994 4.45758 15 5.10001 15H12.9C13.5424 15 13.9792 14.9994 14.3167 14.9718C14.6455 14.945 14.8137 14.8963 14.931 14.8365C15.2132 14.6927 15.4427 14.4632 15.5865 14.181C15.6463 14.0637 15.695 13.8955 15.7218 13.5667C15.7494 13.2292 15.75 12.7924 15.75 12.15V6.28292C15.75 6.00223 15.7491 5.91658 15.7427 5.85211C15.6722 5.14064 15.1094 4.57781 14.3979 4.50731C14.3337 4.50095 14.2419 4.50001 13.9458 4.50001L13.9266 4.50001C13.8391 4.50003 13.7638 4.50005 13.6951 4.49589C12.8275 4.44334 12.0677 3.89574 11.7435 3.08925C11.7179 3.02547 11.6952 2.95724 11.669 2.87881L11.6635 2.86218C11.6287 2.7578 11.6212 2.73621 11.6147 2.72026C11.5067 2.45143 11.2534 2.26889 10.9642 2.25138C10.947 2.25034 10.9242 2.25001 10.8142 2.25001H7.18586ZM9.00001 7.12501C7.75737 7.12501 6.75001 8.13236 6.75001 9.37501C6.75001 10.6176 7.75737 11.625 9.00001 11.625C10.2427 11.625 11.25 10.6176 11.25 9.37501C11.25 8.13236 10.2427 7.12501 9.00001 7.12501ZM5.25001 9.37501C5.25001 7.30394 6.92894 5.62501 9.00001 5.62501C11.0711 5.62501 12.75 7.30394 12.75 9.37501C12.75 11.4461 11.0711 13.125 9.00001 13.125C6.92894 13.125 5.25001 11.4461 5.25001 9.37501Z"
                                    fill="currentColor"></path>
                            </svg>
                            <span class="leading-20 text-white mx-2 gilroy-medium">Change Photo</span>
                        </a>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('First name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="first_name"
                                id="first_name" value="{{ old('first_name') }}" placeholder="{{ __('Enter First name') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Middle name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="middle_name"
                                id="middle_name" value="{{ old('middle_name') }}"
                                placeholder="{{ __('Enter Middle name') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('middle_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Surname') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="last_name"
                                id="last_name" value="{{ old('surname') }}" placeholder="{{ __('Enter Surname') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('last_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Mothers maiden name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="mother_maiden_name"
                                id="mother_maiden_name" value="{{ old('mother_maiden_name') }}"
                                placeholder="{{ __('Enter Mothers maiden name') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('mother_maiden_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <p class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Gender') }}</p>
                        </div>
                        <div class="col-9 d-flex">
                            <div>
                                <label>
                                    <span>Male</span>
                                    <input class="d-inline-block me-2" name="gender" type="radio">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Female</span>
                                    <input class="d-inline-block" name="gender" type="radio">
                                </label>
                            </div>
                            @error('gender')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <p class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Marital status') }}
                            </p>
                        </div>
                        <div class="col-9 d-flex">
                            <div>
                                <label>
                                    <span>Married</span>
                                    <input class="d-inline-block me-2" name="marital_status" type="radio">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Single</span>
                                    <input class="d-inline-block" name="marital_status" type="radio">
                                </label>
                            </div>
                            @error('gender')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('State of origin') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="state_of_origin"
                                id="state_of_origin" value="{{ old('state_of_origin') }}"
                                placeholder="{{ __('Enter State of origin') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('state_of_origin')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Local government area') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="lga"
                                id="lga" value="{{ old('lga') }}"
                                placeholder="{{ __('Enter Local government area') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('lga')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Nationality') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nationality"
                                id="nationality" value="{{ old('nationality') }}"
                                placeholder="{{ __('Enter Nationality') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nationality')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">Contact Details</h5>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Residential Address') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="contact_address"
                                id="contact_address" value="{{ old('contact_address') }}"
                                placeholder="{{ __('Enter Residential Address') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('contact_address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Local Government Area') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="contact_lga"
                                id="contact_lga" value="{{ old('contact_lga') }}"
                                placeholder="{{ __('Enter Local Government Area') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('contact_lga')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('City/Town') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="contact_city"
                                id="contact_city" value="{{ old('contact_city') }}"
                                placeholder="{{ __('Enter City') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('contact_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('State') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="contact_state"
                                id="contact_state" value="{{ old('contact_state') }}"
                                placeholder="{{ __('Enter State') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('contact_state')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Email address') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="contact_email"
                                id="contact_email" value="{{ old('contact_email') }}"
                                placeholder="{{ __('Enter Email') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('contact_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Phone number 1') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone_1" name="phone_1">
                            <span id="duplicate-phone-error"></span>
                            <span id="tel-error"></span>
                            @error('phone_1')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Phone number 2') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone_2" name="phone_2">
                            <span id="duplicate-phone-error"></span>
                            <span id="tel-error"></span>
                            @error('phone_2')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">Valid Means of Identification</h5>
                <div class="label-top">
                    <div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('National ID') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block me-2" name="means_of_id" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('National Drivers License') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="means_of_id" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('International Passport') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="means_of_id" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">INEC Voters
                                    Card</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="means_of_id" type="radio">
                            </div>
                        </div>
                        @error('means_of_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('ID number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="id_number"
                                id="id_number" value="{{ old('id_number') }}" placeholder="{{ __('Enter ID number') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('id_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('NIN Number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nin_number"
                                id="nin_number" value="{{ old('nin_number') }}"
                                placeholder="{{ __('Enter NIN Number') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nin_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('BVN Number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="bvn_number"
                                id="bvn_number" value="{{ old('bvn_number') }}"
                                placeholder="{{ __('Enter BVN Number') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('bvn_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">Next of kin details</h5>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Surname') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_surname"
                                id="nok_surname" value="{{ old('nok_surname') }}"
                                placeholder="{{ __('Enter Surname') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_surname')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Middle name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_middle_name"
                                id="nok_middle_name" value="{{ old('nok_middle_name') }}"
                                placeholder="{{ __('Enter Middle name') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_middle_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('First name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_first_name"
                                id="nok_first_namet" value="{{ old('nok_first_name') }}"
                                placeholder="{{ __('Enter First name') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Relationship') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="nok_relationship" id="nok_relationship" value="{{ old('nok_relationship') }}"
                                placeholder="{{ __('Enter Relationship') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_relationship')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <p class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Gender') }}</p>
                        </div>
                        <div class="col-9 d-flex">
                            <div>
                                <label>
                                    <span>Male</span>
                                    <input class="d-inline-block me-2" name="nok_gender" type="radio">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Female</span>
                                    <input class="d-inline-block" name="nok_gender" type="radio">
                                </label>
                            </div>
                            @error('nok_gender')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Email adress') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_email"
                                id="nok_email" value="{{ old('nok_email') }}"
                                placeholder="{{ __('Enter Email adress') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Residential address') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_address"
                                id="nok_address" value="{{ old('nok_address') }}"
                                placeholder="{{ __('Enter Residential address') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Local government area') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_lga"
                                id="nok_lga" value="{{ old('nok_lga') }}"
                                placeholder="{{ __('Enter Local government area') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_lga')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('City/Town') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_city"
                                id="nok_city" value="{{ old('nok_city') }}" placeholder="{{ __('Enter City') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('State') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="nok_state"
                                id="nok_state" value="{{ old('nok_state') }}" placeholder="{{ __('Enter State') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('nok_state')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">Ownership details</h5>
                <div class="label-top">
                    <div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Vehicle owner') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block me-2" name="vehicle_owner" value="owner" checked
                                    type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Hire puchase') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_owner" value="hire" type="radio">
                            </div>
                        </div>
                        @error('gender')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-section" id="employer_details">
                <h5 class="mt-3">Employer details</h5>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Surname') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="employer_surname" id="employer_surname" value="{{ old('employer_surname') }}"
                                placeholder="{{ __('Enter Surname') }}">
                            @error('employer_surname')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Middle name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="employer_middle_name" id="employer_middle_name"
                                value="{{ old('employer_middle_name') }}" placeholder="{{ __('Enter Middle name') }}">
                            @error('employer_middle_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('First name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="employer_first_name" id="employer_first_namet"
                                value="{{ old('employer_first_name') }}" placeholder="{{ __('Enter First name') }}">
                            @error('employer_first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <p class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Gender') }}</p>
                        </div>
                        <div class="col-9 d-flex">
                            <div>
                                <label>
                                    <span>Male</span>
                                    <input class="d-inline-block me-2" name="employer_gender" type="radio">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Female</span>
                                    <input class="d-inline-block" name="employer_gender" type="radio">
                                </label>
                            </div>
                            @error('employer_gender')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Email adress') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="email" class="form-control input-form-control apply-bg" name="employer_email"
                                id="employer_email" value="{{ old('employer_email') }}"
                                placeholder="{{ __('Enter Email adress') }}">
                            @error('employer_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Residential address') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="employer_address" id="employer_address" value="{{ old('employer_address') }}"
                                placeholder="{{ __('Enter Residential address') }}">
                            @error('employer_address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Local government area') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="employer_lga"
                                id="employer_lga" value="{{ old('employer_lga') }}"
                                placeholder="{{ __('Enter Local government area') }}">
                            @error('employer_lga')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('City/Town') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="employer_city"
                                id="employer_city" value="{{ old('employer_city') }}"
                                placeholder="{{ __('Enter City') }}">
                            @error('employer_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('State') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="employer_state"
                                id="employer_state" value="{{ old('employer_state') }}"
                                placeholder="{{ __('Enter State') }}">
                            @error('employer_state')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">Ownership details</h5>
                <div class="label-top">
                    <div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Keke Napep') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block me-2" name="vehicle_type" value="keke napep"
                                    type="radio" checked>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Taxi/Car') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="taxi" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Bus (7 seater)') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="bus (7 seater)" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Bus (14 seater)') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="bus (14 seater)" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Bus (18 seater)') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="bus (18 seater)" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Big Bus (608)') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="big bus (608)" type="radio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label
                                    class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Big Bus (Coal city/BRT)') }}</label>
                            </div>
                            <div class="col-9">
                                <input class="d-inline-block" name="vehicle_type" value="big bus (Coal city/BRT)" type="radio">
                            </div>
                        </div>
                        @error('vehicle_type')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Other (please specify)') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg" name="other_vehicle_type"
                                id="other_vehicle_type" value="{{ old('other_vehicle_type') }}" placeholder="{{ __('(please specify)') }}">
                            @error('other_vehicle_type')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Vehicle Plate number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="vehicle_plate_number" id="vehicle_plate_number"
                                value="{{ old('vehicle_plate_number') }}"
                                placeholder="{{ __('Enter Vehicle Plate number') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('vehicle_plate_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Vehicle State Registration number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="vehicle_state_registration_number" id="vehicle_state_registration_number"
                                value="{{ old('vehicle_state_registration_number') }}"
                                placeholder="{{ __('Enter Vehicle State Registration number') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('vehicle_state_registration_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">{{ __('Pocket device details') }}</h5>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Pocket device serial number/IMEI') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="pocket_device_number" id="pocket_device_number"
                                value="{{ old('pocket_device_number') }}"
                                placeholder="{{ __('Enter Pocket device serial number/IMEI') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('pocket_device_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h5 class="mt-3">{{ __('Account details') }}</h5>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Bank name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="driver_bank_name" id="driver_bank_name" value="{{ old('driver_bank_name') }}"
                                placeholder="{{ __('Enter Bank name') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('driver_bank_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Account number') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="driver_account_number" id="driver_account_number"
                                value="{{ old('driver_account_number') }}"
                                placeholder="{{ __('Enter Account number') }}" required
                                data-value-missing="{{ __('This field is required.') }}">
                            @error('driver_account_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="label-top">
                    <div class="row">
                        <div class="col-3">
                            <label
                                class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Account name') }}</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control input-form-control apply-bg"
                                name="driver_account_name" id="driver_account_name"
                                value="{{ old('driver_account_name') }}" placeholder="{{ __('Enter Account name') }}"
                                required data-value-missing="{{ __('This field is required.') }}">
                            @error('driver_account_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary mt-4">
                    <div class="spinner spinner-border text-white spinner-border-sm mx-2 d-none" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                    <span id="ticketCreateSubmitBtnText">{{ __('Complete Registration and Generate driver ID') }}</span>
                </button>
            </div>

        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/dist/plugins/html5-validation-1.0.0/validation.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/dist/plugins/intl-tel-input-17.0.19/js/intlTelInput-jquery.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/dist/js/isValidPhoneNumber.min.js') }}" type="text/javascript"></script>
    <script>
        'use strict';
        let requiredText = '{{ __('This field is required.') }}';
        let countryShortCode = '{{ getDefaultCountry() }}';
        let validPhoneNumberText = '{{ __('Please enter a valid international phone number.') }}'
        let utilsJsScript = '{{ asset('/dist/plugins/intl-tel-input-17.0.19/js/utils.min.js') }}';
    </script>
    <script src="{{ asset('/frontend/customs/js/register/register.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#employer_details").css({
                display: "none"
            })
            $('input[name="vehicle_owner"]').on("change", function() {
                if ($(this).val() === "hire") {
                    $("#employer_details").css({
                        display: "block"
                    })
                } else {
                    $("#employer_details").css({
                        display: "none"
                    })
                }
            })
        });
    </script>
@endpush
