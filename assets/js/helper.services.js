angular.module('helper.service', []).factory('helperServices', helperServices);

function helperServices($location) {
	var service = { IsBusy: false, priotitas : [ '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ], absUrl: $location.$$absUrl };
	service.url = $location.$$protocol + '://' + $location.$$host;
	if ($location.$$port) {
		service.url = service.url + ':' + $location.$$port;
	}

	// '    http://localhost:5000';

	service.groupBy = (list, keyGetter) => {
		const map = new Map();
		list.forEach((item) => {
			const key = keyGetter(item);
			const collection = map.get(key);
			if (!collection) {
				map.set(key, [ item ]);
			} else {
				collection.push(item);
			}
		});
		return map;
	};
	
	return service;
}
