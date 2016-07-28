/**
 * Created by Bright on 7/25/2016.
 */

var buble = require('buble');

module.exports = {
    entry: './custom/policies/funeral/policy-creator.js',
    output: {
        filename: './custom/dist/policies/funeral/policy-creator.js'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'buble'
            }
        ]
    }
}