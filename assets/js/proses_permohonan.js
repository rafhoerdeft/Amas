var protocol = window.location.protocol;
var host = window.location.hostname;

function teruskanPermohonan() {
	var id = $("#proses_permohonan #id_pemohon").val();
	if (id != "") {
		$.post(
			protocol + "//" + host + "/aset_ti/Admin/prosesPemohon",
			{ id_pemohon: id },
			function (result) {
				console.log(result);
				var idn = result;
				window.location.href =
					protocol + "//" + host + "/satpol/Admin/cetakSuratDinkes/" + idn;
				location.reload();
			}
		);
	}
}
