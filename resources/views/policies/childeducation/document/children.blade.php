<div v-show="page === 2">
    <div class="title details">
        <h2>INSURED CHILDREN</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of Child</th>
                    <th>Child's Birthday</th>
                    <th>Sum Assured</th>
                    <th>Premium</th>
                </tr>
                </thead>

                <tbody>
                @foreach($policy->coveredChildren() as $key => $child)
                    <tr>
                        <td class="text-left">{{ ($key + 1) }}</td>
                        <td class="text-left">{{ $child->name() }}</td>
                        <td class="text-left">{{ $child->birthday() }}</td>
                        <td class="text-left">{{ $policy->sumAssured() }}</td>
                        <td class="text-left">{{ $policy->premiumStructure() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>