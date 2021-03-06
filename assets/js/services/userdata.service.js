angular
	.module('userdata.service', [ 'helper.service' ])
	.factory('RenjaService', RenjaService)
	.factory('SkpdService', SkpdService)
	.factory('HomeService', HomeService);

function RenjaService($http, $q, helperServices) {
	var url = helperServices.url + '/user/renja/';
	var service = {
		Items: []
	};

	service.get = function() {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
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
					swal('Information!', err.data, 'error');
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.getKegiatan = function() {
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
					swal('Information!', err.data, 'error');
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.validasi = function(param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'validasi',
			data: param,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				if (!service.Items.data) {
					var data = service.Items.find((x) => x.idRencanaKerja == param.idRencanaKerja);
					if (data) {
						data.status = 'Usulan';
					}
				} else service.Items.data.status = 'Usulan';
				def.resolve(service.Items);
			},
			(err) => {
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.post = function(param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': undefined
			},
			data: param
		}).then(
			(response) => {
				service.Items = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'success');
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function(param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'success');
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.postjalan = function(param) {
		var def = $q.defer();
		$http({
			method: 'Post',
			url: helperServices.url + '/admin/rt/' + 'simpanjalan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				var data = service.Items.lingkungan.find((x) => x.idrt == param.idrt);
				data.jalan.push(response.data);
				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function SkpdService($http, $q, helperServices) {
	var url = helperServices.url + '/admin/skpd/';
	var service = { Items: [] };

	service.get = function() {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
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
					message.error(err.data);
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.post = function(param) {
		var def = $q.defer();
		$http({
			method: 'Post',
			url: url + 'simpan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				if (param.idRencanaBiaya) {
					var data = service.Items.find((x) => x.idbidangskpd == param.idbidangskpd);
					if (data) {
						data.NamaBidang = param.NamaBidang;
					}
				} else {
					service.Items.push(response.data);
				}

				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function(id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idbidangskpd == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}
function HomeService($http, $q, helperServices) {
	var url = helperServices.url + '/admin/home/';
	var service = {
		Items: []
	};

	service.get = function() {
		var def = $q.defer();
		$http({
			method: 'Get',
			url: url + 'getdata',
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
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.getKegiatan = function() {
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
					swal('Information!', err.data, 'error');
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.validasi = function(param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'validasi',
			data: param,
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
				swal('Information!', err.data, 'error');
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.post = function(param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': undefined
			},
			data: param
		}).then(
			(response) => {
				service.Items = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'success');
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function(param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal('Information!', err.data, 'success');
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}
