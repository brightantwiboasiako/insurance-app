<div class="step-pane" id="beneficiaries">
    <br/>
    <h4>Beneficiaries</h4>
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Add Beneficiary</label>
        </div>
        <div class="form-group col-md-3">
            <input class="form-control" v-model="beneficiary.name" name="beneficiary_name"
                    placeholder="Name"/>
        </div>
        <div class="form-group col-md-1">
            <input class="form-control" v-model="beneficiary.age" name="beneficiary_age"
                   name="age" placeholder="Age"/>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="beneficiary_gender" v-model="beneficiary.gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" v-model="beneficiary.relationship"
                   name="beneficiary_relationship" placeholder="Relationship"/>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" v-model="beneficiary.percentage"
                   name="beneficiary_percentage" placeholder="Percentage (E.g 5 for 5%)"/>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" v-model="beneficiary.phone_number"
                   name="beneficiary_phone" placeholder="Phone Number"/>
        </div>
        <div class="form-group col-md-1">
            <button type="button" v-show="!editing" @click="addBeneficiary" class="btn btn-sm btn-primary">Add Beneficiary</button>
            <button type="button" v-show="editing" @click="editBeneficiary" class="btn btn-sm btn-primary">Save</button>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Add Trustee</label>
        </div>
        <div class="form-group col-md-3">
            <input class="form-control" v-model="newPolicy.trustee.name"
                   placeholder="Name" name="trustee_name"/>
        </div>
        <div class="form-group col-md-1">
            <input class="form-control" v-model="newPolicy.trustee.age"
                   name="trustee_age" placeholder="Age"/>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="trustee_gender" v-model="newPolicy.trustee.gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" v-model="newPolicy.trustee.relationship"
                   name="trustee_relationship" placeholder="Relationship"/>
        </div>
        <div class="form-group col-md-2">
            <input class="form-control" v-model="newPolicy.trustee.phone_number"
                   name="trustee_phone" placeholder="Phone Number"/>
        </div>
    </div>
    <div class="col-md-12" v-if="newPolicy.beneficiaries.length > 0">
        <div class="col-md-12">
            <label>Added Beneficiaries</label>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Percentage</th>
                    <th>Relationship</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(key, beneficiary) in newPolicy.beneficiaries">
                    <td>@{{ (key + 1) }}</td>
                    <td>@{{ beneficiary.name }}</td>
                    <td>@{{ beneficiary.age }}</td>
                    <td>@{{ beneficiary.gender }}</td>
                    <td>@{{ beneficiary.percentage }}%</td>
                    <td>@{{ beneficiary.relationship }}</td>
                    <td>@{{ beneficiary.phone_number }}</td>
                    <td>
                        <button class="btn btn-default btn-xs" title="Edit" type="button"
                        @click="setEditableBeneficiary(key)">
                        <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-xs" title="Remove" type="button"
                        @click="removeBeneficiary(key)">
                        <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>