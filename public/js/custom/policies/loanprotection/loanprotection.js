/**
 * Created by Bright on 7/30/2016.
 */

var formElement = $('.add-policy-form');

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
            business_type: 'loan protection'
        }
    },
    
    methods: {
        createPlan: function(){
            var model = this;
            bindValidator(formElement, 'Create', function(){

                post(baseUrl() + '/policy/create', model.policy, function(data){
                    if(data.OK){
                        confirm('Policy has been created successfully. Proceed with adding clients now?', function(){
                            window.location = baseUrl() + '/loanprotection/' + data.policy.number;
                        }, function(){});
                    }else{
                        //alert('There were some errors. Please check them and try again.', 'danger');
                        bindErrors(data.errors.financier, formElement);
                    }
                }, function(response){
                    alert('Something went wrong while processing. Please try again.', 'danger');
                });

            });
            
        }
    },

    ready: function(){
        bindValidator(formElement, 'Create', function(){});
    }
    
});