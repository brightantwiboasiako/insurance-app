<div v-show="page === 3">
    <div class="title details">
        <h2>SCHEDULE OF LIVES COVERED & BENEFITS</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of Insured</th>
                    <th>Age</th>
                    <th >Gender</th>
                    <th>Relationship</th>
                    <th>Expiry Date</th>
                    <th class="text-center">Death Benefit</th>
                    <th class="text-center">{{ e($policy->periodicPremiumString()) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($policy->structure()->all() as $key => $structure)
                    <tr>
                        <td class="text-left">{{ ($key + 1) }}</td>
                        <td class="text-left">{{ $structure['name'] }}</td>
                        <td class="text-left">{{ $structure['age'] }}</td>
                        <td class="text-left">{{ $structure['gender'] }}</td>
                        <td class="text-left">{{ strtoupper($structure['relationship']) }}</td>
                        <td class="text-left">{{ $structure['expiry_date']->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $structure['benefit'] }}</td>
                        <td class="text-center">{{ $structure['premium'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-left"><strong>Sub Total</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->structure()->totalBenefit()) }}</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->structure()->totalCoverPremium()) }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-left"><strong>Accidental Rider Premium</strong></td>
                    <td class="text-center border-top-1"><strong>-</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->accidentalPremiumComponent()) }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-left"><strong>Underwriting Premium</strong></td>
                    <td class="text-center"><strong>-</strong></td>
                    <td class="text-center"><strong>{{ e($policy->underwritingPremiumComponent()) }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="text-left"><strong>Total</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->structure()->totalBenefit()) }}</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->premium()) }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>