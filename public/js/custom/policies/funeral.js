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
        }
    },

    methods: {

        selectCustomer: function(customer){
            confirm('Proceed with creating a policy for <strong>' + this.getCustomerName(customer)+'</strong> ?', function(){
                window.location = baseUrl() + '/policy/funeral/create/'+customer.id;
            }, function(){});
        },

        // findPolicy: function(){
        //     this.find('finder', {
        //        query: this.policySearch.query,
        //        model: 'funeral policy',
        //        by: this.policySearch.by
        //     }, this.policySearch.foundPolicies);
        // },
        //
        policyUrl: function(){
            return '<a href='+baseUrl() + '/policy/funeral/'+this.policyNumber()+'>'+this.policyNumber()+'</a>'
        },

        policyNumber: function(){
            return this.foundPolicies[0].policy_number;
        }
    },

    ready: function(){

    },
    
    mixins: [FindCustomer, FindPolicy]

});