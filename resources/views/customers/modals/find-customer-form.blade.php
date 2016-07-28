<div class="modal fade find-customer-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="pull-left"><i class="fa fa-search search-icon"></i> Find Customer</h2>
                <h2 class="pull-right text-danger finder-empty-results">
                    <i class="fa fa-exclamation-circle"></i> No results found</h2>
            </div>
            <div class="modal-body">

                <div class="search-box">
                    <form class="form-inline finder-form" role="form" @submit.prevent="findCustomer">
                        <div class="form-group">
                            <label class="sr-only" for="search-query">Search Query</label>
                            <input autofocus type="text" class="form-control search-query" id="search-query"
                                   v-model="customerSearch.query"
                                   placeholder="Search for" autocomplete="off" @keyup="findCustomer">
                        </div>
                        <div class="form-group">
                            <select name="search_by" v-model="customerSearch.by" class="form-control search-by">
                                <option value="surname">Surname</option>
                                <option value="first_name">Firstname</option>
                                <option value="email">Email</option>
                                <option value="primary_phone_number">Phone Number</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-submit">Search</button>
                    </form>
                </div>

                <div class="main-box-body clearfix">
                    <div class="search-results" v-if="foundCustomers.length > 0">
                        <div class="title clearfix">
                            <h2 class="pull-left">Search Results:</h2>
                            <h2 class="pull-right"><span class="badge">@{{ foundCustomers.length }}</span> total</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th><span>Name</span></th>
                                    <th><span>Email</span></th>
                                    <th class="text-center"><span>Phone Number</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="customer in foundCustomers" @click="selectCustomer(customer)">
                                    <td><i class="fa fa-caret-right" aria-hidden="true"></i>
                                        @{{{ getCustomerName(customer) }}}</td>
                                    <td>@{{ customer.email }}</td>
                                    <td class="text-center">@{{ customer.primary_phone_number }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

