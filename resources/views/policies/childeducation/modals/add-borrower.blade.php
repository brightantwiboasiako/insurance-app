<div class="modal fade add-borrower-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" class="add-borrower-form" @submit.prevent="addBorrower">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <i class="fa fa-plus-circle"></i> Add Loan/Borrower to {{ e($policy->policyNumber()) }} by
                        {{ e($policy->institutionName()) }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="step-pane active" id="policy">
                        <h6><i class="fa fa-money" aria-hidden="true"></i> Loan & Premium</h6>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control validate[required]" name="loan_amount"
                                       v-model="policy.borrower.loan_amount"  placeholder="Loan Amount">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control date datepicker validate[required]" name="issue_date"
                                       v-model="policy.borrower.issue_date"  placeholder="Loan Issue Date">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control validate[required]" name="term"
                                       v-model="policy.borrower.term"  placeholder="Loan Term (in years)">
                            </div>
                         </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control validate[required]" name="premium"
                                       v-model="policy.borrower.premium"  placeholder="Premium Amount">
                            </div>
                        </div>
                        <h6><i class="fa fa-user" aria-hidden="true"></i> Borrower</h6>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control validate[required]" name="name"
                                       v-model="policy.borrower.name"  placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control validate[required]" name="phone"
                                       v-model="policy.borrower.phone"  placeholder="Phone Number">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control date datepicker validate[required]" name="birthday"
                                       v-model="policy.borrower.birthday"  placeholder="Birthday">
                            </div>
                            <div class="form-group col-md-3">
                                <select name="gender" v-model="policy.borrower.gender" class="form-control">
                                    <option selected>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-submit btn-sm">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->