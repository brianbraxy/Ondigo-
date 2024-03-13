@foreach ($registerations as $key => $registeration)
    <div class="transac-parent cursor-pointer" data-bs-toggle="modal"
        data-bs-target="#registeration-Info-{{ $key }}">
        <div class="d-flex justify-content-between transac-child">
            <div class="d-flex w-50">

                <!-- Image -->
                <div class="deposit-circle d-flex justify-content-center align-items-center">
                    <img src="{{ asset('dist/images/default-avatar.png') }}" alt="avatar">
                </div>

                <div class="ml-20 r-ml-8">
                    <!-- Transaction Type -->
                    <p class="mb-0 text-dark f-16 gilroy-medium theme-tran">
                        {{ $registeration->user->last_name }} {{ $registeration->user->first_name }}</p>
                    <div class="d-flex flex-wrap">
                        <p
                            class="mb-0 text-gray-100 f-13 leading-17 gilroy-regular tran-title mt-2 d-flex justify-content-center align-items-center">
                            {{ dateFormat($registeration->created_at) }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div>
                    <p
                        class="{{ getColor($registeration->status) }} f-13 gilroy-regular text-end mt-6 mb-0 status-info rlt-txt">
                        {{ getStatus($registeration->status) }}</p>
                </div>
                <div class="cursor-pointer registeration-arrow ml-28 r-ml-12">
                    <a class="arrow-hovers" data-bs-toggle="modal"
                        data-bs-target="#registeration-Info-{{ $key }}">
                        <svg class="nscaleX-1" width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.5312 1.52861C3.27085 1.78896 3.27085 2.21107 3.5312 2.47141L7.0598 6.00001L3.5312 9.52861C3.27085 9.78895 3.27085 10.2111 3.5312 10.4714C3.79155 10.7318 4.21366 10.7318 4.47401 10.4714L8.47401 6.47141C8.73436 6.21106 8.73436 5.78895 8.47401 5.52861L4.47401 1.52861C4.21366 1.26826 3.79155 1.26826 3.5312 1.52861Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Modal -->
    <div class="modal fade modal-overly" id="registeration-Info-{{ $key }}" tabindex="-1" aria-hidden="true">
        <div class="transac modal-dialog modal-dialog-centered modal-lg res-dialog">
            <div class="modal-content modal-transac registeration-modal">
                <div class="modal-body modal-themeBody">
                    <div class="d-flex position-relative modal-res">
                        <button type="button" class="cursor-pointer close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg class="position-absolute close-btn text-gray-100" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.24408 5.24408C5.56951 4.91864 6.09715 4.91864 6.42259 5.24408L10 8.82149L13.5774 5.24408C13.9028 4.91864 14.4305 4.91864 14.7559 5.24408C15.0814 5.56951 15.0814 6.09715 14.7559 6.42259L11.1785 10L14.7559 13.5774C15.0814 13.9028 15.0814 14.4305 14.7559 14.7559C14.4305 15.0814 13.9028 15.0814 13.5774 14.7559L10 11.1785L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L8.82149 10L5.24408 6.42259C4.91864 6.09715 4.91864 5.56951 5.24408 5.24408Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                        <div class="deposit-transac d-flex flex-column justify-content-center p-4 text-wrap">
                            <div class="d-flex justify-content-center text-primary align-items-center transac-img">
                                {{-- <img src="{{ image($transactionImage, $directoryName) }}" alt="{{ __('Transaction') }}" class="img-fluid"> --}}
                            </div>
                            <p class="mb-0 mt-28 text-dark gilroy-medium f-15 r-f-12 r-mt-18 text-center">
                                {{ getTransactionInfo($registeration->transaction_type?->name)['name'] }}&nbsp;{{ __('Amount') }}
                            </p>
                            <p class="mb-0 text-dark gilroy-Semibold f-24 leading-29 r-f-26 text-center l-s2 mt-10">
                                {{ moneyFormat($registeration->currency?->symbol, formatNumber($registeration->subtotal, $registeration->currency_id)) }}
                            </p>
                            <p class="mb-0 mt-18 text-gray-100 gilroy-medium f-13 leading-20 r-f-14 text-center">
                                {{ dateFormat($registeration->created_at) }}</p>
                            <div class="d-flex justify-content-center">
                                {{-- <a href="{{ route(getTransactionInfo($registeration->transaction_type?->name)['print'], ($registeration->transaction_type_id == Crypto_Sent || $registeration->transaction_type_id == Crypto_Received) ? encrypt($registeration->id) : $registeration->id) }}" class="infoBtn-print cursor-pointer f-14 gilroy-medium text-dark mt-35 d-flex justify-content-center align-items-center" target="__blank">
                                    {!! svgIcons('printer') !!}&nbsp;
                                    <span>{{ __('Print') }}</span>
                                </a> --}}
                            </div>
                        </div>
                        <div class="ml-20 trans-details">
                            <p class="mb-0 mt-9 text-dark dark-5B f-20 gilroy-Semibold transac-title">
                                {{ __('Transaction Details') }}</p>

                            <!-- Crypto Address -->
                            {{-- @if ($registeration->transaction_type_id == Crypto_Sent || $registeration->transaction_type_id == Crypto_Received)
                                <div class="row gx-sm-5">
                                    <div class="col-12">
                                        <p class="mb-0 mt-4 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                            {{ getTransactionInfo($registeration->transaction_type?->name)['type'] }}
                                            {{ __('Address') }}</p>
                                        <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                            @if ($registeration->transaction_type_id == Crypto_Sent)
                                                {{ optional(cryptoApiLogDetails($registeration))['receiverAddress'] }}
                                            @elseif($registeration->transaction_type_id == Crypto_Received)
                                                {{ optional(cryptoApiLogDetails($registeration))['senderAddress'] }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif --}}

                            <div class="row gx-sm-5">
                                <div class="col-6">
                                    <p class="mb-0 mt-4 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ getTransactionInfo($registeration->transaction_type?->name)['type'] }}</p>
                                    <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                        {{ getTransactionInfo($registeration->transaction_type?->name, $registeration)['user'] }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0 mt-4 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Currency') }}</p>
                                    <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                        {{ $registeration->currency?->code }}</p>
                                </div>
                            </div>
                            <div class="row gx-sm-5">
                                <div class="col-6">
                                    <p class="mb-0 mt-20 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Transaction ID') }}</p>
                                    <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                        {{ $registeration->uuid }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0 mt-20 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Transaction Fee') }}</p>
                                    <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">

                                        {{-- @if (($registeration->transaction_type?->name == 'Crypto_Sent') | ($registeration->transaction_type?->name == 'Crypto_Received'))
                                            {{ 
                                                optional(cryptoApiLogDetails($registeration))['network_fee'] != 0 
                                                    ? moneyFormat($registeration->currency?->symbol, optional(cryptoApiLogDetails($registeration))['network_fee']) 
                                                    : '-' 
                                            }}
                                        @else
                                            {{ calculateFee($registeration) != 0 ? getmoneyFormatFee($registeration) : '-' }}
                                        @endif --}}
                                    </p>
                                </div>
                            </div>
                            <div class="row gx-sm-5">
                                <div class="col-6">
                                    <p class="mb-0 mt-20 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Payment Method') }}</p>
                                    <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                        {{ getTransactionPaymentMethod($registeration->payment_method?->name) ?? '-' }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0 mt-20 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Status') }}</p>
                                    <p id="status_{{ $registeration->id }}"
                                        class="mb-0 mt-5p {{ getColor($registeration->status) }} gilroy-medium f-15 leading-22 r-text">
                                        {{ getStatus($registeration->status) }}</p>
                                </div>
                            </div>
                            <p class="hr-border w-100 mb-0"></p>
                            <div class="row gx-sm-5">

                                <!-- Amount -->
                                <div class="col-6">
                                    <p
                                        class="mb-0 mt-4 text-gray-100 dark-B87 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ getTransactionInfo($registeration->transaction_type?->name)['name'] }}&nbsp;{{ __('Amount') }}
                                    </p>
                                    <p class="mb-0 mt-5p text-dark dark-CDO gilroy-medium f-15 leading-22 r-text">
                                        {{ moneyFormat($registeration->currency?->symbol, formatNumber($registeration->subtotal, $registeration->currency_id)) }}
                                    </p>
                                </div>

                                <!-- Total Amount -->
                                <div class="col-6">
                                    <p
                                        class="mb-0 mt-4 text-gray-100 dark-B87 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                        {{ __('Total Amount') }}</p>
                                    <p class="mb-0 mt-5p text-dark dark-CDO gilroy-medium f-15 leading-22 r-text">
                                        {{ moneyFormat($registeration->currency?->symbol, formatNumber($registeration->total, $registeration->currency_id)) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Transaction Note -->
                            @if (!empty($registeration->note))
                                <div class="row gx-sm-5">
                                    <div class="col-12">
                                        <p class="mb-0 mt-20 text-gray-100 gilroy-medium f-13 leading-20 r-f-9 r-mt-11">
                                            {{ __('Note') }}</p>
                                        <p class="mb-0 mt-5p text-dark gilroy-medium f-15 leading-22 r-text">
                                            {{ $registeration->note ?? '' }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Accept and Cancel button -->
                            @if (
                                ('Request_Received' == $registeration->transaction_type?->name) |
                                    ('Request_Sent' == $registeration->transaction_type?->name) && 'Pending' == $registeration->status)
                                {{-- @php
                                $requestVia = !empty($registeration->email) ? $registeration->email : $registeration->phone;
                            @endphp --}}
                                <div class="row gx-sm-5">
                                    <div class="col-12">
                                        <div class="d-flex gap-12 mt-20">
                                            @if ('Request_Received' == $registeration->transaction_type?->name)
                                                <button class="btn btn-primary status-btn trxn_accept"
                                                    data-rel="{{ $registeration->transaction_reference_id }}"
                                                    data="{{ $registeration->id }}"
                                                    id="acceptbtn_{{ $registeration->id }}">{{ __('Accept') }}</button>
                                            @endif
                                            <button class="btn btn-warning text-dark status-btn yellow-btn trxn"
                                                data="{{ $registeration->id }}"
                                                data-type="{{ $registeration->transaction_type_id }}"
                                                data-notificationType="{{ $requestVia }}"
                                                id="btn_{{ $registeration->id }}">{{ __('Cancel') }}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Open dispute -->
                            {{-- @if ($registeration->transaction_type_id == Payment_Sent && $registeration->status == 'Success' && !isset($registeration->dispute->id))
                            <div class="row gx-sm-5">
                                <div class="col-12">
                                    <div class="d-flex gap-12 mt-20">
                                        <a href="{{ route('user.disputes.create', $registeration->id) }}" class="btn btn-primary disputes-btn" id="dispute{{ $registeration->id }}"><span>{{ __('Open dispute') }}</span></a>
                                    </div>
                                </div>
                            </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}

    {{-- @if (!in_array($registeration->transaction_type?->id, $transactionTypes))
        @foreach (getCustomModules() as $addon)

            @if (module($addon->get('name')) && view()->exists(strtolower($addon->get('name')) . '::user.registeration.' . strtolower($addon->get('name'))) && in_array($registeration->transaction_type?->id, config($addon->get('alias') . '.' . 'transaction_types')))
                @include(strtolower($addon->get('name')) . '::user.registeration.'.strtolower($addon->get('name')))
            @endif
        @endforeach
    @endif --}}
@endforeach
