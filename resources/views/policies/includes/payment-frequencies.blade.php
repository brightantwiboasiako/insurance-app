@if(isset($policy))
    <option {{ default_select('MONTHLY', $policy->paymentFrequency()) }} value="MONTHLY">MONTHLY</option>
    <option {{ default_select('QUARTERLY', $policy->paymentFrequency()) }} value="QUARTERLY">QUARTERLY</option>
    <option {{ default_select('SEMI ANNUALLY', $policy->paymentFrequency()) }} value="SEMI ANNUALLY">SEMI ANNUALLY</option>
    <option {{ default_select('ANNUALLY', $policy->paymentFrequency()) }} value="ANNUALLY">ANNUALLY</option>
@else
    <option value="">Payment Frequency</option>
    <option value="MONTHLY">MONTHLY</option>
    <option value="QUARTERLY">QUARTERLY</option>
    <option value="SEMI ANNUALLY">SEMI ANNUALLY</option>
    <option value="ANNUALLY">ANNUALLY</option>
@endif