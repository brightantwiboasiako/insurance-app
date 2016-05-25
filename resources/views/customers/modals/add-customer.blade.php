<div class="modal fade" id="modal-add-customer" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" name="add-customer-form" v-on:submit.prevent="create">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <i class="fa fa-plus-circle"></i> Create new customer
                    </h4>
                </div>
                <div class="modal-body">
                        <div class="col-md-12">
                            <label>NAME</label>
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="title" v-model="newCustomer.title">
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                                <option value="Rev.">Rev.</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control validate[required,maxSize[64]]" name="surname"
                                   id="surname" placeholder="Surname" v-model="newCustomer.surname">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control validate[required,maxSize[32]]" name="first_name"
                                   id="first-name" placeholder="First Name" v-model="newCustomer.first_name">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control validate[maxSize[32]]" id="other-name" name="other_name"
                                   placeholder="Other Name" v-model="newCustomer.other_name">
                        </div>

                        <div class="col-md-12">
                            <label>CONTACT</label>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control validate[required,custom[email]]" name="email"
                                       id="email" placeholder="Email Address" v-model="newCustomer.email">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control validate[required,custom[phone]]" name="phone"
                                       id="phone" placeholder="Phone Number" v-model="newCustomer.primary_phone_number">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <textarea class="form-control validate[required]" id="personal-address" name="personal_address"
                                      placeholder="Personal Address" rows="3" v-model="newCustomer.personal_address"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label>GENDER & BIRTHDAY</label>
                        </div>
                        <div class="form-group col-md-2">
                            <select class="form-control" name="gender" v-model="newCustomer.gender">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control validate[required]" name="birthday"
                                       id="birth-day" placeholder="Birth Day" v-model="newCustomer.birth_day">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>EMPLOYMENT INFORMATION</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control validate[required,maxSize[128]]" name="occupation"
                                   id="occupation" placeholder="Occupation" v-model="newCustomer.occupation">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control validate[required,maxSize[64]]" name="employer_name"
                                   id="employer-name" placeholder="Name of Employer" v-model="newCustomer.employer_name">
                        </div>

                        <div class="form-group col-md-12">
                            <textarea class="form-control validate[required]" id="employer-address" name="employer_address"
                                      placeholder="Employer's Address" rows="3" v-model="newCustomer.employer_address"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-submit">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->