/**
 * Created by Bright on 5/22/2016.
 */

var formElement = $('.creation-policy');

new Vue({

    el: '#vue-childeducation',
    data: {
        editing: false,
        policy: {},
        child: {
            name: null,
            birthday: null,
            gender: 'Male'
        }
    },

    methods: {
        createPolicy: function(){

            // Fill the add child form with last child (if any) to
            // pass validation
            this.child = this.policy.children[this.policy.children.length - 1];
            
            var model = this;
            
            bindValidator(formElement, 'Create Policy', function(){
                ajax({
                    type: 'post',
                    url: baseUrl() + '/policy/create',
                    data: model.policy,
                    dataType: 'json',
                    encode: true
                }, function(data){
                    if(data.OK){
                        alert('Policy has been created successfully.', 'success');
                        model.resetPolicy();
                    }else{
                        console.log(data.errors);
                        alert('There were some errors that must be checked.', 'danger', function(){
                            bindErrors(data.errors.policy, formElement);
                            bindErrors(data.errors.family, formElement);
                            bindErrors(data.errors.underwriting, formElement);
                        });
                    }
                }, function(response){
                    alert(response.responseText);
                    //alert('There was an error while processing. Please try again!', 'danger');
                });
            });
        },

        addChild: function(){
            if(!this.percentageOverflow()){
                if(this.child.name && this.child.birthday && this.child.percentage){
                    this.policy.children.push(this.child);
                    this.resetChild();
                }else{
                    alert('All fields are required.', 'danger');
                }
            }else{
                alert('Total percentage cannot exceed 100%.', 'danger');
            }
        },

        percentageOverflow: function(){
            var total = 0;
            this.policy.children.forEach(function(child){
                total += parseFloat(child.percentage);
            });

            return (total + parseFloat(this.child.percentage)) > 100;
        },

        setEditableChild: function(key){
            if(!this.percentageOverflow()){
                this.editing = true;
                this.child = this.policy.children[key];
            }else{
                alert('Total percentage cannot exceed 100%', 'danger');
            }
        },

        editChild: function(){
            this.editing = false;
            this.resetChild();
        },

        removeChild: function(key){
            var model = this;
            confirm('Are you sure you want to remove '+ model.policy.children[key].name +'?', function(){
                model.policy.children.splice(key, 1);
            }, function(){});
        },

        resetChild: function(){
            this.child = {
                gender: 'Male'
            };
        },

        resetPolicy: function(){
            this.policy =  {
                policy_details: {
                    sum_assured: null,
                    issue_date: null,
                    bank: {
                        name: null,
                        account_number: null
                    },
                    mode_of_payment: '',
                    payment_frequency: ''
                },
                underwriting: {
                    cancer: 'No',
                    hiv: 'No',
                    good_health: 'No',
                    illness: 'No',
                    height: '',
                    weight: ''
                },
                children: [],
                customer_id: null,
                agent_id: 1,
                branch_id: 1,
                business_type: 'childeducation'
            }
        },

        bootValidator: function(){
            bindValidator(formElement, null, function(){});
            //bindValidator($('.creation-family-members'), null, function(){});
        }
    },

    mixins: [FindCustomer, AgencyMixin, BranchMixin],

    ready: function(){
        // bind validator to form
        this.bootValidator();
        // set the policy defaults
        this.resetPolicy();
    }

});