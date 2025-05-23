<script src="{{ asset('admin/js/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('admin/js/trumbowyg/plugins/trumbowyg.history.min.js') }}"></script>
<script src="{{ asset('admin/js/trumbowyg/plugins/trumbowyg.table.min.js') }}"></script>
<script src="{{ asset('admin/js/trumbowyg/plugins/trumbowyg.emoji.min.js') }}"></script>

<script>
    window.wysiwygEditor = function() {

        $('.wysiwyg-editor').trumbowyg({
            svgPath: '{{ asset("admin/css/trumbowyg/icons.svg") }}',
            btns: [
                ['viewHTML'],
                ['formatting', 'strong', 'italic', 'underline'],
                ['unorderedList', 'orderedList', 'removeformat'],
                ['historyUndo', 'historyRedo'],
                ['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['table'], //'tableCellBackgroundColor', 'tableBorderColor'
                ['emoji'],
                ['fullscreen']
            ],
            plugins: {
                table: {
                    allowHorizontalResize: true,
                }
            },
            autogrow: true
        });

    }

    wysiwygEditor();
</script>