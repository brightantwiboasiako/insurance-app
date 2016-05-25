/**
 * Created by Bright on 5/22/2016.
 */

$(document).ready(function(){

    var funeralPolicy = new Vue({

        el: '#vue-funeral',

        data: {
            foundCustomers: [],
            selectedCustomer: null,
            options: {
                'payment_frequencies': [],
                'payment_methods': [],
                'automatic_update_percentages': [],
                'supported_family': []
            },

            newPolicy: {
                policyDetails: {
                    automatic_benefit_percentage: '',
                    payment_method: '',
                    payment_frequency: '',
                    family_rider: 'no',
                    accidental_rider: 'no',
                    family_members: []
                },
                underwritingInformation: {},
                beneficiaries: {},
                agency: {}
            }
        },

        methods: {
            selectCustomer: function(customer){
                this.selectedCustomer = customer;

                confirm('Proceed with creating a policy for <strong>' + this.getCustomerName(customer) + '?</strong>'
                    , function(){

                        // hide search modal
                        $('.modal.find-customer-form').modal('hide');

                        // show new policy form
                        $('.modal.new-policy-form').modal('show');

                }, function(){

                });
            }


        }

    });



    // Get payment methods and frequencies
    ajax({
        type: 'get',
        url: baseUrl() + '/policy/metadata',
        data: {type: 'funeral'},
        dataType: 'json',
        encode: 'true'
    }, function(response){

        if(response.OK){
            funeralPolicy.options = JSON.parse(response.data.options);
        }else{
            alert('Something went wrong! Try reloading the page.', 'danger');
        }


    }, function(response){

    });


    // Customer search
    var findCustomerForm = $('.find-customer-form').find('.finder-form');
    findCustomerForm.find('.search-query').on('keyup', function(e){

        var query = $(this).val().trim();
        findCustomer(query, $('.search-by').val(), customerSearchHandler, findCustomerForm);

    });

    findCustomerForm.on('submit', function(e){
        e.preventDefault();
        findCustomer($('.search-query').val().trim(), $('.search-by').val(), customerSearchHandler, findCustomerForm);
    });


    function customerSearchHandler(data){
        funeralPolicy.foundCustomers = data;
    }


});