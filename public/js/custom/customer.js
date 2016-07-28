/**
 * Created by Bright on 5/10/2016.
 */

var createCustomerForm = $('form[name=add-customer-form]');
var editCustomerForm = $('form[name=edit-form]');


var customers = new Vue({
    el: '#vue-customers',
    data: {
        found: [],
        search: {
            query: '',
            by: 'surname'
        },
        editing: false,
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
            this.editing = true;
        },

        modify: function(){
            setProcess(editCustomerForm.find('.btn-submit'), '<i class="fa fa-spin fa-spinner"></i>');
        },

        create: function(){
            setProcess(createCustomerForm.find('.btn-submit'), '<i class="fa fa-spin fa-spinner"></i>');
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
        },

        findCustomer: function(){
            var model = this;
            findCustomer(this.search.query, this.search.by, function(data){
                if(data.length > 0){
                    model.found = data;
                    finderNoResult(false);
                }else{
                    model.found = [];
                    finderNoResult(true);
                }
            });
        },

        handleResponse: function(response, type){

            var successMessage;
            var failureMessage;
            if(type === 'create'){
                successMessage = '<strong>'+model.getCustomerName(model.newCustomer) + '</strong> was created successfully';
                failureMessage = 'Could not create customer. Please check the inputs and try again!';
            }else{
                successMessage = '<strong>'+model.getCustomerName(this.selectedCustomer) + '</strong> was created successfully';
                failureMessage = 'Could not modify customer. Please check the inputs and try again!';
            }

            if(response.data.OK){
                alert(successMessage);
                this.resetNewCustomer();
            }else{
                // errors occured
                bindErrors(response.data.errors, form);
                alert(failureMessage, 'danger');
            }

            cancelProcess(form.find('.btn-submit'), 'Create');
        }

    },

    ready: function(){

        var model = this;

        // Bind validation engine to modification form
        bindValidator(editCustomerForm, 'Modify',function(){

            model.$http.post(buildUrlFromBase('customer', 'edit'), model.selectedCustomer)
                .then(function(response){
                    model.handleResponse(response, 'create', createCustomerForm);
                }, function(response){
                    alert(response.data);
                });

            cancelProcess(editCustomerForm.find('.btn-submit'), 'Modify');
        });


        // Bind validation engine to add customer form
        bindValidator(createCustomerForm, 'Create', function(form){
            confirm("Are you sure you want to create this customer? <br>" +
                "<span class='text-danger'>Note that some fields cannot be changed once created!</span>", function(){
                model.$http.post(buildUrlFromBase('customer', 'create'), model.newCustomer)
                    .then(function(response){

                        model.handleResponse(response, 'create', createCustomerForm);

                    }, function(response){
                        alert(response.data);
                        // alert('Something went wrong. Please try again.', 'danger', function(){
                        //     window.location.reload();
                        // });
                    });

            }, function(){
                cancelProcess(createCustomerForm.find('.btn-submit'), 'Create');
            });
        });

    }
});
