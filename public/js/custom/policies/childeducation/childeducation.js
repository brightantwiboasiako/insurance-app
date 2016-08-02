/**
 * Created by Bright on 5/22/2016.
 */

new Vue({

    el: '#vue-childeducation',
    data: {

        // Needed by FindPolicy mixin
        finderModel: 'childeducation'
    },

    methods: {
        selectCustomer: function(customer){
            confirm('Proceed with creating a plan for <strong>' + this.getCustomerName(customer) + '?</strong>',
            function(){
                window.location = buildUrlFromBase('policy','childeducation', 'create', customer.id);
            }, function(){});
        },

        // Needed by FindPolicy mixin
        policyUrl: function(){
            return '<a href='+baseUrl() + '/policy/childeducation/'+this.policyNumber()+'>'+this.policyNumber()+'</a>'
        }
    },

    mixins: [FindCustomer, FindPolicy]
});