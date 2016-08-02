@if(isset($policy))
    <option {{ default_select('CASH', $policy->paymentMode()) }} value="CASH">CASH</option>
    <option {{ default_select('CHEQUE', $policy->paymentMode()) }} value="CHEQUE">CHEQUE</option>
    <option {{ default_select('STANDING ORDER', $policy->paymentMode()) }} value="STANDING ORDER">STANDING ORDER</option>
    <option {{ default_select('DIRECT DEBIT', $policy->paymentMode()) }} value="DIRECT DEBIT">DIRECT DEBIT</option>
    <option {{ default_select('CAG', $policy->paymentMode()) }} value="CAG">CAG</option>
@else
    <option value="">Mode of Payment</option>
    <option value="CASH">CASH</option>
    <option value="CHEQUE">CHEQUE</option>
    <option value="STANDING ORDER">STANDING ORDER</option>
    <option value="DIRECT DEBIT">DIRECT DEBIT</option>
    <option value="CAG">CAG</option>
@endif