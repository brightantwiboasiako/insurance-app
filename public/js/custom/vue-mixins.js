/**
 * Created by Bright on 7/25/2016.
 */

var FindCustomer = {
    data: {
        foundCustomers: [],
        customerSearch: {
            query: '',
            by: 'surname',
            like: 0
        }
    },

    methods: {
        findCustomer: function(){
            var mixin = this;
            Finder.methods.find('finder', {
                model: 'customer',
                by: this.customerSearch.by,
                like: this.customerSearch.like,
                query: this.customerSearch.query
            }, function(err, found){
                if(!err){
                    mixin.foundCustomers = found;
                    if(mixin.foundCustomers.length === 0) mixin.customerSearch.emptyResults = true;
                    else mixin.customerSearch.emptyResults = false;
                }else{
                    mixin.customerSearch.emptyResults = true;
                }
            })
        }

    }
};

var FindPolicy = {
    data: {
        foundPolicies: [],
        policySearch: {
            query: '',
            by: 'policy_number',
            like: 0,
            emptyResults: false
        }
    },

    methods: {
        findPolicy: function(){
            var mixin = this;
            Finder.methods.find('finder', {
                model: 'funeral policy',
                by: this.policySearch.by,
                like: this.policySearch.like,
                query: this.policySearch.query
            }, function(err, found){
                if(!err){
                    mixin.foundPolicies = found;
                    if(mixin.foundPolicies.length === 0) mixin.policySearch.emptyResults = true;
                    else mixin.policySearch.emptyResults = false;
                }else{
                    mixin.policySearch.emptyResults = true;
                }
            })
        }
    }
};

var Finder = {

    data: {
        found: []
    },

    methods: {

        find: function(url, options, callback){
            var like = (options.like === undefined) ? null : options.like;

            ajax({
                type: 'get',
                url: baseUrl()
                + '/' + url + '?query='+options.query+'&model='+options.model+'&by='+options.by+'&like='+like,
                dataType: 'json',
                encode: true
            }, function(data){
                callback(null, data);
            }, function(response){
                console.log(response);
            });
            //
            // Vue.http.get(baseUrl()
            //     + '/' + url + '?query='+options.query+'&model='+options.model+'&by='+options.by+'&like='+like)
            //     .then(function(response){
            //         callback(null,JSON.parse(response.data));
            //     }, function(response){
            //         console.log(response.body);
            //         callback(true);
            //     });
        }

    }

};


var AgencyMixin = {
    
    data: {
        agents: []
    },
    
    methods: {
        getAgents: function(){
            var mixin = this;
            this.$http.get(baseUrl() + '/app/agents')
                .then(function(response){
                    mixin.agents = response.data;
                }, function(response){
                    alert('Something went wrong. We will try again.', 'danger', function(){
                        return window.location.reload();
                    });
                });
        }
    },
    
    created: function(){
        this.getAgents();
    }
    
};


var BranchMixin = {

    data: {
        branches: []
    },

    methods: {
        getBranches: function(){
            var mixin = this;
            this.$http.get(baseUrl() + '/app/branches')
                .then(function(response){
                    mixin.branches = response.data;
                }, function(){
                    alert('Something went wrong. We will try again.', 'danger', function(){
                        return window.location.reload();
                    });
                });
        }
    },

    created: function(){
        this.getBranches();
    }

};