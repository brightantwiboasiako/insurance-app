/**
 * Created by Bright on 5/10/2016.
 */

$(document).ready(function(){

    var customers = new Vue({
        el: '#vue-customers',
        data: {
            found: [],
            selectedCustomer: {
                id: null,
                title: null,
                first_name: null,
                surname: null,
                other_name: null,
                email: null,
                primary_phone_number: null
            },
            newCustomer: {
                title: 'Mr.',
                surname: null,
                first_name: null,
                other_name: null,
                email: null,
                primary_phone_number: null,
                personal_address: null,
                gender: 'M',
                birth_day: null,
                occupation: null,
                employer_name: null,
                employer_address: null
            }
        },

        methods: {

            showEditForm: function(customer){
                this.selectedCustomer = customer;
                $('.edit-form').css('display', 'inline-block');
            },

            modify: function(){
                setProcess($('.edit-form').find('.btn-submit'), '<i class="fa fa-spin fa-spinner"></i>');
            },

            create: function(){
                setProcess($('form[name=add-customer-form]').find('.btn-submit'), '<i class="fa fa-spin fa-spinner"></i>');
            },

            resetNewCustomer: function(){
                this.newCustomer = {
                    title: 'Mr.',
                    surname: null,
                    first_name: null,
                    other_name: null,
                    email: null,
                    primary_phone_number: null,
                    personal_address: null,
                    gender: 'M',
                    birth_day: null,
                    occupation: null,
                    employer_name: null,
                    employer_address: null
                };
            }
        }
    });

    // Bind validation engine to modification form
    var editCustomerForm = $('form[name=edit-form]');
    bindValidator(editCustomerForm, 'Modify',function(){

        var options = {
            type: 'post',
            url: baseUrl() + '/customer/edit',
            data: customers.selectedCustomer
        };

        ajax(options, function(response){
            if(!response.OK){
                bindErrors(response.errors, editCustomerForm);
            }else{
                // successfully created customer
                var message = '<strong>' +
                    customers.getCustomerName(customers.selectedCustomer) + '</strong>' + ' was modified successfully.';

                alert(message);
            }
        }, function(response){
            alert('There was an error! Please try again.', 'danger', function(){
                return window.location.reload();
            });
        });

        cancelProcess(editCustomerForm.find('.btn-submit'), 'Modify');
    });


    // Bind validation engine to add customer form
    var createCustomerForm = $('form[name=add-customer-form]');

    bindValidator(createCustomerForm, 'Create', function(form){
        confirm("Are you sure you want to create this customer? <br>" +
            "<span class='text-danger'>Note that some fields cannot be changed once created!</span>", function(){
            var options = {
                type: 'post',
                url: baseUrl() + '/customer/create',
                data: customers.newCustomer
            };

            ajax(options, function(response){

                if(!response.OK){
                    console.log(response);
                    bindErrors(response.errors, createCustomerForm);
                    alert('Could not create customer. Please check the inputs and try again!', 'danger');
                }else{
                    // successfully created customer

                    var message = '<strong>' +
                        customers.getCustomerName(customers.newCustomer) + '</strong>' + ' was created successfully.';

                    alert(message);
                    customers.resetNewCustomer();
                }

            }, function(response){

                // alert(response.responseText, 'danger');

                alert('Something went wrong. Please try again!', 'danger', function(){
                    return window.location.reload();
                });
            });

            cancelProcess(createCustomerForm.find('.btn-submit'), 'Create');
        }, function(){
            cancelProcess(createCustomerForm.find('.btn-submit'), 'Create');
        });
    });


    $('.search-query').on('keyup', function(e){

        var query = $(this).val().trim();
        findCustomer(query, $('.search-by').val(), customerSearchHandler);

    });

    $('.finder-form').on('submit', function(e){
        e.preventDefault();
        findCustomer($('.search-query').val().trim(), $('.search-by').val(), customerSearchHandler);
    });



    function customerSearchHandler(data){
        if(data.length > 0){
            customers.found = data;
            finderNoResult(false);
        }else{
            customers.found = [];
            finderNoResult(true);
        }
    }

});
