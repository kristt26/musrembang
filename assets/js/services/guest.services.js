angular
	.module('guest.service', ['helper.service'])
	.factory('HomeService', HomeService);

function HomeService($http, $q, helperServices) {
	var url = helperServices.url + '/home/';
	var service = {
		Items: []
	};

	service.get = function () {
        var def = $q.defer();
        id = helperServices.absUrl.split('/');
        id = id.length == 7 ? id[id.length - 1]: '';
		$http({
			method: 'Get',
			url: url + 'getdata/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.getKegiatan = function () {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdatacreated/' + id,
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	return service;
}

