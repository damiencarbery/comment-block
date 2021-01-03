/**
 * Comment block
 */
( function( blocks, editor, i18n, element ) {
	var el = element.createElement;
	var __ = i18n.__;
	var RichText = editor.RichText;

	blocks.registerBlockType( 'dcwd-blocks/comment', {
		title: __( 'Comment Block', 'dcwd-blocks' ),
        description: __( 'Comment that is only shown when editing content. It is not displayed on front end.'),
		icon: 'editor-strikethrough',
		category: 'text',

		attributes: {
			content: {
				type: 'array',
				source: 'children',
				selector: 'p',
			},
		},

		example: {
			attributes: {
				content: __( 'Enter your comment here. This will only be seen in the editor.' ),
			},
		},

		edit: function( props ) {
			var content = props.attributes.content;
			function onChangeContent( newContent ) {
				props.setAttributes( { content: newContent } );
			}

			return el( RichText, {
				tagName: 'p',
				className: props.className,
				onChange: onChangeContent,
				value: content,
			} );
		},

		save: function( props ) {
			return el( RichText.Content, {
				tagName: 'p',
				value: props.attributes.content,
			} );
		},
	} );
} )( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element );
