<form method="post" action="https://payeer.com/merchant/" id="payeer" accept-charset="UTF-8">
	<input type="hidden" name="m_shop" value="{{ $m_shop }}">
	<input type="hidden" name="m_orderid" value="{{ $m_orderid }}">
	<input type="hidden" name="m_amount" value="{{ $m_amount }}">
	<input type="hidden" name="m_curr" value="{{ $m_curr }}">
	<input type="hidden" name="m_desc" value="{{ $m_desc }}">
	<input type="hidden" name="m_sign" value="{{ $sign }}">
	<input type="hidden" name="form[ps]" value="2609">
	<input type="hidden" name="form[curr[2609]]" value="{{ $form_currency_code }}">
	<input type="hidden" name="m_params" value="{{ $m_params }}">
	<input type="hidden" name="m_cipher_method" value="AES-256-CBC">
	<input type="submit" name="m_process" id="payeer-submit-button" value="{{ __('Click here if you are not redirected automatically') }}" />
</form>
<script src="{{ asset('/dist/libraries/jquery-3.6.1/jquery-3.6.1.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    'use strict';
    $('#payeer-submit-button').trigger('click');
</script>