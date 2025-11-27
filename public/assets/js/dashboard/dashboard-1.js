(function ($) {
	"use strict"

	var dzChartlist = function () {

		var transaksiChart = function () {
			$.ajax({
				url: '/backend/dashboard',
				method: 'GET',
				dataType: 'json',
				success: function (data) {
					var options = {
						series: [{
							name: 'Jumlah Transaksi',
							data: data.jumlah_transaksi
						}, {
							name: 'Total Nominal',
							data: data.total_nominal
						}],
						chart: {
							height: 300,
							type: 'area',
							toolbar: {
								show: false
							}
						},
						colors: ["#FFAB2D", "#00ADA3"],
						dataLabels: { enabled: false },
						stroke: { curve: 'smooth', width: 3 },
						legend: { show: true, position: 'top' },
						grid: { show: true, strokeDashArray: 6, borderColor: '#dadada' },
						yaxis: [{
							title: { text: 'Jumlah Transaksi', style: { color: '#FFAB2D', fontSize: '12px' } },
							labels: { style: { colors: '#B5B5C3', fontSize: '12px' } }
						}, {
							opposite: true,
							title: { text: 'Total Nominal', style: { color: '#00ADA3', fontSize: '12px' } },
							labels: {
								style: { colors: '#B5B5C3', fontSize: '12px' },
								formatter: function (value) {
									return new Intl.NumberFormat("id-ID", {
										minimumFractionDigits: 0,
										maximumFractionDigits: 0,
										style: "currency",
										currency: "IDR"
									}).format(value);
								}
							}
						}],
						xaxis: {
							categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
							labels: { style: { colors: '#B5B5C3', fontSize: '12px' } }
						},
						fill: { type: 'solid', opacity: 0.1 },
						tooltip: { shared: true, intersect: false }
					};

					var chart = new ApexCharts(document.querySelector("#transaksiChart"), options);
					chart.render();
				},
				error: function (xhr, status, error) {
					console.error("Error AJAX:", status, error);
				}
			});
		}

		return {
			init: function () { },
			load: function () { transaksiChart(); },
			resize: function () { }
		}

	}();

	jQuery(window).on('load', function () {
		setTimeout(function () {
			dzChartlist.load();
		}, 500);
	});

})(jQuery);
