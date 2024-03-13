@extends('agent.layouts.app')

@section('content')
    @include('user.common.alert')
    <div class="dash-left-profile">
        <div class="dash-left-profile gap-14">
            <div class="qr-icon d-flex justify-content-between">
                <div>
                    <p class="mb-0 f-16 gilroy-Semibold text-dark">{{ __('Hello, Welcome back') }}</p>
                    <p class="mb-0 f-32 gilroy-Semibold text-dark"><span> {{ getColumnValue(auth()->user()) }}</span>
                    </p>
                </div>
                <p class="mb-0 f-16 leading-18 gilroy-medium text-gray-100 mt-1 dash-w-262">
                    {{ \Carbon\Carbon::now()->format('jS F Y') }}</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="dash-profile-qr-div bg-white profile-mt-24 shadow"
                style="background:url({{ asset('user/customs/images/dash-gb.jpeg') }});background-repeat: repeat;
            background-position: right;">
                <div class="d-flex justify-content-between qr-icon">
                    <div>
                        <p class="mb-4 f-18">{{ __('Total Passengers') }}</p>
                        <p class="mb-5 f-32 fw-bolder leading-22 text-dark">{{ $total_passengers }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-profile-qr-div bg-white profile-mt-24 shadow"
                style="background:url({{ asset('user/customs/images/dash-gb.jpeg') }});background-repeat: repeat;
            background-position: right;">
                <div class="d-flex justify-content-between qr-icon">
                    <div>
                        <p class="mb-4 f-18">{{ __('Total Drivers') }}</p>
                        <p class="mb-5 f-32 fw-bolder leading-22 text-dark">{{ $total_drivers }}</p>
                    </div>
                    <div>
                        <p class="mb-0 f-16 leading-22 text-dark gilroy-Semibold">{{ __('Agent ID') }}</p>
                        <p class="mb-0 f-16">12345</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-40 p-2 bg-white d-flex gap-14 align-items-center cursor-pointer border-0"
        style="width:100% !important;background-color: #9B9B9C !important;border-radius:14px">
        <div class="check-all w-100">
            <div class="d-flex justify-content-between">
                <p class="mb-4 f-14 leading-17 gilroy-medium text-dark">{{ __('Bonus') }}</p>
                <select class="form-control visible"
                    style="height: 20px;width:50px;font-size:10px; padding: 0 5px !important;">
                    <option>1 month</option>
                    <option>1 week</option>
                    <option>Today</option>
                </select>
            </div>
            <p class="mb-2 f-18 leading-22 text-dark gilroy-Semibold">₦{{ __('0.00') }}</p>
            <p class="mb-0 f-12 leading-22 text-dark gilroy-Semibold d-flex justify-content-between">
                <span>{{ __('last bonus') }}</span><span>N/A</span>
            </p>
        </div>
    </div>
    <div class="mt-30">
        @if ($registerations->count() > 0)
            <div>
                <div class="mt-22 mt-sm-4">
                    <div class="d-flex justify-content-between align-items-center r-pb-8 pb-10">
                        <p class="mb-0 text-gray-100 f-23 r-f-12 gilroy-medium dark-CDO">{{ __('Recent Registerations') }}
                        </p>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-gray-100 f-16 r-f-12 gilroy-medium dark-CDO">
                                {{ __('See All Transactions') }}
                            </p>
                            <a href="{{ route('user.transactions.index') }}"
                                class="fil-btn-arow ml-12 d-flex align-items-center justify-content-center">
                                <svg class="nscaleX-1" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.96967 3.96967C9.67678 4.26256 9.67678 4.73744 9.96967 5.03033L13.1893 8.25H3C2.58579 8.25 2.25 8.58579 2.25 9C2.25 9.41421 2.58579 9.75 3 9.75H13.1893L9.96967 12.9697C9.67678 13.2626 9.67678 13.7374 9.96967 14.0303C10.2626 14.3232 10.7374 14.3232 11.0303 14.0303L15.5303 9.53033C15.8232 9.23744 15.8232 8.76256 15.5303 8.46967L11.0303 3.96967C10.7374 3.67678 10.2626 3.67678 9.96967 3.96967Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <div class="transac-parent">
                @include('agent.registerations.info')
            </div>
        @else
            <div class="notfound mt-16 bg-white p-4 shadow">
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-26">
                    <div class="image-notfound">
                        <img src="{{ asset('/dist/images/not-found.png') }}" class="img-fluid">
                    </div>
                    <div class="text-notfound">
                        <p class="mb-0 f-20 leading-25 gilroy-medium text-dark">{{ __('Sorry!') }}
                            {{ __('No data found.') }}</p>
                        <p class="mb-0 f-16 leading-24 gilroy-regular text-gray-100 mt-12">
                            {{ __('The requested data does not exist for this feature overview.') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script>
        'use strict';
        var cancellingText = "{{ __('Cancelling...') }}";
        var cancelledText = "{{ __('Cancelled') }}";
        var requestPaymentCancelUrl = "{{ route('user.request_money.cancel') }}";
        var printQrCodeUrl = "{{ route('user.profile.qrcode.print', [auth()->id(), 'user']) }}";
        var requestPaymentCreatorStatusCheckUrl = "{{ route('user.request_money.creator_status_check') }}";
        var requestPaymentCreatorSuspendUrl = "{{ route('user.request_money.creator_suspend') }}";
        var requestPaymentCreatorInactiveUrl = "{{ route('user.request_money.creator_inactive') }}";
        var userStatus = "{{ auth()->user()->status }}";
        var userStatusCheckUrl = "{{ url('check-user-status') }}";
        var walletRoute = "{{ route('user.wallets.index') }}";
    </script>
    <script src="{{ asset('/user/customs/js/user-status.min.js') }}"></script>
    <script src="{{ asset('/user/customs/js/user-transaction.min.js') }}"></script>
    <script src="{{ asset('/user/customs/js/dashboard.min.js') }}" type="text/javascript"></script>
@endpush
