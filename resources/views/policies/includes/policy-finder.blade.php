<div class="main-box-body clearfix">
    <div class="search-box">
        <div class="title">
            <h2 class="pull-left"><i class="fa fa-search search-icon"></i> Find Policy</h2>
            <h2 class="pull-right text-danger" v-show="policySearch.emptyResults">
                <i class="fa fa-exclamation-circle"></i> No results found</h2>
        </div>
        <form class="form-inline finder-form" role="form" @submit.prevent="findPolicy">
            <div class="form-group">
                <label class="sr-only" for="search-query">Search Query</label>
                <input autofocus autocomplete="off" type="text" class="form-control search-query" id="search-query"
                       placeholder="Policy Number" v-model="policySearch.query"
                       @keyup.enter="findPolicy">
            </div>
            <button type="submit" class="btn btn-success btn-submit">Search</button>
            <p class="alt-search">
                <a href="{{ url('/customer') }}">
                    Search by customer?
                </a>
            </p>
        </form>
        <div class="search-results" v-if="foundPolicies.length > 0">
            <div class="title clearfix">
                <h2 class="pull-left">Matching Policy:</h2>
            </div>
            <h4>@{{{ policyUrl() }}}</h4>
        </div>
    </div>
</div>