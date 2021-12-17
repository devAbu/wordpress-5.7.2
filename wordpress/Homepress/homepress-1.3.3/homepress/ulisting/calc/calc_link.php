<?php
    use uListing\Classes\StmListingSettings;
    use uListing\Classes\StmListingAttribute;
    use uListing\Classes\StmListingTemplate;

    $currency_settings = (object) StmListingSettings::getCurrency();
    if($currency_settings->currency === 'AED' && strpos(get_locale(), 'en_') !== false){
        $currency = $currency_settings->currency. " ";
    }else{
        $currency = StmListingSettings::get_stm_currency_symbol( $currency_settings->currency );
    }

    $price = $args['model']->getAttributeValue(StmListingAttribute::TYPE_PRICE);
    $price = (isset($price["price"])) ? $price["price"] : 0;
    $currency_settings = json_encode(get_option(StmListingSettings::ULISTINGCURRENCY_SETTINGS, [
        'position' => null,
        'thousands_separator' => '',
        'decimal_separator' => '',
        'characters_after' => 0,
    ]));
?>

<div class="calc-info-result">
    <div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element); ?>>
        <?php
            StmListingTemplate::load_template(
            'calc/calc_link/' . $element['params']['template'],
            array(
                'price' => $price,
                'currency_settings' => $currency_settings
            ), true );
        ?>
    </div>
</div>