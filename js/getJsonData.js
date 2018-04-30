// JavaScript Document
$(document).ready(function(){

	 //AJAX service request to get the main text data from the json data store
	 $.getJSON('../model/data.json', function(jsonObj) {

		// Get Space Shuttle data from backend.
		const spaceshuttleJson = jsonObj.modelTextData.spaceshuttle;
		$('#spaceshuttle_title').html('<h4>' + spaceshuttleJson.title + '<h4>');
		$('#spaceshuttle_description').html('<p>' + spaceshuttleJson.description + '<p>');
		$('#spaceshuttle_link').html('<a href="' + spaceshuttleJson.link + '" class="btn btn-info">More Info</a>');
	 });
});
