@extends('agent.layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/libraries/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    @push('meta-tags')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush

    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/plugins/intl-tel-input-17.0.19/css/intlTelInput.min.css') }}">

    <div class="bg-white shadow p-5">
        <p class="mb-0 f-26 gilroy-Semibold text-uppercase text-center text-dark">{{ __('Register New user') }}</p>

        @include('user.common.alert')

        <form method="post" action="{{ route('agent.new.user') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="defaultCountry" id="defaultCountry" class="form-control">
            <input type="hidden" name="carrierCode" id="carrierCode" class="form-control">
            <input type="hidden" name="formattedPhone" id="formattedPhone" class="form-control">
            <input type="hidden" name="type" value="user" />
            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <label class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('First name') }}</label>
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
                            id="subject" value="{{ old('middle_name') }}" placeholder="{{ __('Enter Middle name') }}"
                            required data-value-missing="{{ __('This field is required.') }}">
                        @error('subject')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <label class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Surname') }}</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control input-form-control apply-bg" name="last_name"
                            id="subject" value="{{ old('last_name') }}" placeholder="{{ __('Enter Surname') }}" required
                            data-value-missing="{{ __('This field is required.') }}">
                        @error('last_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <label class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Phone') }}</label>
                    </div>
                    <div class="col-7">
                        <input type="tel" class="form-control" id="phone" name="phone"
                            data-value-missing="{{ __('This field is required.') }}">
                        <span id="duplicate-phone-error"></span>
                        <span id="tel-error"></span>
                        @error('phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-2 d-flex align-items-center pl-0" style="padding-left: 0">
                        <a href="#" class="btn btn-success btn-sm disabled" id="otp_btn"
                            style="margin-top: 0 !important;
                        padding: 0.25rem 0.5rem !important;
                        font-size: 12px !important;">Send
                            OTP</a>
                    </div>
                </div>
            </div>
            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <label class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('OTP') }}</label>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="otp-container">
                                <!-- Six input fields for OTP digits -->
                                <input type="text" class="otp-input" pattern="\d" maxlength="1">
                                <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled>
                                <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled>
                                <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled>
                                <input type="hidden" id="otp" class="form-control input-form-control apply-bg"
                                    name="otp" required>
                            </div>

                            <div class="col-3" id="otp_status">
                                <small class="f-12">
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <label
                            class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Card UID number') }}</label>
                    </div>
                    <div class="col-9">
                        <div class="otp-container">
                            <!-- Six input fields for OTP digits -->
                            <input type="text" class="card-input" pattern="\d{4}" maxlength="4">
                            <input type="text" class="card-input" pattern="\d{4}" maxlength="4" disabled>
                            <input type="text" class="card-input" pattern="\d{4}" maxlength="4" disabled>
                            <input type="text" class="card-input" pattern="\d{4}" maxlength="4" disabled>
                            <input type="hidden" id="card_uuid" class="form-control input-form-control apply-bg"
                                name="card_uuid" required>
                        </div>
                        @error('otp')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="label-top">
                <div class="row">
                    <div class="col-3">
                        <p class="gilroy-medium text-gray-100 mb-2 f-15 mt-4 r-mt-amount">{{ __('Notify by') }}</p>
                    </div>
                    <div class="col-9">
                        <div>
                            <label>
                                <span>
                                    SMS
                                </span>
                                <input name="sms" type="checkbox">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>Email</span>
                                <input name="email" type="checkbox">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>In App</span>
                                <input name="inApp" type="checkbox">
                            </label>
                        </div>
                        @error('subject')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary mt-4" id="ticketCreateSubmitBtn">
                    <div class="spinner spinner-border text-white spinner-border-sm mx-2 d-none" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                    <span id="ticketCreateSubmitBtnText">{{ __('Register User') }}</span>
                </button>
            </div>

        </form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/dist/plugins/html5-validation-1.0.0/validation.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/dist/plugins/intl-tel-input-17.0.19/js/intlTelInput-jquery.min.js') }}" type="text/javascript">
    </script>
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
        document.addEventListener("DOMContentLoaded", function() {
            var otpInputs = document.querySelectorAll(".otp-input");
            var cardInputs = document.querySelectorAll(".card-input");

            function setupOtpInputListeners(inputs) {
                inputs.forEach(function(input, index) {
                    input.addEventListener("paste", function(ev) {
                        var clip = ev.clipboardData.getData('text').trim();
                        if (!/^\d{4}$/.test(clip)) {
                            ev.preventDefault();
                            return;
                        }

                        var characters = clip.split("");
                        inputs.forEach(function(otpInput, i) {
                            otpInput.value = characters[i] || "";
                        });

                        enableNextBox(inputs[0], 0);
                        inputs[5].removeAttribute("disabled");
                        inputs[5].focus();
                        updateOTPValue(inputs);
                    });

                    input.addEventListener("input", function() {
                        var currentIndex = Array.from(inputs).indexOf(this);
                        var inputValue = this.value.trim();

                        if (!/^\d$/.test(inputValue)) {
                            this.value = "";
                            return;
                        }

                        if (inputValue && currentIndex < 3) {
                            inputs[currentIndex + 1].removeAttribute("disabled");
                            inputs[currentIndex + 1].focus();
                        }

                        if (currentIndex === 4 && inputValue) {
                            inputs[5].removeAttribute("disabled");
                            inputs[5].focus();
                        }

                        updateOTPValue(inputs);
                        console.log(document.getElementById("otp").value.length)
                        if (document.getElementById("otp").value.length === 4) {
                            verifyOtp()
                        }
                    });

                    input.addEventListener("keydown", function(ev) {
                        var currentIndex = Array.from(inputs).indexOf(this);

                        if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
                            inputs[currentIndex - 1].focus();
                        }
                    });
                });
            }

            function setupCardInputListeners(inputs) {
                inputs.forEach(function(input, index) {
                    input.addEventListener("paste", function(ev) {
                        var clip = ev.clipboardData.getData('text').trim();
                        console.log(/^\d{4}$/.test(clip))
                        if (!/^\d{4}$/.test(clip)) {
                            ev.preventDefault();
                            return;
                        }

                        var characters = clip.split("");
                        inputs.forEach(function(otpInput, i) {
                            otpInput.value = characters[i] || "";
                        });

                        enableNextBox(inputs[0], 0);
                        inputs[5].removeAttribute("disabled");
                        inputs[5].focus();
                        updateCardUUIDValue(inputs);
                    });

                    input.addEventListener("input", function() {
                        var currentIndex = Array.from(inputs).indexOf(this);
                        var inputValue = this.value.trim();

                        if (inputValue.length === 4 && currentIndex < 4) {
                            if (!(currentIndex + 1 > 3)) {
                                inputs[currentIndex + 1].removeAttribute("disabled");
                                inputs[currentIndex + 1].focus();
                            }
                        }

                        // if (currentIndex === 4 && inputValue) {
                        //     inputs[5].removeAttribute("disabled");
                        //     inputs[5].focus();
                        // }
                        console.log(currentIndex)
                        updateCardUUIDValue(inputs);
                    });

                    input.addEventListener("keydown", function(ev) {
                        var currentIndex = Array.from(inputs).indexOf(this);

                        if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
                            inputs[currentIndex - 1].focus();
                        }
                    });
                });
            }

            function enableNextBox(input, currentIndex) {
                var inputValue = input.value;

                if (inputValue === "") {
                    return;
                }

                var nextIndex = currentIndex + 1;
                var nextBox = otpInputs[nextIndex];

                if (nextBox) {
                    nextBox.removeAttribute("disabled");
                }
            }

            function updateOTPValue(inputs) {
                var otpValue = "";

                inputs.forEach(function(input) {
                    otpValue += input.value;
                });

                if (inputs === otpInputs) {
                    document.getElementById("otp").value = otpValue;
                }
            }

            function updateCardUUIDValue(inputs) {
                var otpValue = "";

                inputs.forEach(function(input) {
                    otpValue += input.value;
                });

                if (inputs === otpInputs) {
                    document.getElementById("card_uuid").value = otpValue;
                }
            }

            function verifyOtp() {
                $("#otp_status").addClass("d-flex").children().first().html("<i></i> verifying").children().first()
                    .addClass("fa").addClass("fa-spinner").addClass("fa-spin")
                let number = $('input[name="formattedPhone"]').val()
                let otp = $('input[name="otp"]').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/agent/new/user/otp/verify",
                    type: 'POST',
                    data: {
                        number,
                        otp
                    },
                    success: function(response) {
                        $("#otp_status").children().first().removeClass("text-danger").addClass(
                                "text-success").html(
                                "<i></i> verified")
                            .children().first().addClass("fa").addClass("fa-times-circle")
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        $("#otp_status").children().first().removeClass('text-success').addClass(
                                "text-danger").html(
                                "<i></i> failed")
                            .children().first().addClass("fa").addClass("fa-times-circle")
                        console.error('Error:', error);
                    }
                })
            }

            setupOtpInputListeners(otpInputs);
            setupCardInputListeners(cardInputs);

            otpInputs[0].focus(); // Set focus on the first OTP input field
            cardInputs[0].focus(); // Set focus on the first email OTP input field

            // otpInputs[5].addEventListener("input", function() {
            //     updateOTPValue(otpInputs);
            // });

            // emailOtpInputs[5].addEventListener("input", function() {
            //     updateOTPValue(emailOtpInputs);
            // });


            function OTPRetryTimer(retryTimer) {
                if (!retryTimer) {
                    $("#otp_btn").removeClass("disabled")
                    return
                }
                var retryTime = new Date(retryTimer)
                retryTime.setMinutes(retryTime.getMinutes() + 10)
                var targetTime = new Date(retryTime).getTime()
                var min = 0

                var timer = setInterval(() => {
                    var now = new Date().getTime()
                    var distance = targetTime - now
                    var min = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
                    var sec = Math.floor((distance % (1000 * 60)) / 1000)
                    if (min <= 0) {
                        $("#otp_btn").removeClass("disabled")
                        $("#otp_btn").html("send OTP")
                        clearInterval(timer)
                    } else {
                        $("#otp_btn").html(`retry in ${min}:${sec}`)
                    }
                }, 1000);
            }
            OTPRetryTimer("{!! $isoDate !!}")

            $("#otp_btn").on("click", function(e) {
                var input = $("#phone")
                if (!input.intlTelInput("isValidNumber")) {
                    var p = input[0].parentNode
                    var err = document.createElement('label');
                    if (p.getElementsByClassName('error').length) {
                        p.getElementsByClassName('error')[0].remove()
                    }
                    err.classList.add("error")
                    input[0].setCustomValidity('This field is required.')
                    err.innerHTML = input[0].getAttribute('data-value-missing');
                    p.append(err);
                    return
                }
                $(this).html("sending...")
                e.preventDefault()
                let inputValue = $('input[name="formattedPhone"]').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/agent/new/user/otp",
                    type: 'POST',
                    data: {
                        number: inputValue
                    },
                    success: function(response) {
                        OTPRetryTimer(response.isoDate)
                        $("#otp_btn").removeClass("disabled")
                    },
                    error: function(xhr, status, error) {
                        $("#otp_btn").html("send OTP")
                    }
                })
            })

        });
    </script>
@endpush
