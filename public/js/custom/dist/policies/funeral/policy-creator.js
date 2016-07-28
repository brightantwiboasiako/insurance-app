/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ 3:
/***/ function(module, exports) {

/**
 * Created by Bright on 5/22/2016.
 */

var formElement = $('.creation-policy');

var funeralPolicy = new Vue({

    el: '#vue-funeral',

    data: {
        editing: false,
        options: {
            'payment_frequencies': [],
            'payment_methods': [],
            'automatic_update_percentages': [],
            'supported_family': []
        },
        family: {},
        beneficiary: {
            gender: 'Male'
        },
        trustee: {
            gender: 'Male'
        },
        newPolicy: {
            policyDetails: {
                sum_assured: 0,
                issue_date: '',
                automatic_benefit_percentage: '',
                payment_method: '',
                payment_frequency: '',
                family_rider: 'no',
                accidental_rider: 'no',
                family_members: [],
                bank: {
                    name: null,
                    account_number: null
                },
                customer_id: null
            },
            underwriting: {
                cancer: 'No',
                hiv: 'No',
                good_health: 'No',
                illness: 'No'
            },
            beneficiaries: [],
            agent_id: 1,
            branch_id: 1
        }
    },

    methods: {
        resetFamily: function(){
            this.family = {
                gender: 'Male',
                relationship: ''
            };
        },

        resetBeneficiary: function(){
            this.beneficiary = {
                gender: 'Male'
            };
        },

        createPolicy: function(){
            this.$http.post(baseUrl())
        },

        addMember: function(){
            var model = this;
            if(model.family.relationship !== ''){
                model.newPolicy.policyDetails.family_members.push(model.family);
                model.resetFamily();
            }

        },

        addBeneficiary: function(){
            if(!this.percentageOverflow()){
                this.newPolicy.beneficiaries.push(this.beneficiary);
                this.resetBeneficiary();
            }else{
                alert('Total percentage cannot exceed 100%.', 'danger');
            }
        },

        percentageOverflow: function(){
            var total = 0;
            this.newPolicy.beneficiaries.forEach(function(beneficiary){
                total += beneficiary.percentage;
            });

            return (total + this.beneficiary.percentage) > 100;
        },

        setEditableBeneficiary: function(key){
            this.editing = true;
            this.beneficiary = this.newPolicy.beneficiaries[key];
        },

        editBeneficiary: function(){
            this.editing = false;
            this.resetBeneficiary();
        },

        removeBeneficiary: function(key){
            var model = this;
            confirm('Are you sure you want to remove '+ model.newPolicy.beneficiaries[key].name +'?', function(){
                model.newPolicy.beneficiaries.splice(key, 1);
            }, function(){});
        },

        editMember: function(){
            this.editing = false;
            this.resetFamily();
        },

        setEditableMember: function(key){
            this.editing = true;
            this.family = this.newPolicy.policyDetails.family_members[key];
        },

        getFamilyMember: function(key){
            return this.newPolicy.policyDetails.family_members[key];
        },

        removeFamilyMember: function(key){
            var model = this;
            confirm('Are you sure you want to remove '+ model.getFamilyMember(key).name +'?', function(){
                model.newPolicy.policyDetails.family_members.splice(key, 1);
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

        bootValidator: function(){
            bindValidator(formElement, null, function(){});
            //bindValidator($('.creation-family-members'), null, function(){});
        }
    },

    mixins: [
        AgencyMixin,
        BranchMixin
    ],

    ready: function(){
        this.getPolicyMetadata();
        this.resetFamily();
        this.bootValidator();
    }

});

/***/ }

/******/ });