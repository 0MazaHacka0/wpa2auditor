"use strict";

var dictsPageURL = "?dicts";

//Configuration
var dictsBaseUrl = "content/dicts.php";
var dictsPrefix = "?ajax=";
var dictsTableUrl = dictsBaseUrl + dictsPrefix + "table";
var dictsPaggerUrl = dictsBaseUrl + dictsPrefix + "pagger";

//Status of dict upload
var dictsStatusOfDictURL = dictsBaseUrl + dictsPrefix + "statusDictUpload";

//Forms IDs
var dictsFormUploadID = "formUploadDictionary";

//Table
var dictsAjaxTableDivID = "#ajaxTableDiv";
var dictsAjaxTableID = "#taskTable";

var dictsAjaxPaggerDivID = "#ajaxPagger";

var dictsFile;

class Dictionary {

	//Load\reload table
	static loadTable() {
		$.get(dictsTableUrl, function (data) {
			Dictionary.drawTable(data);
		}, "json");
	}

	//Draw table
	static drawTable(data) {

		//Is user admin?
		var admin = data.admin;

		//Draw start of table
		$(dictsAjaxTableDivID).html(

			'<div class="panel panel-default">' +
			'<table class="table table-striped table-bordered table-nonfluid " id="taskTable">' +
			'<tbody>' +
			'<tr>' +
			'<th>#</th>' +
			'<th>Name</th>' +
			'<th>Size</th>' +
			'<th>Download</th>' +
			(admin ? "<th>Admin</th>" : "") +
			'</tr>'

		);

		//Draw table
		data.table.forEach(function (element, index, array) {

			$(dictsAjaxTableID + " > tbody:last-child").append('<tr><td><strong>' + (index + 1) + '</strong></td><td><strong>' + element.dict_name + '</strong></td><td>' + Dictionary.getHumSize(element.size) + '</td><td><a href="' + element.site_path + '" class="btn btn-default">DOWNLOAD</a></td>' +
				(admin ? '<td><form action="" method="get" onSubmit="Dictionary.ajaxDeleteDictionary(this);"><input type="hidden" name="deleteDictID" value="' + element.id + '"><button type="submit" class="btn btn-secondary" name="deleteTask"><i class="fa fa-trash-o"></i></button></form></td>' : '') + '</tr>');
		});

		//Draw end of table
		$(dictsAjaxTableDivID).append(

			'</tbody>' +
			'</table>' +
			'</div>'

		);
	}

	//Get human-friendly size in MB, GB and etc instead of bytes
	static getHumSize(size) {
		//get size in bytes

		var sizes = [
			'k', 'M', 'G', 'T'
		];

		var i = -1;
		while (size > 100) {
			size /= 1024;
			i++;
		}
		return size.toFixed(2) + " " + sizes[i] + "B";
	}

	//Load pagination
	static loadPagger() {
		$.get(dictsPaggerUrl, function (data) {
			Dictionary.drawPagger(data);
		}, "json");
	}

	static ajaxGetPage(page) {

		//Cancel submit form to server via POST wtih page reload
		event.preventDefault();

		//Send via post showOnlyMyNetworks flag and get new table
		$.get(dictsTableUrl, {
			"page": page,
		}, function (data) {
			Dictionary.drawTable(data);
			Dictionary.colorStatus();
		}, "json");
	}

	static drawPagger(data) {
		var result = '<nav aria-label="Page navigation"><ul class="pagination">';

		data.forEach(function (element, index, array) {
			var arrow;
			if (index !== 0) {
				arrow = "&raquo;";
			} else {
				arrow = "&laquo;";
			}

			if (element.arrow === true) {

				if (element.active === true) {
					result += '<li class="page-item"><a class="page-link disabled" onClick="ajaxGetPage(' + element.page + ');" aria-label="Previous"><span aria-hidden="true">' + arrow + '</span><span class="sr-only">Previous</span></a></li>';
				} else {
					result += '<li class="page-item"><a class="page-link" onClick="ajaxGetPage(' + element.page + ');" aria-label="Previous"><span aria-hidden="true">' + arrow + '</span><span class="sr-only">Previous</span></a></li>';
				}

			} else {

				if (element.active === true) {
					result += '<li class="page-item"><a class="page-link disabled" onClick="ajaxGetPage(' + element.page + ');">' + element.page + '</a></li>';
				} else {
					result += '<li class="page-item"><a class="page-link" onClick="ajaxGetPage(' + element.page + ');">' + element.page + '</a></li>';
				}
			}
		});

		result += '</ul></nav>';
		$(dictsAjaxPaggerDivID).html(result);
	}

	//Delete_task button
	static ajaxDeleteDictionary(vard) {

		//Cancel submit form to server via POST wtih page reload
		event.preventDefault();

		//Get id task for delete from form
		var id = vard.elements.deleteDictID.value;

		//Data to send
		var data = new FormData();
		data.append("deleteDictionary", true);
		data.append("deleteDictID", id);

		jQuery.ajax({
			url: dictsBaseUrl, //page url
			type: "POST",
			data: data,
			processData: false, // Dont process the tasksFile
			contentType: false, // string requset
			success: function () { //Data send success
				Dictionary.loadTable();
			},
			error: function () { // Data send failed
				console.log("Delete task error while sending via POST");
			}
		});
	}

	//Upload dict
	static ajaxUploadDict(vard) {

		//Cancel submit form to server via POST wtih page reload
		event.preventDefault();

		//Data to send
		var data = new FormData();
		var result_form;
		var url;

		dictsFile = vard.elements.upfile.files[0];

		//File
		data.append("upfile", dictsFile);
		data.append("buttonUploadDict", true);

		//Dict name that user enter
		data.append("dict_name", vard.elements.dict_name.value);

		url = dictsStatusOfDictURL;
		result_form = dictsFormUploadID;

		jQuery.ajax({
			url: url, //page url
			type: "POST",
			data: data,
			processData: false, // Dont process the tasksFile
			contentType: false, // string requset

			//On success upload
			success: function (response) {

				//Reset all inputs
				$("#" + result_form).get(0).reset();

				//Reload table
				Dictionary.loadTable();

				//generate notify
				var json = $.parseJSON(response);
				Dictionary.genNotify(json.type, json.message);

			},
			//Failed to send data
			error: function (response) {
				console.log("Error while sending hash\handshake. " + response);
			}
		});

	}

	static genNotify(type, message) {
		$.notify({
			// options
			icon: 'fa fa-exclamation-triangle',
			message: message,
		}, {
			// settings
			type: type,
			newest_on_top: false,
			placement: {
				from: "bottom",
				align: "right"
			},
			mouse_over: "pause",
		});
	}
}

//After page fully loaded
$(function () {

	if (document.URL.indexOf(dictsPageURL) > -1) {

		//Load and draw table
		Dictionary.loadTable();

		//Draw pagger
		Dictionary.loadPagger();

	}
});
