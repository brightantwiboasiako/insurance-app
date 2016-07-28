<div class="modal fade new-policy-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" name="add-customer-form" @submit.prevent="createPolicy">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" v-if="selectedCustomer">
                        <i class="fa fa-plus-circle"></i> New Funeral Policy for @{{ getCustomerName(selectedCustomer) }}
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="main-box-body clearfix">

                        <div id="myWizard" class="wizard">
                            <div class="wizard-inner">
                                <ul class="steps">
                                    <li data-target="#policy" class="active"><span class="badge badge-primary">1</span>Policy Details<span class="chevron"></span></li>
                                    <li data-target="#underwriting"><span class="badge">2</span>Underwriting<span class="chevron"></span></li>
                                    <li data-target="#beneficiaries"><span class="badge">3</span>Beneficiaries<span class="chevron"></span></li>
                                    <li data-target="#agency"><span class="badge">4</span>Agency<span class="chevron"></span></li>
                                </ul>
                                <div class="actions">
                                    <button type="button" class="btn btn-default btn-mini btn-prev"> <i class="icon-arrow-left"></i>Prev</button>
                                    <button type="button" class="btn btn-success btn-mini btn-next" data-last="Finish">Next<i class="icon-arrow-right"></i></button>
                                </div>
                            </div>
                            <div class="step-content">
                                <div class="step-pane active" id="policy">
                                    <br/>
                                    <h4>Information Pertaining to the Policy</h4>
                                    <div class="col-md-12">
                                        <label>POLICY</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control validate[required]"
                                              v-model="newPolicy.policyDetails.sum_assured"  placeholder="Sum Assured">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control date validate[required]"
                                               v-model="newPolicy.policyDetails.issue_date" placeholder="Issue Date">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select class="form-control" v-model="newPolicy.policyDetails.automatic_benefit_percentage"
                                                name="automatic_benefit_percentage">
                                            <option value="">Automatic Benefit Update</option>
                                            <option v-for="percentage in options.automatic_update_percentages"
                                                    v-bind:value="percentage">
                                                @{{ percentage + '%' }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>PREMIUM PAYMENT</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control validate[required]"
                                               v-model="newPolicy.policyDetails.bank.name" placeholder="Bank Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control validate[required]"
                                               v-model="newPolicy.policyDetails.bank.account_number" placeholder="Account Number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="payment_mode"
                                                v-model="newPolicy.policyDetails.payment_method">
                                            <option value="">Mode of Payment</option>
                                            <option v-for="(key, method) in options.payment_methods"
                                                    v-bind:value="key">@{{ method }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="payment_frequency"
                                                v-model="newPolicy.policyDetails.payment_frequency">
                                            <option value="">Payment Frequency</option>
                                            <option v-for="(key, freq) in options.payment_frequencies"
                                                    v-bind:value="key">@{{ freq }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>ACCIDENTAL INDEMNITY RIDER</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="accidental_rider"
                                                v-model="newPolicy.policyDetails.accidental_rider">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control"
                                               v-bind:disabled="newPolicy.policyDetails.accidental_rider==='no'"
                                               v-model="newPolicy.policyDetails.accidental_rider_amount"
                                               placeholder="Accidental Rider Amount">
                                    </div>

                                    <div class="col-md-12">
                                        <label>FAMILY INSURANCE RIDER</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="family_rider"
                                                v-model="newPolicy.policyDetails.family_rider">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" v-if="newPolicy.policyDetails.family_rider==='yes'">
                                        <div class="col-md-12">
                                            <label>Add Family Member</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" v-model="family.name"
                                                   name="family_name" placeholder="Name"/>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control date" v-model="family.birthday"
                                                   name="family-birth_day" placeholder="Date of Birth"/>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <select class="form-control" name="family-gender" v-model="family.gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control" name="family-relationship"
                                                    v-model="family.relationship">
                                                <option value="">Relationship</option>
                                                <option v-for="(key,family) in options.supported_family"
                                                        v-bind:value="key">@{{ family }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="button" @click="addMember" class="btn btn-sm btn-primary">Add Member</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12" v-if="newPolicy.policyDetails.family_members.length > 0">
                                        <div class="col-md-12">
                                            <label>Added Family Members</label>
                                        </div>
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Birth Day</th>
                                                    <th>Gender</th>
                                                    <th>Relationship</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(key, family) in newPolicy.policyDetails.family_members">
                                                    <td>@{{ (key + 1) }}</td>
                                                    <td>@{{ family.name }}</td>
                                                    <td>@{{ family.birthday }}</td>
                                                    <td>@{{ family.gender }}</td>
                                                    <td>@{{ family.relationship }}</td>
                                                    <td>
                                                        <button class="btn btn-default btn-xs" title="Edit"
                                                        @click="editFamilyMember(key)">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-xs" title="Remove"
                                                        @click="removeFamilyMember(key)">
                                                        <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="step-pane" id="step2">
                                    <br/>
                                    <h4>This is step 2</h4>
                                    <div class="alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                        <i class="fa fa-check-circle fa-fw fa-lg"></i>
                                        <strong>Well done!</strong> You successfully read this important alert message.
                                    </div>
                                    <div class="alert alert-info fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                        <i class="fa fa-info-circle fa-fw fa-lg"></i>
                                        <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                    </div>
                                    <div class="alert alert-warning fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                        <i class="fa fa-warning fa-fw fa-lg"></i>
                                        <strong>Warning!</strong> Best check yo self, you're not looking too good.
                                    </div>
                                    <div class="alert alert-danger fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                                        <i class="fa fa-times-circle fa-fw fa-lg"></i>
                                        <strong>Oh snap!</strong> Change a few things up and <a href="#" class="alert-link">try submitting again</a>.
                                    </div>
                                </div>
                                <div class="step-pane" id="step3">
                                    <br/>
                                    <h4>This is step 3</h4>

                                    <div class="form-group">
                                        <label for="maskedDate">Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" id="maskedDate">
                                        </div>
                                        <span class="help-block">ex. 99/99/9999</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="maskedPhone">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" id="maskedPhone">
                                        </div>
                                        <span class="help-block">ex. (999) 999-9999</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="maskedPhoneExt">Phone + Ext</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                            <input type="text" class="form-control" id="maskedPhoneExt">
                                        </div>
                                        <span class="help-block">ex. (999) 999-9999? x99999</span>
                                    </div>
                                </div>
                                <div class="step-pane" id="step4">
                                    <br/>
                                    <h4>This is step 4</h4>

                                    <div class="alert alert-success fade in" style="margin: 100px 0;">
                                        <i class="fa fa-check-circle fa-fw fa-lg"></i>
                                        <strong>Congratulation!</strong> You have successfully finished our nice wizard.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->