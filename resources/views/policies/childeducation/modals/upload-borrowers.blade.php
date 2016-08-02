<div class="modal fade upload-borrowers-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" class="upload-borrowers-form" method="post" enctype="multipart/form-data"
                  action="{{ url('policy/loanprotection/borrower/upload/'.e($policy->policyNumber())) }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <i class="fa fa-upload"></i> Bulk Loans/Borrowers upload to {{ e($policy->policyNumber()) }} by
                        {{ e($policy->institutionName()) }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="step-pane active" id="policy">
                        <h6>
                            <p>
                                Please select a .csv file containing the loans/borrowers data matching
                                the columns specified in the following image
                            </p>
                        </h6>
                        <div class="row">
                            <div class="form-group col-md-12">

                            </div>
                            <div class="form-group col-md-3">
                                <label>Choose File</label>
                                <input type="file" class="form-control"
                                       name="loans">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="checkbox-nice" title="Check this if the data has no titles.">
                                    <input type="checkbox" name="include_first" id="checkbox-1"/>
                                    <label for="checkbox-1">
                                        Include first column
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->