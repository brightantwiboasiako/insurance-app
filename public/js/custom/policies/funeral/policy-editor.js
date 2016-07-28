/**
 * Created by Bright on 5/22/2016.
 */

var formElement = $('.creation-policy');

var funeralPolicy = new Vue({

    el: '#vue-funeral',

    data: {
        editing: false,
        options: {
            'payment_frequencies': [],
            'payment_methods': [],
            'automatic_update_percentages': [],
            'supported_family': []
        },
        family: {},
        beneficiary: {
            gender: 'Male'
        },
        trustee: {
            gender: 'Male'
        },
        policy: {
            policy_details: {
                sum_assured: null,
                issue_date: '',
                automatic_update_percentage: '',
                mode_of_payment: '',
                payment_frequency: '',
                family_rider: 'no',
                accidental_rider: 'no',
                accidental_rider_premium: 0,
                family: [],
                bank: {
                    name: null,
                    account_number: null
                }
            },
            underwriting: {
                cancer: 'No',
                hiv: 'No',
                good_health: 'No',
                illness: 'No',
                height: null,
                weight: null
            },
            beneficiaries: [],
            agent_id: 1,
            branch_id: 1,
            business_type: 'funeral',
            customer_id: null,
            trustee: {}
        },
        rawData: {}
    },

    methods: {
        resetFamily: function(){
            this.family = {
                gender: 'Male',
                relationship: ''
            };
        },

        resetBeneficiary: function(){
            this.beneficiary = {
                gender: 'Male'
            };
        },

        createPolicy: function(){
            var model = this;
            setProcess(formElement.find('.btn-submit'));
            bindValidator(formElement, 'Create Policy', function(){
                model.processCreation();
            });
        },

        processCreation: function(){
            this.$http.post(baseUrl() + '/policy/create', this.newPolicy)
                .then(function(response){
                    if(response.data.OK){
                        alert('Policy has been created successfully.', 'success');
                    }else{
                        console.log(response.data.errors);
                        alert('There were some errors that must be checked.', 'danger', function(){
                            bindErrors(response.data.errors.policy, formElement);
                            bindErrors(response.data.errors.family, formElement);
                            bindErrors(response.data.errors.underwriting, formElement);
                        });
                    }
                }, function(response){
                    alert(response.body);
                    //alert('There was an error while processing. Please try again!', 'danger');
                });
        },

        addMember: function(){
            var model = this;
            if(model.family.relationship !== ''){
                model.newPolicy.policy_details.family.push(model.family);
                model.resetFamily();
            }

        },

        addBeneficiary: function(){
            if(!this.percentageOverflow()){
                this.newPolicy.beneficiaries.push(this.beneficiary);
                this.resetBeneficiary();
            }else{
                alert('Total percentage cannot exceed 100%.', 'danger');
            }
        },

        percentageOverflow: function(){
            var total = 0;
            this.newPolicy.beneficiaries.forEach(function(beneficiary){
                total += parseFloat(beneficiary.percentage);
            });

            return (total + parseFloat(this.beneficiary.percentage)) > 100;
        },

        setEditableBeneficiary: function(key){
            this.editing = true;
            this.beneficiary = this.newPolicy.beneficiaries[key];
        },

        editBeneficiary: function(){
            this.editing = false;
            this.resetBeneficiary();
        },

        removeBeneficiary: function(key){
            var model = this;
            confirm('Are you sure you want to remove '+ model.newPolicy.beneficiaries[key].name +'?', function(){
                model.newPolicy.beneficiaries.splice(key, 1);
            }, function(){});
        },

        editMember: function(){
            this.editing = false;
            this.resetFamily();
        },

        setEditableMember: function(key){
            this.editing = true;
            this.family = this.newPolicy.policy_details.family[key];
        },

        getFamilyMember: function(key){
            return this.newPolicy.policy_details.family[key];
        },

        removeFamilyMember: function(key){
            var model = this;
            confirm('Are you sure you want to remove '+ model.getFamilyMember(key).name +'?', function(){
                model.newPolicy.policy_details.family.splice(key, 1);
            }, function(){});
        },

        getPolicyMetadata: function(){
            var model = this;
            this.$http.get(baseUrl() + '/policy/metadata?type=funeral')
                .then(function(response){
                    if(response.data.OK){
                        model.options = JSON.parse(response.data.data.options);
                    }else{
                        alert('Something went wrong! Try reloading the page.', 'danger');
                    }
                }, function(response){
                    // alert(response.body, 'danger'); return;
                    alert('Something went wrong! We try again!', 'danger', function(){
                        return window.location.reload();
                    });
                });
        },

        bootValidator: function(){
            bindValidator(formElement, null, function(){});
            //bindValidator($('.creation-family-members'), null, function(){});
        }
    },

    mixins: [
        AgencyMixin,
        BranchMixin
    ],

    ready: function(){
        this.getPolicyMetadata();
        this.resetFamily();
        this.bootValidator();
        this.rawData = JSON.parse(this.rawData);
        this.policy.policy_details.family = JSON.parse(this.rawData.family_members);
        this.policy.policy_details.automatic_update_percentage = this.rawData.automatic_update_percentage;
        this.policy.underwriting = JSON.parse(this.rawData.underwriting);
        this.policy.beneficiaries = JSON.parse(this.rawData.beneficiaries);
        this.policy.trustee = JSON.parse(this.rawData.trustee);
        this.policy.agent_id = this.rawData.agent_id;
        this.policy.customer_id = this.rawData.customer_id;
        this.policy.policy_details.policy_number = this.rawData.policy_number;

    }

});