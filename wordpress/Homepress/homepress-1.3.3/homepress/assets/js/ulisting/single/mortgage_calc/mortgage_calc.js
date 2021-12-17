"use strict";

(function ($) {
  $(document).ready(function (event) {
    $("a[href='#mortgage_calc']").on('click', function () {
      event.preventDefault();
      $('html, body').animate({
        scrollTop: $("#mortgage_calc").offset().top
      }, 800);
    });
    $(".elementor_calc .show_calc").on('click', function () {
      $(this).parents().find('.calc_box').addClass('active');
      $(this).parents().find('.calc_box').animate({
        opacity: 1
      }, 300);
      $('#mortgage_calc').animate({
        opacity: 1,
        marginTop: 10
      }, 300);
    });
    $('#mortgage_calc .calc-close-button').on('click', function () {
      $(this).parents().find(".calc_box").removeClass('active');
      $(this).parents().find('.calc_box').animate({
        opacity: 0
      }, 300);
      $('#mortgage_calc').animate({
        opacity: 0,
        marginTop: 110
      }, 300);
    });
  });
})(jQuery);

function formatAsCurrency(value, dec, currency, settings) {
  dec = dec || 0;
  currency = currency || '$';
  var val = value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  return getPosition(val, currency, settings);
}

function getPosition(value, currency, settings) {
  var replacement = '[left_space][left]' + value + '[right][right_space]';
  var position = settings && settings.hasOwnProperty('position') ? settings.position : 'left';
  return replaceNeedle(replacement, position, currency);
}

function replaceNeedle(replacement, position, currency) {
  var replaceArr = ['left', 'right', 'left_space', 'right_space'];

  for (var i = 0; i < replaceArr.length; i++) {
    var temp = '[' + replaceArr[i] + ']';

    if (replaceArr[i] === position) {
      if (position === 'right_space') {
        replacement = replacement.replace(temp, ' ' + currency);
      } else if (position === 'left_space') {
        replacement = replacement.replace(temp, currency + ' ');
      } else {
        replacement = replacement.replace(temp, currency);
      }
    } else {
      replacement = replacement.replace(temp, '');
    }
  }

  return replacement;
}

Vue.component('calc_field', {
  template: '#calc_field',
  props: {
    settings: {
      "default": {}
    },
    value: {
      type: Number,
      "default": 0
    },
    min: {
      type: Number,
      "default": 0
    },
    max: {
      type: Number,
      "default": 100000000
    },
    step: {
      type: Number,
      "default": 10000
    },
    decimals: {
      type: Number,
      "default": 0
    },
    type: {
      "default": 'currency'
    },
    currency: {
      "default": '$'
    }
  },
  data: function data() {
    return {
      active: false
    };
  },
  computed: {
    val: function val() {
      if (this.type === 'currency') {
        return Number(this.value) + '';
      } else if (this.type === 'years') {
        return Number(this.value) + '';
      } else if (this.type === 'percent') {
        return Number(this.value * 100).toFixed(3);
      }
    },
    formatted: function formatted() {
      if (this.type === 'currency') {
        return formatAsCurrency(this.value, 0, this.currency, this.settings);
      } else if (this.type === 'years') {
        return Number(this.value + "".replace(/[0-9]+/, "")) + ' Years';
      } else if (this.type === 'percent') {
        return (this.value * 100).toFixed(this.decimals) + '%';
      }
    }
  },
  methods: {
    increment: function increment(e) {
      if (e.shiftKey) {
        this.value += 10 * this.step;
      } else {
        this.value += this.step;
      }

      if (this.value > this.max) {
        this.value = this.max;
      }

      this.changed();
    },
    decrement: function decrement(e) {
      if (e.shiftKey) {
        this.value -= 10 * this.step;
      } else {
        this.value -= this.step;
      }

      if (this.value < this.min) {
        this.value = this.min;
      }

      this.changed();
    },
    update: function update() {
      this.active = false;
      var tempVal = this.$el.value + '';
      this.value = Number(tempVal.replace(/[^0-9\.]+/g, ""));
      if (this.type === 'percent') this.value /= 100;
      this.changed();
    },
    changed: function changed() {
      this.$emit('input', Number(this.value));
    }
  }
});
new Vue({
  el: '#mortgage_calc',
  data: {
    homeValue: 350000,
    downpayment: 0,
    interestRate: 0.025,
    amortization: 25,
    settings: {
      position: 'left',
      thousands_separator: ",",
      decimal_separator: ".",
      characters_after: "2"
    },
    paymentPeriod: {
      'Monthly': {
        npy: 12
      },
      'Semi-Monthly': {
        npy: 12 * 2
      },
      'Bi-Weekly': {
        npy: 365.25 / 7 / 2
      },
      'Weekly': {
        npy: 365.25 / 7
      }
    },
    paymentSelection: mortgage_calc_data.period.Monthly ? mortgage_calc_data.period.Monthly : 'Monthly',
    graphSelection: null
  },
  created: function created() {
    if (typeof mortgage_calc_data.period !== "undefined") {
      var period = mortgage_calc_data.period;

      for (var old_key in period) {
        var new_key = period[old_key];

        if (old_key !== new_key) {
          Object.defineProperty(this.paymentPeriod, new_key, Object.getOwnPropertyDescriptor(this.paymentPeriod, old_key));
          delete this.paymentPeriod[old_key];
        }
      }
    }

    if (typeof mortgage_calc_data == "undefined") return;
    if (typeof mortgage_calc_data.price != "undefined") this.homeValue = mortgage_calc_data.price;
    if (typeof mortgage_calc_data.period != "undefined") this.period = mortgage_calc_data.period;

    if (typeof mortgage_calc_data.settings === 'string') {
      String.prototype.replaceAll = function (search, replace) {
        return this.split(search).join(replace);
      };

      mortgage_calc_data.settings = mortgage_calc_data.settings.replaceAll(/&quot;/g, '"');
      this.settings = JSON.parse(mortgage_calc_data.settings);
    }
  },
  computed: {
    principal: function principal() {
      return this.homeValue - this.downpayment;
    },
    numPayments: function numPayments() {
      return this.amortization * this.numPaymentsPerYear;
    },
    numPaymentsPerYear: function numPaymentsPerYear() {
      return this.paymentPeriod[this.paymentSelection].npy;
    },
    interestPerPayment: function interestPerPayment() {
      return this.interestRate / this.numPaymentsPerYear;
    },
    payment: function payment() {
      var temp = Math.pow(1 + this.interestPerPayment, this.numPayments);
      var p = this.principal * this.interestPerPayment * temp / (temp - 1);
      return p;
    },
    amortizationPayments: function amortizationPayments() {
      var yearEndPrincipal = [];
      var principal = this.principal;
      var interestPortion, yearlyPrincipal;

      for (var y = 0; y < this.amortization; y++) {
        for (var p = 0; p < this.numPaymentsPerYear; p++) {
          interestPortion = principal * this.interestPerPayment;
          principal = principal - (this.payment - interestPortion);
        }

        principal = principal > 0 ? principal : 0;
        yearEndPrincipal.push({
          principal: principal,
          interestPortion: interestPortion
        });
      }

      return yearEndPrincipal;
    },
    totalCostOfMortgage: function totalCostOfMortgage() {
      return this.payment * this.numPayments;
    },
    interestPayed: function interestPayed() {
      return this.totalCostOfMortgage - this.principal;
    }
  },
  methods: {
    amortizationGraphBars: function amortizationGraphBars(width, height) {
      var bars = [];
      var spacing = 0;
      var i, p, x, y, w, h;

      for (i in this.amortizationPayments) {
        p = this.amortizationPayments[i].principal;
        w = width / this.amortization - spacing;
        x = parseInt(i) * (w + spacing);
        w -= 1;
        h = p * height / this.principal;
        h = h > 3 ? h : 3;
        y = height - h;
        bars.push({
          x: x,
          y: y,
          width: w,
          height: h,
          'data-p': p,
          'data-ip': this.amortizationPayments[i].interestPortion,
          'data-year': parseInt(i) + 1
        });
      }

      return bars;
    },
    setHover: function setHover(p, e) {
      this.graphSelection = {
        style: {
          left: e.clientX + 20 + 'px',
          top: e.clientY - 25 + 'px'
        },
        year: p['data-year'],
        principal: formatAsCurrency(p['data-p'], 0, this.currency, this.settings),
        principalPercent: (p['data-p'] / this.principal * 100).toFixed(1) + "%",
        visible: true
      };
    }
  }
});