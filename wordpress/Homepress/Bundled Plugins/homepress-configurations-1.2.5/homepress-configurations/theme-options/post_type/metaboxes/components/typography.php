<div>
    <div class="stmt-to-typography">

        <div class="row">
            <div class="column column-50">
				<?php esc_html_e('Font Family', 'homepress-configurations'); ?>
                <select v-model="typography['font-family']" placeholder="adas">
					<?php foreach (stmt_get_google_fonts() as $k => $val) : ?>
                        <option value="<?php echo esc_attr( $k ) ?>"><?php echo esc_attr( $val ); ?></option>
					<?php endforeach; ?>
                </select>
            </div>

            <div class="column column-50">

				<?php esc_html_e('Color', 'homepress-configurations'); ?>
                <div class="stmt_colorpicker_wrapper" style="width: 100%">
                    <span v-bind:style="{'background-color': color}"></span>
                    <input type="text" v-model="color"/>
                    <stmt-color v-on:get-color="color = $event"></stmt-color>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="column column-50">
				<?php esc_html_e('Font Size', 'homepress-configurations'); ?>
                <input type="text" v-model="typography['font-size']"/>
            </div>

            <div class="column column-50">

				<?php esc_html_e('Line Height', 'homepress-configurations'); ?>
                <input type="text" v-model="typography['line-height']"/>
            </div>

        </div>


        <div class="row">
            <div class="column column-50">
				<?php esc_html_e('Font Weight', 'homepress-configurations'); ?>
                <select v-model="typography['font-weight']">
                    <option value=""><?php esc_html_e('Default', 'homepress-configurations'); ?></option>
                    <option value="200"><?php esc_html_e('Thin', 'homepress-configurations'); ?></option>
                    <option value="300"><?php esc_html_e('Light', 'homepress-configurations'); ?></option>
                    <option value="400"><?php esc_html_e('Regular', 'homepress-configurations'); ?></option>
                    <option value="500"><?php esc_html_e('Medium', 'homepress-configurations'); ?></option>
                    <option value="600"><?php esc_html_e('Semi-bold', 'homepress-configurations'); ?></option>
                    <option value="700"><?php esc_html_e('Bold', 'homepress-configurations'); ?></option>
                    <option value="900"><?php esc_html_e('Ultra Bold', 'homepress-configurations'); ?></option>
                </select>
            </div>

            <div class="column column-50">

				<?php esc_html_e('Letter Spacing', 'homepress-configurations'); ?>
                <input type="text" v-model="typography['letter-spacing']"/>
            </div>

        </div>

        <div class="row" v-if="stored_margins">

            <div class="column column-50">
                <?php esc_html_e('Margin Top', 'homepress-configurations'); ?>
                <input type="text" v-model="typography['margin_top']"/>
            </div>

            <div class="column column-50">
                <?php esc_html_e('Margin Bottom', 'homepress-configurations'); ?>
                <input type="text" v-model="typography['margin_bottom']"/>
            </div>

        </div>

<!--		--><?php //esc_html_e('Add classes and tags separating with comma (ex: .class, h1, h2 …)', 'homepress-configurations'); ?>
<!--        <input type="text" v-model="selectors"/>-->
    </div>
</div>