<div class="title" v-show="page === 1">
    <div class="company-info">
        <div class="logo">
            <img src="{{ asset(config('company.logo')) }}" alt="Logo"/>
        </div>
        <div class="address">
            {!! config('company.address') !!}
        </div>
        <h2 class="business">{{ e(config('policy.childeducation.name')) }}</h2>
    </div>
    <div class="policy-summary border-bottom-3">
        <div class="row">
            <div class="col-md-3 text-left">
                <p>PRIMARY INSURED</p>
                <p><strong>{{ e(strtoupper($policy->customer->name())) }}</strong></p>
            </div>
            <div class="col-md-3 text-left">
                <p>SUM ASSURED</p>
                <p><strong>{{ e($policy->sumAssured()) }}</strong></p>
            </div>
            <div class="col-md-3 text-left">
                <p>POLICY NUMBER</p>
                <p><strong>{{ e($policy->policyNumber()) }}</strong></p>
            </div>
            <div class="col-md-3 text-left">
                <p>ISSUE DATE</p>
                <p><strong>{{ e(strtoupper($policy->issueDate()->format('M d, Y'))) }}</strong></p>
            </div>
        </div>
    </div>
    <div class="endorsement page-info border-bottom-3">
        <p>While this policy is in force, <strong>{{ e(config('company.name')) }}</strong> will pay the Death Benefit to the
            Beneficiary at the death of the Insured. All payments are subject to the provisions of this policy.</p>
        <br><br>
        <p>Signed for the Company at Accra, Ghana; on the date of issue:</p>
        <br><br>
        ----------------------------------<br>
        MANAGING DIRECTOR
    </div>
</div>
