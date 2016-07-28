<div class="step-pane" id="underwriting">
    <br/>
    <h4>Underwriting Information</h4>
    <div class="col-md-8">
        <div class="col-md-10">
            <label><h4>Have you or any of the nominated lives been diagnosed of cancer?</h4></label>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control validate[required]" v-model="policy.underwriting.cancer" name="cancer">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>

        <div class="col-md-10">
            <label><h4>Have you or any of the nominated lives been diagnosed of HIV or AIDS?</h4></label>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control validate[required]" v-model="policy.underwriting.hiv" name="hiv">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>

        <div class="col-md-10">
            <label>
                <h4>At present are you aware of, or have you or any of the nominated lives
                    received advice from a doctor that you or any of the nominated lives are
                    suffering from any illness?</h4>
            </label>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control validate[required]" v-model="policy.underwriting.illness" name="illness">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>

        <div class="col-md-9">
            <label>
                <h4>Has any proposal for life assurance on your life ever been accepted with
                    an extra premium, or any other special terms or declined?
                    If so, when and by which company?</h4>
            </label>
        </div>
        <div class="form-group col-md-3">
            <input type="text" v-model="policy.underwriting.declined_proposal" name="declined_proposal"
                   class="form-control validate"/>
        </div>
        <div class="col-md-12">
            <label>
                <h4>When did you last consult a doctor and for what reason?</h4>
            </label>
        </div>
        <div class="form-group col-md-12">
            <textarea class="form-control validate" v-model="policy.underwriting.doctor_consult"
            placeholder="Enter last consultation date and description" name="doctor_consult"></textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="col-md-3">
            <label>
                <h4>Height(cm)</h4>
            </label>
        </div>
        <div class="form-group col-md-9">
            <input type="text" class="form-control validate[required]"
                   v-model="policy.underwriting.height" name="height"/>
        </div>
        <div class="col-md-3">
            <label>
                <h4>Weight(kg)</h4>
            </label>
        </div>
        <div class="form-group col-md-9">
            <input type="text" class="form-control validate[required]"
                   v-model="policy.underwriting.weight" name="weight"/>
        </div>
        <div class="col-md-7">
            <label>
                <h4>Are you in good health?</h4>
            </label>
        </div>
        <div class="form-group col-md-5">
            <select class="form-control validate[required]" name="good_health"
                    v-model="policy.underwriting.good_health">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>
    </div>
</div>