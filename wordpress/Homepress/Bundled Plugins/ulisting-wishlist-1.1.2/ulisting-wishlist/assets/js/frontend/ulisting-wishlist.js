
if(typeof ulisting_wishlist_url == undefined)
	ulisting_wishlist_url = "";

function ulisting_wishlist_check_object (){
	var ids = [];
	jQuery(".ulisting-listing-wishlist").each(function(){
		if( !jQuery(this).hasClass('ulisting_wishlist_check') && jQuery(this).data('wishlist_id') != undefined ){
			ids.push(jQuery(this).data('wishlist_id'))
			jQuery(this).addClass('ulisting_wishlist_check')
		}

	});

	if(!ids.length)
		return;

	jQuery.ajax({
		url: ulisting_wishlist_url+"/wp-admin/admin-ajax.php",
		method:"GET",
		data: {
			action: "ulisting_wishlist_check_object",
			ids: ids.join()
		}
	}).done(function(data) {
		data.forEach(function(item) {
			jQuery("body").find("[data-wishlist_id='" + item + "']").addClass('active')
		})
	}).fail(function() {
	})
}

setInterval(function(){
	ulisting_wishlist_check_object();
}, 1000);

function ulisting_wishlist_get_count (){

	jQuery.ajax({
		url: ulisting_wishlist_url+"/wp-admin/admin-ajax.php",
		method:"GET",
		data: {
			action: "ulisting_wishlist_get_count_total"
		}
	}).done(function(data) {
		var total = 0;
		if(typeof data.wishlist_total != "undefined" && typeof data.search_total != "undefined"){
			jQuery(".ulisting-wishlist-total-count").html(data.wishlist_total);
			jQuery(".ulisting-saved-searches-total-count").html(data.search_total);
			total += data.wishlist_total
			total += data.search_total
			jQuery(".ulisting-wishlist-total-count-all").html(total);
		}
	}).fail(function() {
	})
}
ulisting_wishlist_get_count();

function ulisting_wishlist (object_id){
	var wishlist = jQuery(".ulisting_wishlist_"+object_id);
	var wishlist_load= jQuery(".ulisting_wishlist_load_"+object_id);
	wishlist.addClass("hidden");
	wishlist_load.removeClass("hidden");
	jQuery.ajax({
		url: ulisting_wishlist_url+"/wp-admin/admin-ajax.php",
		method:"POST",
		data: {
			action: "ulisting_wishlist_add",
			object_id: object_id,
		}
	}).done(function(data) {
		wishlist.removeClass("hidden");
		wishlist_load.addClass("hidden");
		if(data.success){
			jQuery(".ulisting-wishlist-total-count-all").html(data.total);
			jQuery(".ulisting-wishlist-total-count").html(data.wishlist_total);
			if(data.type == "add"){
				wishlist.addClass("active");
			}else{
				wishlist.removeClass("active");
				var ulisting_wishlist_item = jQuery("#ulisting-wishlist-item-"+object_id);
				var hidden_class = ulisting_wishlist_item.data("hidden-class");
				ulisting_wishlist_item.addClass(hidden_class);
			}
		}
	}).fail(function() {
		wishlist.removeClass("hidden");
		wishlist_load.addClass("hidden");
	})
}

/**
 *
 * @param key
 * @param url
 */
function wishlistRemoveParamUrl(key, url) {
	var rtn = url.split("?")[0],
		param,
		params_arr = [],
		queryString = (url.indexOf("?") !== -1) ? url.split("?")[1] : "";
	if (queryString !== "") {
		params_arr = queryString.split("&");
		for (var i = params_arr.length - 1; i >= 0; i -= 1) {
			param = params_arr[i].split("=")[0];
			if (param === key) {
				params_arr.splice(i, 1);
			}
		}
		rtn = rtn + "?" + params_arr.join("&");
	}
	return rtn;
}

/**
 *
 * @param $user_id
 * @param $listing_type_id
 */
function save_search(element, user_id, listing_type_id) {
	element = jQuery(element);
	if(element.hasClass('ulisting-save-search-load'))
		return;
	element.addClass("ulisting-save-search-load");
	var url = encodeURIComponent(removeParamUrl("current_page", wishlistRemoveParamUrl('layout', window.location.href)));
	var formData = new FormData();
	formData.append("user_id", user_id);
	formData.append("url", url);
	formData.append("listing_type_id", listing_type_id);
    formData.append("nonce", ulistingAjaxNonce);
	Vue.http.post("ulisting-save-search/save", formData).then(function(response){
		element.removeClass("ulisting-save-search-load");

		if(response.body.success){
			jQuery(".ulisting-wishlist-total-count-all").html(response.body.total);
			jQuery('.ulisting-saved-searches-total-count').html(response.body.saved_searches_total);
		}

		if(response.body.type == 'added')
			element.addClass("active");

		if(response.body.type == 'removed')
			element.removeClass("active");

		if(response.body.message) {
			if(response.body.success)
				toastr.success(response.body.message)
			else
				toastr.warning(response.body.message)
		}

	}).catch(error => {
		element.removeClass("ulisting-save-search-load");
	});
}

function check_saved_search(user_id, url, listing_type_id) {
	element = jQuery(".ulisting-save-search");
	var new_url = url;
	new_url = removeParamUrl("current_page", new_url);
	new_url = encodeURIComponent(new_url.substr(1));
	formData = new FormData();
	formData.append("user_id", user_id);
	formData.append("url", new_url);
	formData.append("listing_type_id", listing_type_id);
	formData.append("nonce", ulistingAjaxNonce);
	Vue.http.post("ulisting-saved-searches/check", formData).then(function(response){
		if(response.body.success)
			element.addClass("active");
		else
			element.removeClass("active");
	}).catch(error => {
		check_saved_search(user_id, url, listing_type_id)
	});
}

/**
 *
 * @param $user_id
 * @param $listing_type_id
 */
function delete_search(element, id) {
	element = jQuery(element);
	panel = jQuery('.ulisting-search-item-'+id);

	if(element.hasClass('ulisting-delete-search-load'))
		return;

	var  delete_confirm = confirm("Are you sure to remove the Search ?");

	if(!delete_confirm)
		return;

	element.addClass("ulisting-delete-search-load");

	var formData = new FormData();
	formData.append("id", id);
    formData.append("nonce", ulistingAjaxNonce);

	Vue.http.post("ulisting-save-search/delete", formData).then(function(response){
		element.removeClass("ulisting-delete-search-load");
		if(response.body.success){
			jQuery(".ulisting-wishlist-total-count-all").html(response.body.total);
			jQuery('.ulisting-saved-searches-total-count').html(response.body.saved_searches_total);
			panel.hide();
		}
	}).catch(error => {
		element.removeClass("ulisting-delete-search-load");
	});
}