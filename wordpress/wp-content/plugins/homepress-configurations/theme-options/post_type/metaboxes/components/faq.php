<div>
    <div class="stmt-to-faq">

        <div class="stmt-to-icon_input">
            <input type="text"
                   @keydown.enter.prevent="addNew()"
                   v-model="add_new"
                   v-bind:class="{'shake-it' : isEmpty}"
                   placeholder="<?php esc_html_e('Add new FAQ item', 'homepress-configurations') ?>"/>
            <i class="stmt-to-icon lnr lnr-checkmark-circle" @click="addNew()"></i>
        </div>


        <div class="stmt_to_faq">
            <div class="stmt_to_faq__single" v-for="(item, key) in faq">
                <div class="stmt_to_faq__single_top">
                    <label><?php esc_html_e('Question', 'homepress-configurations'); ?> {{ key + 1 }}</label>
                    <i class="lnr lnr-cross" @click="deleteItem(key)"></i>
                </div>

                <input type="text" v-model="item['question']" placeholder="<?php esc_html_e('Enter FAQ question', 'homepress-configurations') ?>" />
                <textarea v-model="item['answer']" placeholder="<?php esc_html_e('Enter FAQ answer', 'homepress-configurations') ?>"></textarea>
            </div>
        </div>

    </div>
</div>