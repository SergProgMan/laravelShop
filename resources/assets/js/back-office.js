require('./bootstrap');

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