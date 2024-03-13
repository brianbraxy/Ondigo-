@extends('user.layouts.app')

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
    <div class="alert alert-danger "><strong class="f-12"><i class="fa-solid fa-bell"></i>Complete your registeration by
            visiting our agent and linking your account to
            your ondigo card. <a href="#" data-bs-toggle="modal" data-bs-target="#agentLocation">Click here</a> for
            nearest agent location</strong></div>
    <div class="modal fade" id="agentLocation" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <h5>AGENT INFORMATION</h5>
                    <p>Location: University of nigeria, enugu campus</p>
                    <p>phone number: 080666*****</p>

                </div>
            </div>
        </div>
    </div>
    <div class="dash-profile-qr-div bg-white profile-mt-24 shadow"
        style="background:url('user/customs/images/dash-gb.jpeg');background-repeat: repeat;
        background-position: right;">
        <div class="d-flex justify-content-between qr-icon">
            <div>
                <p class="mb-4 f-18">{{ __('Total Balance') }}</p>
                <p class="mb-5 f-32 fw-bolder leading-22 text-dark">₦ {{ number_format(auth()->user()->balance, 2) }}</p>
            </div>
            <div>
                <p class="mb-0 f-16 leading-22 text-dark gilroy-Semibold">{{ __('Account number') }}</p>
                <div class="d-flex position-relative copy-div">
                    {{-- <p class="mb-0 gilroy-medium text-gray-100 mb-2 mt-12 copy-parent-div top-0" id="copy-parent-div">Copied
                    </p> --}}
                    <p class="mb-0 f-16">{{ auth()->user()->bank()->first()->account_number }}</p>
                    <span id="copyButton" class="flex-shrink-1 b-none copy-btn"><svg width="36" height="36"
                            viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect class="rect-F30" width="36" height="36" rx="4"></rect>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M22.2855 11.3759C21.7715 11.3339 21.1112 11.3333 20.1641 11.3333H14.2474C13.7872 11.3333 13.4141 10.9602 13.4141 10.5C13.4141 10.0397 13.7872 9.66663 14.2474 9.66663L20.1997 9.66663C21.1029 9.66662 21.8314 9.66661 22.4213 9.71481C23.0286 9.76443 23.5621 9.86928 24.0557 10.1208C24.8397 10.5202 25.4771 11.1577 25.8766 11.9417C26.1281 12.4352 26.2329 12.9687 26.2825 13.5761C26.3307 14.166 26.3307 14.8945 26.3307 15.7976V21.75C26.3307 22.2102 25.9576 22.5833 25.4974 22.5833C25.0372 22.5833 24.6641 22.2102 24.6641 21.75V15.8333C24.6641 14.8861 24.6634 14.2259 24.6214 13.7118C24.5802 13.2075 24.5034 12.9178 24.3916 12.6983C24.1519 12.2279 23.7694 11.8455 23.299 11.6058C23.0796 11.494 22.7898 11.4171 22.2855 11.3759ZM13.1319 12.5833H19.9462C20.3855 12.5833 20.7644 12.5833 21.0766 12.6088C21.406 12.6357 21.7337 12.6951 22.049 12.8558C22.5194 13.0955 22.9019 13.4779 23.1416 13.9483C23.3022 14.2636 23.3617 14.5913 23.3886 14.9208C23.4141 15.2329 23.4141 15.6119 23.4141 16.0512V22.8654C23.4141 23.3047 23.4141 23.6837 23.3886 23.9958C23.3617 24.3253 23.3022 24.653 23.1416 24.9683C22.9019 25.4387 22.5194 25.8211 22.049 26.0608C21.7337 26.2215 21.406 26.2809 21.0766 26.3078C20.7644 26.3333 20.3855 26.3333 19.9462 26.3333H13.1319C12.6926 26.3333 12.3137 26.3333 12.0015 26.3078C11.6721 26.2809 11.3444 26.2215 11.0291 26.0608C10.5587 25.8211 10.1762 25.4387 9.93655 24.9683C9.77589 24.653 9.71646 24.3253 9.68954 23.9958C9.66404 23.6837 9.66405 23.3047 9.66406 22.8654V16.0512C9.66405 15.6119 9.66404 15.2329 9.68954 14.9208C9.71646 14.5913 9.77589 14.2636 9.93655 13.9483C10.1762 13.4779 10.5587 13.0955 11.0291 12.8558C11.3444 12.6951 11.6721 12.6357 12.0015 12.6088C12.3137 12.5833 12.6927 12.5833 13.1319 12.5833ZM12.1373 14.2699C11.9109 14.2884 11.8269 14.3198 11.7857 14.3408C11.6289 14.4207 11.5015 14.5482 11.4216 14.705C11.4006 14.7462 11.3692 14.8301 11.3507 15.0565C11.3314 15.2926 11.3307 15.6028 11.3307 16.0833V22.8333C11.3307 23.3138 11.3314 23.624 11.3507 23.8601C11.3692 24.0865 11.4006 24.1704 11.4216 24.2116C11.5015 24.3684 11.6289 24.4959 11.7857 24.5758C11.8269 24.5968 11.9109 24.6282 12.1373 24.6467C12.3734 24.666 12.6836 24.6666 13.1641 24.6666H19.9141C20.3945 24.6666 20.7048 24.666 20.9409 24.6467C21.1673 24.6282 21.2512 24.5968 21.2924 24.5758C21.4492 24.4959 21.5767 24.3684 21.6566 24.2116C21.6776 24.1704 21.709 24.0865 21.7275 23.8601C21.7467 23.624 21.7474 23.3138 21.7474 22.8333V16.0833C21.7474 15.6028 21.7467 15.2926 21.7275 15.0565C21.709 14.8301 21.6776 14.7462 21.6566 14.705C21.5767 14.5482 21.4492 14.4207 21.2924 14.3408C21.2512 14.3198 21.1673 14.2884 20.9409 14.2699C20.7048 14.2506 20.3945 14.25 19.9141 14.25H13.1641C12.6836 14.25 12.3734 14.2506 12.1373 14.2699Z"
                                fill="currentColor"></path>
                        </svg></span>
                </div>
                <p class="mb-0 f-16">{{ __('SafeHaven MFB') }}</p>
            </div>

        </div>
    </div>
    <div class="owl-carousel owl-theme dasboard-wallet-card gap-20 mt-40 overflow-hidden">
        <div class="card p-2 bg-white d-flex gap-14 align-items-center cursor-pointer border-0"
            style="width:100% !important;background-color: #A3ABEE !important;border-radius:14px">
            <div class="check-all w-100">
                <div class="d-flex justify-content-between">
                    <p class="mb-4 f-14 leading-17 gilroy-medium text-dark">{{ __('Total Inflow') }}</p>
                    <select class="form-control visible"
                        style="height: 20px;width:50px;font-size:10px; padding: 0 5px !important;">
                        <option>1 month</option>
                        <option>1 week</option>
                        <option>Today</option>
                    </select>
                </div>
                <p class="mb-2 f-18 leading-22 text-dark gilroy-Semibold">₦{{ __('0.00') }}</p>
                <p class="mb-0 f-12 leading-22 text-dark gilroy-Semibold d-flex justify-content-between">
                    <span>{{ __('last inflow') }}</span><span>N/A</span>
                </p>
            </div>
        </div>
        <div class="card p-2 bg-white d-flex gap-14 align-items-center cursor-pointer border-0"
            style="width:100% !important;background-color: #F1EEB2 !important;border-radius:14px">
            <div class="check-all w-100">
                <div class="d-flex justify-content-between">
                    <p class="mb-4 f-14 leading-17 gilroy-medium text-dark">{{ __('Spending') }}</p>
                    <select class="form-control visible"
                        style="height: 20px;width:50px;font-size:10px; padding: 0 5px !important;">
                        <option>1 month</option>
                        <option>1 week</option>
                        <option>Today</option>
                    </select>
                </div>
                <p class="mb-2 f-18 leading-22 text-dark gilroy-Semibold">₦{{ __('0.00') }}</p>
                <p class="mb-0 f-12 leading-22 text-dark gilroy-Semibold d-flex justify-content-between">
                    <span>{{ __('last payment') }}</span><span>N/A</span>
                </p>
            </div>
        </div>

        <div class="card p-2 bg-white d-flex gap-14 align-items-center cursor-pointer border-0"
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
    </div>
    <div class="mt-30">
        <p class="mb-0 f-24 gilroy-Semibold text-dark"><span> {{ __('Recent Transactions') }}</span>
            @if ($transactions->count() > 0)
                <div>
                    <div class="mt-22 mt-sm-4">
                        <div class="d-flex justify-content-between align-items-center r-pb-8 pb-10">
                            <p class="mb-0 text-gray-100 f-16 r-f-12 gilroy-medium dark-CDO">{{ __('Recent Activities') }}
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
                    @include('user.transaction.info')
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
