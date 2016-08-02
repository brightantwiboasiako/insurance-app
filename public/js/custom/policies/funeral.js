/**
 * Created by Bright on 5/22/2016.
 */

new Vue({

    el: '#vue-funeral',

    data: {
        policySearch: {
            query: null,
            by: 'policy_number',
            foundPolicies: []
        },
        // Needed by FindPolicy mixin
        finderModel: 'funeral'
    },

    methods: {

        selectCustomer: function(customer){
            confirm('Proceed with creating a policy for <strong>' + this.getCustomerName(customer)+'</strong> ?', function(){
                window.location = baseUrl() + '/policy/funeral/create/'+customer.id;
            }, function(){});
        }
    },

    ready: function(){

    },
    
    mixins: [FindCustomer, FindPolicy]

});