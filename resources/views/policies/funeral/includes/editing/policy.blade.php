<div class="step-pane active" id="policy">
    <br/>
    <h4>Information Pertaining to the Policy</h4>
        <div class="col-md-12">
            <label>POLICY</label>
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Sum Assured</label>
            </div>
            <input type="text" class="form-control validate[required,min[10]]" name="sum_assured"
                   v-model="policy.policy_details.sum_assured" value="{{ e($policy->sumAssured()->getAmount()) }}"  placeholder="Sum Assured">
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Issue Date</label>
            </div>
            <input type="text" class="form-control date validate[required]"
                   value="{{ e($policy->issueDate()->format('Y-m-d')) }}"
                   v-model="policy.policy_details.issue_date" placeholder="Issue Date">
        </div>
        <div class="form-group col-md-4">
            <div class="control-label">
                <label>Automatic Benefit Update</label>
            </div>
            <select class="form-control validate[required]" v-model="policy.policy_details.automatic_update_percentage"
                    name="automatic_update_percentage">
                <option v-for="percentage in options.automatic_update_percentages"
                        v-bind:value="percentage">
                    @{{ percentage + '%' }}</option>
            </select>
        </div>
        <div class="col-md-12">
            <label>PREMIUM PAYMENT</label>
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Bank Name</label>
            </div>
            <input type="text" class="form-control validate" name="bank_name"
                   v-model="policy.policy_details.bank.name" placeholder="Bank Name"
            value="{{ e($policy->bankName()) }}">
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Account Number</label>
            </div>
            <input type="text" class="form-control validate" name="account_number"
                   v-model="policy.policy_details.bank.account_number" placeholder="Account Number">
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Mode of Payment</label>
            </div>
            <select class="form-control validate[required]" name="mode_of_payment"
                    v-model="policy.policy_details.mode_of_payment">
                @include('policies.includes.payment-methods')
            </select>
        </div>
        <div class="form-group col-md-3">
            <div class="control-label">
                <label>Payment Frequency</label>
            </div>
            <select class="form-control validate[required]" name="payment_frequency"
                    v-model="policy.policy_details.payment_frequency">
                @include('policies.includes.payment-frequencies')
            </select>
        </div>
        <div class="col-md-12">
            <label>ACCIDENTAL INDEMNITY RIDER</label>
        </div>
        <div class="form-group col-md-3">
            <select class="form-control" name="accidental_rider"
                    v-model="policy.policy_details.accidental_rider">
                <option {{ default_select('no', $policy->accidentalRider()) }} value="no">No</option>
                <option {{ default_select('yes', $policy->accidentalRider()) }} value="yes">Yes</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <input type="text" class="form-control validate[required]"
                   v-bind:disabled="policy.policy_details.accidental_rider==='no'"
                   v-model="policy.policy_details.accidental_rider_premium"
                   value="{{ e($policy->accidentalRiderPremium()->getAmount()) }}"
                   placeholder="Accidental Rider Amount" name="accidental_rider_premium">
        </div>

        <div class="col-md-12">
            <label>FAMILY INSURANCE RIDER</label>
        </div>
        <div class="form-group col-md-3">
            <select class="form-control" name="family_rider"
                    v-model="policy.policy_details.family_rider">
                <option {{ default_select('no', $policy->familyRider()) }} value="no">No</option>
                <option {{ default_select('yes', $policy->familyRider()) }} value="yes">Yes</option>
            </select>
        </div>

        <div class="col-md-12" v-show="policy.policy_details.family_rider==='yes'">
            <div class="col-md-12">
                <label>Add Family Member</label>
            </div>
                <div class="form-group col-md-3">
                    <input class="form-control validate[maxSize[64]]" v-model="family.name"
                           name="family_name" placeholder="Name"/>
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control date validate[]" v-model="family.birthday"
                           name="family-birth_day" placeholder="Date of Birth"/>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="family-gender" v-model="family.gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control validate[]" name="family-relationship"
                            v-model="family.relationship">
                        <option value="">Relationship</option>
                        <option v-for="(key,family) in options.supported_family"
                                v-bind:value="family">@{{ family }}</option>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" v-show="!editing" @click="addMember" class="btn btn-sm btn-primary">Add Member</button>
                    <button type="button" v-show="editing" @click="editMember" class="btn btn-sm btn-primary">Save</button>
                </div>
        </div>

    <div class="col-md-12" v-if="policy.policy_details.family.length > 0">
        <div class="col-md-12">
            <label>Added Family Members</label>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-stripped">
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
                <tr v-for="(key, family) in policy.policy_details.family">
                    <td>@{{ (key + 1) }}</td>
                    <td>@{{ family.name }}</td>
                    <td>@{{ family.birthday }}</td>
                    <td>@{{ family.gender }}</td>
                    <td>@{{ family.relationship }}</td>
                    <td>
                        <button class="btn btn-default btn-xs" title="Edit"
                        @click="setEditableMember(key)">
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