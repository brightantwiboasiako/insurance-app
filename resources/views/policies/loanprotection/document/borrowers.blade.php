<div v-show="page === 2">
    <div class="title details">
        <h2>BORROWERS</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of Borrower</th>
                    <th>Gender</th>
                    <th>Contact #</th>
                    <th>Loan Amount</th>
                    <th>Premium</th>
                    <th>Loan Maturity Date</th>
                </tr>
                </thead>

                <tbody>
                @foreach($policy->loanBorrowers() as $key => $borrower)
                    <tr>
                        <td class="text-left">{{ ($key + 1) }}</td>
                        <td class="text-left">{{ strtoupper($borrower->name()) }}</td>
                        <td class="text-left">{{ strtoupper($borrower->gender()) }}</td>
                        <td class="text-left">{{ $borrower->phone() }}</td>
                        <td class="text-left">{{ $borrower->loanAmount() }}</td>
                        <td class="text-left">{{ $borrower->premium() }}</td>
                        <td class="text-left">{{ $borrower->loanMaturityDate() }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-left"><strong>Total</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->totalLoanAmount()) }}</strong></td>
                    <td class="text-center border-top-1"><strong>{{ e($policy->premium()) }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>