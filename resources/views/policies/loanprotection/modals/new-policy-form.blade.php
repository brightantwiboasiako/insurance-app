<div class="modal fade new-policy-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" class="add-policy-form" @submit.prevent="createPlan">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <i class="fa fa-plus-circle"></i> New Loan Protection Plan
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="step-pane active" id="policy">
                        <h4>Please provide the information of the financier (institution)</h4>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control validate[required]" name="name"
                                       v-model="policy.financier.name"  placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control validate[required]" name="branch"
                                       v-model="policy.financier.branch"  placeholder="Branch">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control validate[required]" name="email"
                                       v-model="policy.financier.email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control validate[required]" name="phone"
                                       v-model="policy.financier.phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea class="form-control validate[required]" placeholder="Address of Institution"
                                          v-model="policy.financier.address" name="address"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-submit btn-sm">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->