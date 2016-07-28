<div class="search-box">
    <div class="title">
        <h2 class="pull-left"><i class="fa fa-search search-icon"></i> Find Customer</h2>
        <h2 class="pull-right text-danger finder-empty-results">
            <i class="fa fa-exclamation-circle"></i> No results found</h2>
    </div>
    <form class="form-inline finder-form" role="form">
        <div class="form-group">
            <label class="sr-only" for="search-query">Search Query</label>
            <input autofocus type="text" class="form-control search-query" id="search-query"
                   placeholder="Search for" @keyup="findCustomer" v-model="search.query">
        </div>
        <div class="form-group">
            <select name="search_by" v-model="search.by" class="form-control search-by">
                <option value="surname">Surname</option>
                <option value="first_name">Firstname</option>
                <option value="email">Email</option>
                <option value="primary_phone_number">Phone Number</option>
            </select>
        </div>
        <button type="submit" @click="findCustomer" class="btn btn-success btn-submit">Search</button>
    </form>
</div>