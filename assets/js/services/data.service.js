angular
	.module('data.service', ['helper.service'])
	.factory('ProfileService', ProfileService)
	.factory('SkpdService', SkpdService)
	.factory('RencanaBiayaService', RencanaBiayaService)
	.factory('PegawaiService', PegawaiService)
	.factory('RwService', RwService)
	.factory('RtService', RtService)
	.factory('AnggaranBiayaService', AnggaranBiayaService)
	.factory('RencanaKerjaService', RencanaKerjaService)
	.factory('periodeService', periodeService)
	.factory('HomeService', HomeService)
	.factory('DetailRencanaKerjaService', DetailRencanaKerjaService)
	.factory('BidangService', BidangService)
	.factory('KegiatanService', KegiatanService)
	.factory('LaporanService', LaporanService);

function ProfileService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/profile/';
	var service = {
		Items: []
	};

	service.get = function () {
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
	service.post = function (param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				service.Items = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function SkpdService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/skpd/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
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
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function RencanaBiayaService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/rencanabiaya/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
					var data = service.Items.find((x) => x.idRencanaBiaya == param.idRencanaBiaya);
					if (data) {
						data.NamaRencanaBiaya = param.NamaRencanaBiaya;
					}
				} else {
					service.Items.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idRencanaBiaya == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function PegawaiService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/pegawai/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				if (param.idpegawai) {
					var data = service.Items.find((x) => x.idpegawai == param.idpegawai);
					if (data) {
						data.nama = param.nama;
						data.kontak = param.kontak;
						data.alamat = param.alamat;
						data.jabatan = param.jabatan;
						data.email = param.email;
					}
				} else {
					service.Items.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idpegawai == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function RwService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/rw/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				if (param.idrw) {
					var data = service.Items.find((x) => x.idrw == param.idrw);
					if (data) {
						data.nowr = param.nowr;
						data.pejabatrw = param.pejabatrw;
						data.email = param.email;
					}
				} else {
					service.Items.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idrw == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function RtService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/rt/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata/' + id,
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				if (param.idrt) {
					var data = service.Items.rt.find((x) => x.idrt == param.idrt);
					if (data) {
						data.nort = param.nort;
						data.pejabatrt = param.pejabatrt;
						data.email = param.email;
					}
				} else {
					service.Items.rt.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.postjalan = function (param) {
		var def = $q.defer();
		$http({
			method: 'Post',
			url: url + 'simpanjalan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				if (param.idjalan) {
					var data = service.Items.rt.find((x) => x.idrt == param.idrt);
					var jalan = data.jalan.find(x => x.idjalan == param.idjalan);
					if (jalan) {
						jalan.jalan = param.jalan;
					}
				} else {
					var data = service.Items.rt.find((x) => x.idrt == param.idrt);
					data.jalan.push(response.data)
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idrw == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function periodeService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/periode/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				if (param.idPeriodeRenker) {
					var data = service.Items.find((x) => x.idPeriodeRenker == param.idPeriodeRenker);
					if (data) {
						if (data.Status != 'Aktif') {
							angular.forEach(service.Items, item => {
								if (item.idPeriodeRenker != param.idPeriodeRenker)
									item.Status = 'Tidak Aktif';
							})
						}
						data.Tahun = param.Tahun;
						data.Status = param.Status;
					}
				} else {
					angular.forEach(service.Items, item => {
						item.Status = 'Tidak Aktif';
					})
					service.Items.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idPeriodeRenker == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function AnggaranBiayaService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/anggaranbiaya/';
	var service = { Items: [] };

	service.get = function () {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdata/' + id,
				headers: {
					'Content-Type': 'application/json'
				},
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

	service.post = function (param) {
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
				if (param.iddetailrencanabiaya) {
					var data = service.Items.detailrencanabiaya.find((x) => x.iddetailrencanabiaya == param.iddetailrencanabiaya);
					data.nominal = param.nominal;
				} else {
					service.Items.detailrencanabiaya.push(response.data);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'Delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			},
		}).then(
			(response) => {
				var data = service.Items.find((x) => x.idPeriodeRenker == id);
				if (data) {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
					def.resolve(true);
				}
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}

function RencanaKerjaService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/rencanakerja/';
	var service = {
		Items: []
	};

	service.get = function () {
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
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
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
				method: 'GET',
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

	service.validasi = function (param) {
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
				var data = service.Items.find(x => x.idRencanaKerja == param.idRencanaKerja);
				if (data) {
					data.status = param.setstatus;
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.post = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function DetailRencanaKerjaService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/rencanakerja/';
	var service = {
		Items: []
	};

	service.get = function (id) {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdatadetail/' + id,
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

	service.validasi = function (param) {
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
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.post = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function HomeService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/home/';
	var service = {
		Items: []
	};

	service.get = function (id) {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'Get',
				url: url + 'getdatadetail/' + id,
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

	service.validasi = function (param) {
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
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.post = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	service.upload = function (param) {
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
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function BidangService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/bidang/';
	var service = {
		Items: []
	};

	service.get = function (id) {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
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
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.post = function (param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				if (param.idbidang) {
					var data = service.Items.find((x) => x.idbidang == param.idbidang);
					if (data) {
						data.KodeBidang = param.KodeBidang;
						data.NamaBidang = param.NamaBidang;
					}
				} else {
					service.Items = response.data;
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function KegiatanService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/kegiatan/';
	var service = {
		Items: []
	};

	service.get = function (id) {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
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
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.post = function (param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				if (param.idbidang) {
					var data = service.Items.find((x) => x.idbidang == param.idbidang);
					if (data) {
						data.KodeBidang = param.KodeBidang;
						data.NamaBidang = param.NamaBidang;
					}
				} else {
					service.Items = response.data;
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}

function LaporanService($http, $q, helperServices) {
	var url = helperServices.url + '/musrembang/admin/laporan/';
	var service = {
		Items: []
	};

	service.get = function () {
		var def = $q.defer();
		id = helperServices.absUrl.split('/');
		id = id[id.length - 1];
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
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};

	service.getLaporan = function (id) {
		var def = $q.defer();
		$http({
			method: 'Get',
			url: url + 'getprint/'+id,
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

	service.post = function (param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				if (param.idbidang) {
					var data = service.Items.find((x) => x.idbidang == param.idbidang);
					if (data) {
						data.KodeBidang = param.KodeBidang;
						data.NamaBidang = param.NamaBidang;
					}
				} else {
					service.Items = response.data;
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}