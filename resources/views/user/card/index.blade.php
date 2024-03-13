@extends('user.layouts.app')

@section('content')
    @include('user.common.alert')
    <div class="text-center">
        <p class="mb-0 gilroy-Semibold f-26 text-dark theme-tran r-f-20 text-uppercase">Transport Cards</p>
    </div>
    <div>
        <div class="mt-16 bg-white p-4 shadow">
            <div class="row">
                <div class="col-md-6 col-12">
                    <img class="ondigo-card" src="{{ asset('user/customs/images/card.jpg') }}" alt="card" />
                </div>
            </div>
        </div>

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
