<?php
/**
     * Open attachment in same windows
     *
     * Preview attachment in message area instead of new tab
     *
     * @version 0.1
     * @author meles
     * @url https://github.com/jv-barsuk/roundcube_attachment_preview
     */
    class attachment_preview extends rcube_plugin
    {
        public $task = 'mail';

        /**
         * Plugin initialization.
         */
        public function init()
        {
            $this->add_texts('localization', ['previewAttachment']);
            $this->include_script('attachment_preview.js');
            $this->include_stylesheet($this->local_skin_path() . '/attachment_preview.css');
    
            $this->add_hook('template_container', [$this, 'preview_attachment']);
        }
    
        /**
         * Handler to place a link in the attachmentmenu (template container)
         * for each attachment to trigger the removal of the selected attachment.
         *
         * @param  array $p Hook arguments
         * @return array Hook arguments
         */
        public function preview_attachment($p)
        {
            if ($p['name'] == 'attachmentmenu') {
                $link = $this->api->output->button([
                    'type' => 'link',
                    'id' => 'attachmentmenupreview',
                    'command' => 'plugin.attachment_preview.previewAttachment',
                    'class' => 'removelink icon active',
                    'content' => rcube::Q($this->gettext('attachment_preview.previewAttachment')
                    ),
                ]);
    
                $p['content'] .= html::tag('li', ['role' => 'menuitem'], $link);
            }
    
            return $p;
        }
    }
    
?>