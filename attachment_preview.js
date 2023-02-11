/**
 * Open in same Window plugin script.
 */
window.rcmail  &&  rcmail.addEventListener('init', function(evt) {
    if (rcmail.env.task == 'mail') {
        rcmail.register_command('plugin.attachment_preview.previewAttachment', function() {
            let div = document.createElement("DIV")
            div.classList.add("attachmentPreview")
            let iframe = document.createElement("IFRAME")
            iframe.src = '?_task=mail&_action=get&_mbox=' + urlencode(rcmail.env.mailbox) + '&_uid=' + rcmail.env.uid + '&_part=' + rcmail.env.selected_attachment
            div.append(iframe)
            document.body.append(div)
        }, true);
    }
    rcmail.addEventListener('beforemenu-open', function(p) {
        if (p.menu == 'attachmentmenu') {
            rcmail.env.selected_attachment = p.id;
        }
    });
});
