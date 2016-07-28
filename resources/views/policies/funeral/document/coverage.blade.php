<div v-show="page === 2">
    <div class="title coverage dashed-bottom-1">
        <h2>COVERAGE PAGE</h2>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <td>PRIMARY INSURED</td>
                    <td><strong>{{ e(strtoupper($policy->customer->name())) }}</strong></td>
                    <td>DATE OF ISSUE</td>
                    <td><strong>{{ e(strtoupper($policy->issueDate()->format('M d, Y'))) }}</strong></td>
                </tr>
                <tr>
                    <td>POLICY NUMBER</td>
                    <td><strong>{{ e(strtoupper($policy->policyNumber())) }}</strong></td>
                    <td>DATE OF EXPIRY</td>
                    <td><strong>{{ e(strtoupper($policy->issueDate()->format('M d, Y'))) }}</strong></td>
                </tr>
                <tr>
                    <td>INITIAL FACE AMOUNT</td>
                    <td><strong>{{ e($policy->sumAssuredOriginal()) }}</strong></td>
                    <td>BENEFIT PERIOD</td>
                    <td><strong>{{ e(strtoupper($policy->issueDate()->format('M d, Y'))) }}</strong></td>
                </tr>
                <tr>
                    <td>AGE OF PRIMARY INSURED</td>
                    <td><strong>{{ e($policy->ageOfPrimaryInsured()) }} YEARS</strong></td>
                    <td>GENDER</td>
                    <td><strong>{{ e(strtoupper($policy->customer->gender())) }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="premium clearfix page-info dashed-bottom-1 mrg-b-md">
        <h4 class="pull-left">
            <strong>{{ e($policy->periodicPremiumString()) }}</strong>
        </h4>
        <h4 class="pull-right">
            <strong>{{ e($policy->premium()) }}</strong>
        </h4>
    </div>

    <div class="supplement dashed-bottom-1 mrg-b-lg">
        <p class="text-underline"><strong>SUPPLEMENTARY BENEFITS:</strong></p>
        <p>
            THE CHARGE FOR ANY ADDITIONAL BENEFITS WHICH ARE PROVIDED FOR
            BY RIDERS IS SHOWN BELOW. THE COMPLETE PROVISIONS ARE INCLUDED IN
            THE RIDER DOCUMENT ATTACHED TO THIS POLICY.
        </p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>SCHEDULE OF ADDITIONAL BENEFITS</th>
                    <th>SUM ASSURED</th>
                    <th>ANNUAL PREMIUM</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>PRIMARY AND FAMILY INSURANCE (Details on attached schedule)</strong></td>
                    <td>{{ e($policy->sumAssured()) }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>AUTOMATIC BENEFIT UPDATE COVER</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>ACCIDENTAL INDEMNITY RIDER</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>