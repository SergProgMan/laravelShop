
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});



const typeahead = require('typeahead');
const jquery = require('jquery');

let categoryIdInput = jquery('#category_id');

let catMap = {};

typeahead('#category_name', {
    source: function(searchString, callback) {

        let catSearchEndPoint = categoryIdInput.data('search-end-point');
        let request = jquery.ajax({
            method: 'GET',
            url: catSearchEndPoint,
            data: {
                searchString: searchString
            }
        });
        
        request.done(function(answer) {
            let data = answer.data;
            let stringData = [];
            jquery.each(data, function(key, item) {
                catMap[item.name] = item;
                stringData.push(item.name);
            });
            callback(stringData);
        });
    },
    updater: function(categoryName) {
        let category = catMap[categoryName];
        categoryIdInput.val(category.id);
        return categoryName;
    }
});