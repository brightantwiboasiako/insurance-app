/**
 * Created by Bright on 5/22/2016.
 */

new Vue({

    el: '#vue-childeducation',
    data: {

    },

    methods: {
        selectCustomer: function(customer){
            confirm('Proceed with creating a plan for <strong>' + this.getCustomerName(customer) + '?</strong>',
            function(){
                window.location = buildUrlFromBase('policy','childeducation', 'create', customer.id);
            }, function(){});
        }
    },

    mixins: [FindCustomer]
});