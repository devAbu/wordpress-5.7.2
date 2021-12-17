"use strict";

new VueW3CValid({
  el: '#stm-listing-login-demo'
});
new Vue({
  el: '#stm-listing-login-demo',
  data: {
    loading: false,
    login: 'demo',
    password: 'demo',
    message: null,
    remember: 0,
    status: '',
    errors: []
  },
  methods: {
    logIn: function logIn(event, type) {
      var vm = this;
      vm.loading = true;
      vm.message = null;
      var data = {
        'login': vm.login,
        'password': vm.password,
        'remember': vm.remember
      };

      if (type === 'demo') {
        data.login = 'demo';
        data.password = 'demo';
      } else if (type === 'agent') {
        data.login = 'demo_agency';
        data.password = 'demo_agency';
      }

      vm.errors = [];
      this.$http.post(currentAjaxUrl + '?action=stm_listing_login', data).then(function (response) {
        vm.loading = false;
        vm.message = response.body['message'];
        vm.status = response.body['status'];
        if (response.body['errors']) vm.errors = response.body['errors'];
        if (vm.status == 'success') location.reload();
      });
    }
  }
});