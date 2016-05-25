/**
 * Created by Bright on 5/2/2016.
 */

Vue.prototype.money = function(amount, currency){
    var scaled = (amount/100);
    if(Math.ceil(Math.log10(scaled)) > 5)
        return currency + ' ' + numeral(amount/100).format('0,0.00a');
    else
        return currency + ' ' + numeral(amount/100).format('0,0.00');
};


Vue.prototype.date = function(date){
    var date = new Date(date);
    return date.getDay() + '/' + date.getMonth() + '/' + date.getFullYear();
};


Vue.prototype.getCustomerName = function(customer){
    if(customer.other_name !== null){
        return customer.title + ' ' + ' ' + customer.surname + ' ' + customer.first_name
            + ' ' + customer.other_name;
    }else{
        return customer.title + ' ' + ' ' + customer.surname + ' ' + customer.first_name;
    }
};

//Vue.config.debug = true;