/**
 * Created by Bright on 7/25/2016.
 */

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