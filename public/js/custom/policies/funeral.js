/**
 * Created by Bright on 5/22/2016.
 */

var funeralPolicy = new Vue({

    el: '#vue-funeral',

    data: {
        customerSearch: {
            query: null,
            by: 'surname'
        },
        foundCustomers: [],
        selectedCustomer: null,
    },

    methods: {

        selectCustomer: function(customer){
            this.selectedCustomer = customer;

            confirm('Proceed with creating a policy for <strong>' + this.getCustomerName(customer) + '?</strong>'
                , function(){
                    // redirect to funeral policy creation form
                    window.location = baseUrl() + '/policy/funeral/create/'+customer.id;
                    // // hide search modal
                    // $('.modal.find-customer-form').modal('hide');
                    // // show new policy form
                    // $('.modal.new-policy-form').modal('show');
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
                }, function(){
                   alert('Something went wrong! We try again!', 'danger', function(){
                       return window.location.reload();
                   });
                });
        },

        customerSearchHandler: function(data){
            this.foundCustomers = JSON.parse(data);
        },

        findCustomer: function(){
            findCustomer(this.customerSearch.query, this.customerSearch.by, this.customerSearchHandler);
        }
    },

    ready: function(){
        this.getPolicyMetadata();
    }

});