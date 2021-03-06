
if(typeof ulisting_compare_url == undefined)
	ulisting_compare_url = "";

function ulisting_compare_check_object (){
	var ids = [];
	jQuery(".ulisting-listing-compare").each(function(){
		if( !jQuery(this).hasClass('ulisting_compare_check') && jQuery(this).data('compare_id') != undefined ){
			ids.push(jQuery(this).data('compare_id'))
			jQuery(this).addClass('ulisting_compare_check')
		}
	});

	if(!ids.length)
		return;

	jQuery.ajax({
		url: ulisting_compare_url+"/wp-admin/admin-ajax.php",
		method:"GET",
		data: {
			action: "ulisting_compare_check_object",
			ids: ids.join()
		}
	}).done(function(data) {
		data.forEach(function(item) {
			jQuery("body").find("[data-compare_id='" + item + "']").addClass('active')
		})
	}).fail(function() {
	})
}

setInterval(function(){
	ulisting_compare_check_object();
}, 1000);

function ulisting_compare_get_count (){

	jQuery.ajax({
		url: ulisting_compare_url+"/wp-admin/admin-ajax.php",
		method:"GET",
		data: {
			action: "ulisting_compare_get_count_total"
		}
	}).done(function(data) {
		let total = 0;
		let query = ".ulisting_listing_compare_count_total";
		let timer = setInterval(function () {
			if(typeof data.total != "undefined" && jQuery(query).html() !== undefined){
				jQuery(query).html(data.total);
				clearInterval(timer);
			}
		}, 1000)
	}).fail(function() {
	})
}

ulisting_compare_get_count();

function add_listing_compare (listing_id){
	var keys = 0;
	var ulisting_compare = Cookies.getJSON('ulisting_compare');
	if(typeof ulisting_compare != "undefined")
		keys = Object.keys(ulisting_compare);
	if(typeof ulisting_compare == "undefined" || keys.length == 0) {
		Cookies.set('ulisting_compare', { [listing_id]:listing_id });
		var ulisting_compare = Cookies.get('ulisting_compare');
		jQuery("#ulisting_listing_compare_"+listing_id).addClass('active')
	}else{
		if(typeof ulisting_compare[listing_id] != "undefined") {
			delete ulisting_compare[listing_id];
			Cookies.remove('ulisting_compare');
			Cookies.set('ulisting_compare', ulisting_compare);
			jQuery("#ulisting_listing_compare_"+listing_id).removeClass('active')
		} else {
			ulisting_compare[[listing_id]] = listing_id;
			Cookies.remove('ulisting_compare');
			Cookies.set('ulisting_compare', ulisting_compare);
			jQuery("#ulisting_listing_compare_"+listing_id).addClass('active')
		}
	}
	if(typeof ulisting_compare == "string")
		ulisting_compare = json_parse(ulisting_compare);
	keys = Object.keys(ulisting_compare);
	jQuery(".ulisting_listing_compare_count_total").text(keys.length);
}

function add_listing_compare_via_class (listing_id){
	uListingToggleActive(".ulisting_listing_compare_"+listing_id);
	var keys = 0, ulisting_compare = Cookies.getJSON('ulisting_compare');
	if(typeof ulisting_compare != "undefined")
		keys = Object.keys(ulisting_compare);
	if(typeof ulisting_compare == "undefined" || keys.length === 0) {
		Cookies.set('ulisting_compare', { [listing_id]:listing_id });
		var ulisting_compare = Cookies.get('ulisting_compare');
	}else{
		if(typeof ulisting_compare[listing_id] != "undefined") {
			delete ulisting_compare[listing_id];
			Cookies.remove('ulisting_compare');
			Cookies.set('ulisting_compare', ulisting_compare);
		} else {
			ulisting_compare[[listing_id]] = listing_id;
			Cookies.remove('ulisting_compare');
			Cookies.set('ulisting_compare', ulisting_compare);
		}
	}
	if(typeof ulisting_compare == "string")
		ulisting_compare = json_parse(ulisting_compare);
	keys = Object.keys(ulisting_compare);
	jQuery(".ulisting_listing_compare_count_total").text(keys.length);
}

function uListingToggleActive(query) {
	jQuery(query).each(function (item, value) {
		jQuery(value).toggleClass('active');
	});
}

function remove_listing_compare (listing_id){
	var ulisting_compare = Cookies.getJSON('ulisting_compare');
	if(typeof ulisting_compare[listing_id] != "undefined") {
		delete ulisting_compare[listing_id];
		Cookies.remove('ulisting_compare');
		Cookies.set('ulisting_compare', ulisting_compare);
		location.reload();
	}
}

