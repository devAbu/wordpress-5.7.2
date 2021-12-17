<script type="text/javascript">
	<?php
	ob_start();
	include STMT_TO_DIR . '/post_type/metaboxes/components/payments.php';
    $clean = addslashes(ob_get_clean());
	?>
    Vue.component('stmt-payments', {
        props: ['saved_payments'],
        data: function () {
            return {
                payment_values : {},
                payments: {
                    cash: {
                        enabled: '',
                        name: "<?php esc_html_e('Offline payment', 'homepress-configurations'); ?>",
                        fields: {
                            description: {
                                type: 'textarea',
                                placeholder: '<?php esc_html_e('Payment method description', 'homepress-configurations'); ?>'
                            },
                        },
                    },
                    wire_transfer: {
                        enabled: '',
                        name: "<?php esc_html_e('Wire Transfer', 'homepress-configurations'); ?>",
                        fields: {
                            account_number: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Account number', 'homepress-configurations'); ?>'
                            },
                            holder_name: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Holder name', 'homepress-configurations'); ?>'
                            },
                            bank_name: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Bank name', 'homepress-configurations'); ?>'
                            },
                            swift: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Swift', 'homepress-configurations'); ?>'
                            },
                            description: {
                                type: 'textarea',
                                placeholder: '<?php esc_html_e('Payment method description', 'homepress-configurations'); ?>'
                            },
                        },
                    },
                    paypal: {
                        enabled: '',
                        name: "<?php esc_html_e('Paypal', 'homepress-configurations'); ?>",
                        fields: {
                            paypal_email: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('PayPal Email', 'homepress-configurations'); ?>'
                            },
                            currency_code: {
                                type: 'select',
                                source: 'codes',
                                value : 'USD',
                                placeholder: '<?php esc_html_e('Currency code', 'homepress-configurations'); ?>'
                            },
                            paypal_mode: {
                                type: 'select',
                                source: 'modes',
                                value : 'sandbox',
                                placeholder: '<?php esc_html_e('PayPal mode', 'homepress-configurations'); ?>'
                            },
                            description: {
                                type: 'textarea',
                                placeholder: '<?php esc_html_e('Payment method description', 'homepress-configurations'); ?>'
                            },
                        },
                    },
                    stripe: {
                        enabled: '',
                        name: "<?php esc_html_e('Stripe', 'homepress-configurations'); ?>",
                        fields: {
                            stripe_public_api_key: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Publishable key', 'homepress-configurations'); ?>'
                            },
                            secret_key: {
                                type: 'text',
                                placeholder: '<?php esc_html_e('Secret key', 'homepress-configurations'); ?>'
                            },
                            description: {
                                type: 'textarea',
                                placeholder: '<?php esc_html_e('Payment method description', 'homepress-configurations'); ?>'
                            },
                        },
                    },
                },
                sources: {
                    codes: {
                        '<?php esc_html_e('Select Currency code', 'homepress-configurations'); ?>' : '',
                        '<?php esc_html_e('Australian dollar', 'homepress-configurations'); ?>' : 'AUD',
                        '<?php esc_html_e('Brazilian real', 'homepress-configurations'); ?>' : 'BRL',
                        '<?php esc_html_e('Canadian dollar', 'homepress-configurations'); ?>' : 'CAD',
                        '<?php esc_html_e('Czech koruna', 'homepress-configurations'); ?>' : 'CZK',
                        '<?php esc_html_e('Danish krone', 'homepress-configurations'); ?>' : 'DKK',
                        '<?php esc_html_e('Euro', 'homepress-configurations'); ?>' : 'EUR',
                        '<?php esc_html_e('Hong Kong dollar', 'homepress-configurations'); ?>' : 'HKD',
                        '<?php esc_html_e('Hungarian forint 1', 'homepress-configurations'); ?>' : 'HUF',
                        '<?php esc_html_e('Indian rupee', 'homepress-configurations'); ?>' : 'INR',
                        '<?php esc_html_e('Israeli new shekel', 'homepress-configurations'); ?>' : 'ILS',
                        '<?php esc_html_e('Japanese yen 1', 'homepress-configurations'); ?>' : 'JPY',
                        '<?php esc_html_e('Malaysian ringgit 2	', 'homepress-configurations'); ?>' : 'MYR',
                        '<?php esc_html_e('Mexican peso', 'homepress-configurations'); ?>' : 'MXN',
                        '<?php esc_html_e('New Taiwan dollar 1', 'homepress-configurations'); ?>' : 'TWD',
                        '<?php esc_html_e('New Zealand dollar', 'homepress-configurations'); ?>' : 'NZD',
                        '<?php esc_html_e('Norwegian krone', 'homepress-configurations'); ?>' : 'NOK',
                        '<?php esc_html_e('Philippine peso', 'homepress-configurations'); ?>' : 'PHP',
                        '<?php esc_html_e('Polish złoty', 'homepress-configurations'); ?>' : 'PLN',
                        '<?php esc_html_e('Pound sterling', 'homepress-configurations'); ?>' : 'GBP',
                        '<?php esc_html_e('Russian ruble', 'homepress-configurations'); ?>' : 'RUB',
                        '<?php esc_html_e('Singapore dollar', 'homepress-configurations'); ?>' : 'SGD',
                        '<?php esc_html_e('Swedish krona', 'homepress-configurations'); ?>' : 'SEK',
                        '<?php esc_html_e('Swiss franc', 'homepress-configurations'); ?>' : 'CHF',
                        '<?php esc_html_e('Thai baht', 'homepress-configurations'); ?>' : 'THB',
                        '<?php esc_html_e('United States dollar', 'homepress-configurations'); ?>' : 'USD',
                    },
                    modes : {
                        '<?php esc_html_e('Sandbox', 'homepress-configurations'); ?>' : 'sandbox',
                        '<?php esc_html_e('Live', 'homepress-configurations'); ?>' : 'live',
                    }
                }
            }
        },
        template: '<?php echo preg_replace( "/\r|\n/", "", $clean); ?>',
        mounted: function () {
            if (this.saved_payments) this.setPaymentValues();
        },
        methods: {
            setPaymentValues() {
                var vm = this;
                for(var payment_method in vm.payments) {
                    if (!vm.payments.hasOwnProperty(payment_method) && !vm.saved_payments.hasOwnProperty(payment_method)) continue;
                    vm.payments[payment_method]['enabled'] = vm.saved_payments[payment_method]['enabled'];

                    for(var field_name in vm.payments[payment_method]['fields']) {
                        vm.$set(vm.payments[payment_method]['fields'][field_name], 'value', vm.saved_payments[payment_method]['fields'][field_name]);
                    }
                }
            },
            getPaymentValues() {
                var vm = this;
                for(var payment_method in vm.payments) {

                    if (!vm.payments.hasOwnProperty(payment_method)) continue;
                    vm.payment_values[payment_method] = {
                        'enabled' : vm.payments[payment_method]['enabled'],
                    };

                    if(typeof vm.payment_values[payment_method]['fields'] === 'undefined') vm.payment_values[payment_method]['fields'] = {};

                    for(var field_name in vm.payments[payment_method]['fields']) {
                        if (! vm.payments[payment_method]['fields'].hasOwnProperty(field_name)) continue;
                        var value = (typeof vm.payments[payment_method]['fields'][field_name]['value'] === 'undefined') ? '' : vm.payments[payment_method]['fields'][field_name]['value'];

                        vm.payment_values[payment_method]['fields'][field_name] = value;

                    }
                }

                this.$emit('update-payments', vm.payment_values);
            }
        },
        watch: {
            payments: {
                handler: function () {
                    this.getPaymentValues();
                },
                deep: true
            },
        }
    })
</script>