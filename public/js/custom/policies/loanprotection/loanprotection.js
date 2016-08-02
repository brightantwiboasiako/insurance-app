/**
 * Created by Bright on 7/30/2016.
 */

var addPolicyForm = $('.add-policy-form');
var addBorrowerForm = $('.add-borrower-form');

Vue.config.debug = true;

new Vue({
   
    el: '#vue-loanprotection',
    data: {
        policy: {
            financier: {
                name: null,
                address: null,
                email: null,
                phone: null,
                branch:null
            },
            borrowers: [],
            business_type: 'loanprotection',
            borrower: {},
            number: null
        },
        borrowers: [],

        // for FindPolicy Mixin
        finderModel: 'loanprotection'
    },
    
    methods: {
        
        addBorrower: function(){
            var model = this;
            model.policy.borrowers = [];
            model.policy.borrowers.push(model.policy.borrower);



            bindValidator(addBorrowerForm, 'Add', function(){

                confirm('Proceed with adding this loan/borrower?', function(){

                    post(baseUrl() + '/policy/loanprotection/borrower/add/'+model.policy.number, model.policy, function(data){

                        if(data.OK){
                            alert('Loan added to plan successfully.', 'success', function(){
                                window.location.reload();
                            });
                        }else{
                            bindErrors(data.errors.borrowers, addBorrowerForm);
                        }

                    }, function(response){
                        alert(response.responseText, 'danger');
                    })

                }, function(){});

            });

        },
        
        createPlan: function(){
            var model = this;
            bindValidator(addPolicyForm, 'Create', function(){

                post(baseUrl() + '/policy/create', model.policy, function(data){
                    if(data.OK){
                        confirm('Policy has been created successfully. Proceed with adding clients now?', function(){
                            window.location = baseUrl() + '/loanprotection/' + data.policy.number;
                        }, function(){}, 'info');
                    }else{
                        //alert('There were some errors. Please check them and try again.', 'danger');
                        bindErrors(data.errors.financier, addPolicyForm);
                    }
                }, function(response){
                    alert(response.responseText);
                    //alert('Something went wrong while processing. Please try again.', 'danger');
                });

            });
        }
    },

    mixins: [Paginator, Money, Moment, FindPolicy],

    ready: function(){
        bindValidator(addPolicyForm, 'Create', function(){});
        bindValidator(addBorrowerForm, 'Add', function(){});

        this.pagerItems = JSON.parse(this.borrowers);
        
    }
    
});