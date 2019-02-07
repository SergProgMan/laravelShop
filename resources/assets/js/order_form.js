//const $ = require('jquery');
const typeahead = require('typeahead');

let cityMap = {};

$(document).ready(function() {
    const npCityEl = $('#np_city');
    const npWarehouseEl = $('#np_warehouse');
    
    typeahead('#np_city', {
        source: function(searchString, callback) {
    
            let requestUrl = npCityEl.data('callback-url');
            let request = $.ajax({
                method: 'POST',
                url: requestUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    searchString: searchString
                }
            });
            
            request.done(function(data) {
                let answer = $.parseJSON(data);
                if (answer.data.length == 0) {
                    return;
                }
                let addresses = answer.data[0].Addresses;
                let stringData = [];
                $.each(addresses, function(key, item) {
                    cityMap[item.Present] = item;
                    stringData.push(item.Present);
                });
                callback(stringData);
            });
        },
        updater: function(cityName) {
            let city = cityMap[cityName];
            
            let requestUrl = npWarehouseEl.data('callback-url');
            let request = $.ajax({
                method: 'POST',
                url: requestUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    DeliveryCity: city.DeliveryCity
                }
            });
            
            request.done(function(data) {
                let answer = $.parseJSON(data);
                let warehouses = answer.data;
                npWarehouseEl.html('');
                $.each(warehouses, function(key, item) {
                    npWarehouseEl.append(
                        $("<option></option>")
                            .attr("value", item.Description)
                            .text(item.Description)
                    ); 
                });
            });

            return cityName;
        }
    });
});
