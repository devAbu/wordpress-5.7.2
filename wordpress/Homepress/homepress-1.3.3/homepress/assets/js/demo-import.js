new Vue({
	el:"#homepress-demo-import",
	data:{
		install_info:{
			image:"",
			message:""
		},
		token:null,
		install_load:false,
		privacy_policy:true,
		website:null,
		install_end:false,
		progress_step:0,
		progress:0,
		preloader:false,
		ajax_url:null,
		url_template:null,
		api_url:"https://homepress.stylemixthemes.com/homepress-demo-server/index.php",
		active_step:"home_page",
		step:[
			{
				id:"home_page",
				title:"Home Page"
			},
			{
				id:"inventory",
				title:"Inventory Layouts"
			},
			{
				id:"single_page",
				title:"Single Inventory Layouts"
			},
			{
				id:"install",
				title:"Installation"
			}
		],
		home_page:[],
		plugins:[],
		inventory:[],
		single_page:[],
		listing_item_grid:[],
		listing_item_list:[],
		listing_item_map:[],
		install:[],
		install_data:{
			home_page:null,
			inventory:null,
			single_page:null,
			listing_item_grid:null,
			listing_item_list:null,
			listing_item_map:null,
		},
		install_progress_step:{
			step: "install_plugins",
			progress: null,
		}
	},
	created(){
		if(typeof homepress_demo_import_data == "undefined")
			return;

		if(typeof homepress_demo_import_data.url_template != "undefined")
			this.url_template = homepress_demo_import_data.url_template;

		if(typeof homepress_demo_import_data.ajax_url != "undefined")
			this.ajax_url = homepress_demo_import_data.ajax_url;

		if(typeof homepress_demo_import_data.install_end != "undefined")
			this.install_end = homepress_demo_import_data.install_end;

		if(typeof homepress_demo_import_data.token != "undefined")
			this.token = homepress_demo_import_data.token;

		if(typeof homepress_demo_import_data.website != "undefined")
			this.website = homepress_demo_import_data.website;

		this.step_init();
	},
	methods:{
		get_home_pages: function(){
			var vm = this;
			vm.preloader = true;

			this.$http.post(vm.ajax_url + '?action=stm_theme_page_list').then(function(response){
				vm.preloader = false;
				if(response.body.success){
					vm.home_page = response.body.data;
					vm.install_data.home_page = vm.home_page[0].id;
				}
			})
		},
		get_plugins: function(){
			var vm = this;
			vm.preloader = true;
			this.$http.post(vm.ajax_url + '?action=stm_theme_plugins_list').then(function(response){
				vm.preloader = false;
				if(typeof response.body.success != "undefined" && response.body.success){
					vm.plugins = response.body.data;
					var length = vm.plugins.length + 12;
					vm.progress_step = 100 / length
				}
			})
		},
		get_inventory_pages: function(){
			var vm = this;
			vm.preloader = true;
			var formData = new FormData();
			formData.append('action', "stm_theme_inventory_list");
			this.$http.post(vm.ajax_url + '?action=stm_theme_inventory_list', formData).then(function(response){
				vm.preloader = false;
				if(response.body.success){
					vm.inventory = response.body.data;
					vm.install_data.inventory = vm.inventory[0].id;
				}
			});
		},
		get_single_pages: function(){
			var vm = this;
			vm.preloader = true;
			var formData = new FormData();
			formData.append('action', "stm_theme_single_page_list");
			this.$http.post(vm.ajax_url + '?action=stm_theme_single_page_list', formData).then(function(response){
				vm.preloader = false;
				if(response.body.success){
					vm.single_page = response.body.data;
					vm.install_data.single_page = vm.single_page[0];
				}
			});
		},
		step_check_active: function(step){

			var step_index = null;
			var active_index = null;
			var array_length = this.step.length;

			for (var i = 0 ; i < array_length ; i++) {
				if (this.step[i].id === step)
					step_index = i;
			}

			for (var i = 0 ; i < array_length ; i++) {
				if (this.step[i].id === this.active_step)
					active_index = i;
			}

			if(active_index >= step_index)
				return true;

			return false;
		},
		get_key : function(array, key, type) {
			var array_length = array.length;
			for (var i = 0 ; i < array_length ; i++){
				if (type == "next" && array[i].id === key)
					return array[i+1].id;

				if (type == "previous" && array[i].id === key)
					return array[i-1].id;
			}
			return false;

		},
		privacy_policy_is_view(){
			if(this.active_step == "home_page")
				return true;
			return false;
		},
		previous_is_view: function(){
			if(this.active_step != "home_page")
				return true;
			return false;
		},
		next_is_view: function(){
			if(this.active_step == "single_page")
				return false;

			if(this.active_step == "install")
				return false;

			return true;
		},
		install_is_view: function(){
			if(this.active_step == "single_page")
				return true;
			return false;
		},
		step_init: function(){

			if(this.active_step == "home_page"){
				if(this.home_page.length == 0)
					this.get_home_pages();

				if(this.plugins.length == 0)
					this.get_plugins();
			}

			if(this.active_step == "inventory" && this.inventory.length == 0){
				this.get_inventory_pages()
			}

			if(this.active_step == "single_page" && this.single_page.length == 0){
				this.get_single_pages()
			}
		},
		previous: function(){
			var previous_key = this.get_key(this.step, this.active_step, "previous");
			if(previous_key)
				this.active_step = previous_key

			this.step_init()
		},
		next: function(){
			var next_key = this.get_key(this.step, this.active_step, "next");
			if(next_key)
				this.active_step = next_key
			this.step_init();
		},

		/* -----------------------  Start install ----------------------- */
		start_install: function(){
			this.next();
			this.install_load = true;
			this.install_next();
		},

		/* -----------------------  END install ----------------------- */
		end_install: function(){
			if(this.privacy_policy)
				this.send_analytics();
			document.title = "Installation & Demo Import finished successfully!";
			this.install_end = true;
		},

		/* ----------------------- install next function run----------------------- */
		install_next: function(){
			var vm = this;
			var load = "";
			for (var i = 0; i < 10; i++){
				if( i * 10 >= vm.progress.toFixed(0))
					load += "-";
				else
					load += "=";
			}

			document.title = load +" "+ vm.progress.toFixed(0)+"% ";

			if(vm.install_progress_step.step == "install_plugins") {
				setTimeout(function(){
					vm.install_plugins();
				},1000);
			}

			if(vm.install_progress_step.step == "install_widget") {
				setTimeout(function(){
					vm.install_widget();
				},1000);
			}

			if(vm.install_progress_step.step == "install_home_page") {
				setTimeout(function(){
					vm.install_home_page();
				},1000);
			}

			if(vm.install_progress_step.step == "install_inventory_page") {
				setTimeout(function(){
					vm.install_inventory_page();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing_category") {
				setTimeout(function(){
					vm.install_listing_category();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing_region") {
				setTimeout(function(){
					vm.install_listing_region();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing_attribute") {
				setTimeout(function(){
					vm.install_listing_attribute();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing_type") {
				setTimeout(function(){
					vm.install_listing_type();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing_type_inventory_page") {
				setTimeout(function(){
					vm.install_listing_type_inventory_page();
				},1000);
			}

			if(vm.install_progress_step.step == "install_single_page") {
				setTimeout(function(){
					vm.install_single_page();
				},1000);
			}

			if(vm.install_progress_step.step == "install_item_grid") {
				setTimeout(function(){
					vm.install_item_grid();
				},1000);
			}

			if(vm.install_progress_step.step == "install_item_list") {
				setTimeout(function(){
					vm.install_item_list();
				},1000);
			}

			if(vm.install_progress_step.step == "install_item_map") {
				setTimeout(function(){
					vm.install_item_map();
				},1000);
			}

			if(vm.install_progress_step.step == "install_listing") {
				setTimeout(function(){
					vm.install_listing();
				},1000);
			}

			if(vm.install_progress_step.step == "install_setting_pages") {
				setTimeout(function(){
					vm.install_setting_pages();
				},1000);
			}

			if(vm.install_progress_step.step === "install_default_settings") {
				setTimeout(function(){
					vm.install_default_settings();
				},1000);
			}
		},

		/* -----------------------  1 install plugins ----------------------- */
		install_plugins: function(reinstall){
			var vm = this;
			var plugin = null;
			var length = vm.plugins.length - 1;

			if(vm.install_progress_step.progress != null){
				for(var i = 0; i < vm.plugins.length; i++ ) {
					if(vm.plugins[i].id == vm.install_progress_step.progress) {
						if(i == length){
							vm.install_progress_step.step = "install_widget"
							vm.install_progress_step.progress = null;
							vm.install_next();
							break;
						}
						plugin = vm.plugins[i+1];
						break;
					}
				}
			}else
				plugin = vm.plugins[0];

			if(plugin){
				vm.install_info.image = plugin.image
				vm.install_info.message = "Install plugin "+plugin.name

				if(!reinstall)
					vm.install_progress_step.progress = plugin.id;

				var formData = new FormData();
				formData.append('plugin_slug', plugin.id);
				this.$http.post(vm.ajax_url + '?action=stm_theme_plugins_install', formData).then(function(response){
					if(typeof response.body.success != "undefined" && response.body.success){
						vm.progress += vm.progress_step;
						vm.install_next();
					}else{
						setTimeout(function() {
							vm.install_plugins(true);
						}, 1000)
					}
				}).catch(error => {
					setTimeout(function() {
						vm.install_plugins(true);
					}, 1000)
				});
			}
		},

		/* ----------------------- 2 install widget----------------------- */
		install_widget: function(){
			var vm = this;

			vm.install_info.image = vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Widgets";
			this.$http.post(vm.ajax_url + '?action=stm_install_widgets').then(function(response){
				if(response.body.success){
					vm.progress += vm.progress_step;
					vm.install_progress_step.step = "install_home_page";
					vm.install_next();
				}
			});

		},

		/* ----------------------- 3 install home page----------------------- */
		install_home_page: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.home_page.length; i++ ) {
				if(vm.home_page[i].id == vm.install_data.home_page)
					page = vm.home_page[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Home page " + page.name;

			var formData = new FormData();
			formData.append('page_id', page.id);
			this.$http.post(vm.ajax_url + '?action=stm_install_home_page', formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_inventory_page";
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 4 install inventory page ----------------------- */
		install_inventory_page: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Inventory pages";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_inventory_pages');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing_attribute"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 5 install listing type ----------------------- */
		install_listing_attribute: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Listing attribute";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_attribute');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing_type"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 6 install listing type ----------------------- */
		install_listing_type: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Listing type";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing_category"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 7 install listing category ----------------------- */
		install_listing_category: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Listing categories";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_categories');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing_region"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 8 install listing region ----------------------- */
		install_listing_region: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Listing region";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_regions');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing_type_inventory_page"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 9 install listing type inventory page----------------------- */
		install_listing_type_inventory_page: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.inventory.length; i++ ) {
				if(vm.inventory[i].id == vm.install_data.inventory)
					page = vm.inventory[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Listing type inventory page " + page.name;

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type_inventory_page');
			formData.append('inventory_id', vm.install_data.inventory);
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_single_page"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 10 install single page ----------------------- */
		install_single_page: function(){
			var vm = this;
			vm.progress += vm.progress_step;
			var page = null;
			for(var i = 0; i < vm.single_page.length; i++ ) {
				if(vm.single_page[i].id == vm.install_data.single_page.id)
					page = vm.single_page[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Listing single page " + page.name;

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type_single_page');
			formData.append('single_layout', vm.install_data.single_page.name);
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 11 install item grid ----------------------- */
		//--------------- Delete
		install_item_grid: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.listing_item_grid.length; i++ ) {
				if(vm.listing_item_grid[i].id == vm.install_data.listing_item_grid)
					page = vm.listing_item_grid[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Listing item grid " + page.name;

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type_item_grid');
			formData.append('grid_id', vm.install_data.listing_item_grid);
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_item_list"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 12 install item list ----------------------- */
		//--------------- Delete
		install_item_list: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.listing_item_list.length; i++ ) {
				if(vm.listing_item_list[i].id == vm.install_data.listing_item_list)
					page = vm.listing_item_list[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Listing item list " + page.name;

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type_item_list');
			formData.append('list_id', vm.install_data.listing_item_list);
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_item_map"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 13 install item map ----------------------- */
		//--------------- Delete
		install_item_map: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.listing_item_map.length; i++ ) {
				if(vm.listing_item_map[i].id == vm.install_data.listing_item_map)
					page = vm.listing_item_map[i];
			}
			vm.install_info.image = page.image;
			vm.install_info.message = "Install Listing item map " + page.name;

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing_type_item_map');
			formData.append('map_id', vm.install_data.listing_item_map);
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_listing"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 15 install listing ----------------------- */
		install_listing: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install Listing";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_listing');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_setting_pages"
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		/* ----------------------- 16 install setting pages ----------------------- */
		install_setting_pages: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install setting pages";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_setting_pages');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.install_progress_step.step = "install_default_settings";
					vm.progress += vm.progress_step;
					vm.install_next();
				}
			});
		},

		install_default_settings: function(){
			var vm = this;
			vm.install_info.image =  vm.url_template+"/assets/images/code.gif";
			vm.install_info.message = "Install default settings";

			var formData = new FormData();
			formData.append('action', 'ulisting_demo_import_currency_settings');
			this.$http.post(vm.ajax_url, formData).then(function(response){
				if(response.body.success){
					vm.progress = 100;
					setTimeout(function(){
						vm.end_install()
					},2000);
				}
			});
		},

		send_analytics: function(){
			var vm = this;
			var page = null;
			for(var i = 0; i < vm.home_page.length; i++ ) {
				if(vm.home_page[i].id == vm.install_data.home_page)
					page = vm.home_page[i];
			}
			var vm = this;
			var data = {
				theme: 'homepress',
				layout: page.id,
				website: vm.website,
				token: vm.token,
			}
			this.$http.post("https://panel.stylemixthemes.com/api/active", data).then(function(response){

			});
		},

	}

});