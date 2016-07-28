<div class="step-pane" id="agency">
    <br/>
    <h4>Agency & Branch</h4>
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Choose Agent</label>
        </div>
        <div class="form-group col-md-10">
            <select class="form-control" v-model="policy.agent_id">
                <option v-for="agent in agents"
                        v-bind:value="agent.id">@{{ agent.name }}</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Choose Branch</label>
        </div>
        <div class="form-group col-md-10">
            <select class="form-control" v-model="policy.branch_id">
                <option v-for="branch in branches"
                        v-bind:value="branch.id">@{{ branch.name }}</option>
            </select>
        </div>
    </div>
</div>