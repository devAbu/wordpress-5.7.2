<div>
    <div class="stmt-to-multimedia" v-if="media.length">
        <div class="stmt-to-multimedia__single" v-for="(m, k) in media">
            <div class="row center">
                <div class="column column-60">
                    <input type="text" v-model="media[k]['url']"
                           placeholder="<?php esc_html_e('Media URL', 'homepress-configurations') ?>"/>
                    <div class="stmt-to-multimedia__image" v-if="m.type === 'image' && m.preview.length > 0">
                        <img v-bind:src="m.preview" />
                    </div>
                </div>
                <div class="column column-40">
                    <div class="stmt-to-multimedia__actions">
                        <div class="lnr lnr-file-add" @click="addFile(k)"></div>
                        <i class="lnr lnr-trash"
                           @click="removeMedia(k, '<?php esc_html_e('Do you really want to delete this media?', 'homepress-configurations') ?>')"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stmt-to-button-group">
        <a class="button" @click="addMedia($event)"><?php esc_html_e('Add media', 'homepress-configurations'); ?></a>
        <a class="button button-outline"
           @click="addMediaBulk($event)"><?php esc_html_e('Bulk upload', 'homepress-configurations'); ?></a>
    </div>

</div>