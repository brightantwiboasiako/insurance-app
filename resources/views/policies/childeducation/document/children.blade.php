<div v-show="page === 2">
    <div class="title details">
        <h2>INSURED CHILDREN</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name of Child</th>
                </tr>
                </thead>

                <tbody>
                @foreach($policy->coveredChildren() as $key => $child)
                    <tr>
                        <td class="text-left">{{ ($key + 1) }}</td>
                        <td class="text-left">{{ $child }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>