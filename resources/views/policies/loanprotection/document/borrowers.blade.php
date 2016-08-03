<div v-show="page === 2">
    <div class="title details">
        <h2>BORROWERS</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of Borrower</th>
                </tr>
                </thead>

                <tbody>
                @foreach($policy->loanBorrowers() as $key => $borrower)
                    <tr>
                        <td class="text-left">{{ ($key + 1) }}</td>
                        <td class="text-left">{{ $borrower }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>