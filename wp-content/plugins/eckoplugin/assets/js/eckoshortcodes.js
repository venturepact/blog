(function() {

	tinymce.PluginManager.add('eckoshortcodes_options', function( editor, url ) {
		editor.addButton( 'eckoshortcodes_button', {
			text: 'Ecko Shortcodes',
			icon: 'eckoshortcodes-icon',
			type: 'menubutton',
			menu: [
				{
					text: 'Elements',
					menu: [
						{
							text: 'Alert Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Alert Box',
									body: [
										{
											type: 'listbox',
											name: 'alert_color',
											label: 'Color',
											'values': [
												{text: 'Gray', value: 'gray'},
												{text: 'Blue', value: 'blue'},
												{text: 'Green', value: 'green'},
												{text: 'Orange', value: 'orange'},
												{text: 'Red', value: 'red'}
											]
										},
										{
											type: 'textbox',
											name: 'alert_message',
											label: 'Alert Message',
											value: '',
											minWidth: 300,
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_alert color="' + e.data.alert_color + '"]' + e.data.alert_message + '[/ecko_alert]');
									}
								});
							},
						},
						{
							text: 'Progress Bar',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Progress Bar',
									body: [
										{
											type: 'listbox',
											name: 'progress_color',
											label: 'Progress Bar Color',
											'values': [
												{text: 'Gray', value: 'gray'},
												{text: 'Blue', value: 'blue'},
												{text: 'Green', value: 'green'},
												{text: 'Orange', value: 'orange'},
												{text: 'Red', value: 'red'}
											]
										},
										{
											type: 'textbox',
											name: 'progress_percentage',
											label: 'Progress Bar Percentage Value',
											value: '',
											minWidth: 300,
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_progress color="' + e.data.progress_color + '" percentage="' + e.data.progress_percentage + '"]');
									}
								});
							}
						},
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Button',
									body: [
										{
											type: 'listbox',
											name: 'button_color',
											label: 'Button Color',
											'values': [
												{text: 'Gray', value: 'gray'},
												{text: 'Blue', value: 'blue'},
												{text: 'Green', value: 'green'},
												{text: 'Orange', value: 'orange'},
												{text: 'Red', value: 'red'}
											]
										},
										{
											type: 'listbox',
											name: 'button_size',
											label: 'Button Size',
											'values': [
												{text: 'Small', value: 'small'},
												{text: 'Normal', value: 'normal'},
												{text: 'Large', value: 'large'}
											]
										},
										{
											type: 'textbox',
											name: 'button_url',
											label: 'Destination URL',
											value: '',
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'button_text',
											label: 'Button Text',
											value: '',
											minWidth: 300,
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_button color="' + e.data.button_color + '" size="' + e.data.button_size + '" url="' + e.data.button_url + '"]' + e.data.button_text + '[/ecko_button]');
									}
								});
							}
						},
						{
							text: 'Font Awesome Icon',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Font Awesome Icon',
									body: [
										{
											type: 'textbox',
											name: 'faicon_id',
											label: 'Font Awesome Icon ID (eg. fa-bookmark)',
											value: '',
											minWidth: 300,	
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_icon alias="' + e.data.faicon_id + '"]');
									}
								});
							}
						},
					]
				},
				{
					text: 'Containers',
					menu: [
						{
							text: 'Code Highlight',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Code Highlight',
									body: [
										{
											type: 'listbox',
											name: 'codehighlight_language',
											label: 'Language',
											minWidth: 300,
											'values': [
												{text: 'JavaScript', value: 'javascript'},
												{text: 'HTML', value: 'html'},
												{text: 'CSS', value: 'css'},
												{text: 'Python', value: 'python'},
												{text: 'Ruby', value: 'ruby'},
												{text: 'Shell', value: 'shell'},
												{text: 'PHP', value: 'php'},
												{text: 'Coffescript', value: 'coffeescript'},
												{text: 'C', value: 'c'},
												{text: 'Go', value: 'go'},
												{text: 'Scheme', value: 'scheme'},
												{text: 'Lua', value: 'lua'},
												{text: 'C#', value: 'c#'},
												{text: 'Smalltalk', value: 'smalltalk'},
												{text: 'R', value: 'r'},
												{text: 'Haskell', value: 'haskell'},
												{text: 'D', value: 'd'}
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_code_highlight language="' + e.data.codehighlight_language + '"]USE "TEXT" POST EDITOR & INSERT CODE HERE[/ecko_code_highlight]');
									}
								});
							}
						},
						{
							text: 'Annotated Content',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Annotated Content',
									body: [
										{
											type: 'textbox',
											name: 'annotation_title',
											label: 'Annotation Title',
											value: ''
										},
										{
											type: 'textbox',
											name: 'annotation_description',
											label: 'Annotation Description',
											value: ''
										},
										{
											type: 'textbox',
											name: 'annotation_content',
											label: 'Content',
											value: '',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_annotated header="' + e.data.annotation_title + '" annotation="' + e.data.annotation_description + '"]' + e.data.annotation_content + '[/ecko_annotated]');
									}
								});
							}
						},
						{
							text: 'Toggle Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Toggle Box',
									body: [
										{
											type: 'listbox',
											name: 'toggle_style',
											label: 'Toggle Box Style',
											'values': [
												{text: 'Solid', value: 'solid'},
												{text: 'Outline', value: 'outline'},
											]
										},
										{
											type: 'listbox',
											name: 'toggle_state',
											label: 'Toggle Box Default State',
											'values': [
												{text: 'Closed', value: 'closed'},
												{text: 'Open', value: 'open'},
											]
										},
										{
											type: 'textbox',
											name: 'toggle_title',
											label: 'Toggle Box Title',
											value: '',
											minWidth: 300,	
										},
										{
											type: 'textbox',
											name: 'toggle_content',
											label: 'Content',
											value: '',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_toggle style="' + e.data.toggle_style + '" state="' + e.data.toggle_state + '" title="' + e.data.toggle_title + '"]' + e.data.toggle_content + '[/ecko_toggle]');
									}
								});
							}
						},
						{
							text: 'Columns',
							onclick: function() {
								editor.insertContent( '[ecko_columns][ecko_columns_left] ADD LEFT CONTENT HERE [/ecko_columns_left][ecko_columns_right] ADD RIGHT CONTENT HERE [/ecko_columns_right][/ecko_columns]');
							}
						},
						{
							text: 'Tab Wrapper',
							onclick: function() {
								editor.insertContent( '[ecko_tabs][/ecko_tabs]');
							}
						},
						{
							text: 'Tab Item',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Tab Item',
									body: [
										{
											type: 'textbox',
											name: 'tab_id',
											label: 'Tab ID (no spaces)',
											value: ''
										},
										{
											type: 'textbox',
											name: 'tab_title',
											label: 'Tab Title',
											value: '',
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'tab_content',
											label: 'Tab Content',
											value: '',
											multiline: true,
											minWidth: 300,
											minHeight: 100
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_tab_header id="' + e.data.tab_id + '"]' + e.data.tab_title + '[/ecko_tab_header][ecko_tab_content id="' + e.data.tab_id + '"]' + e.data.tab_content + '[/ecko_tab_content]' );
									}
								});
							}
						},
					]
				},
				{
					text: 'Embeds',
					menu: [
						{
							text: 'Youtube',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Youtube Embed',
									body: [
										{
											type: 'textbox',
											name: 'youtube_id',
											label: 'Youtube Video ID',
											value: '',
											minWidth: 300,	
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_youtube]' + e.data.youtube_id + '[/ecko_youtube]');
									}
								});
							}
						},
						{
							text: 'Vimeo',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Vimeo Embed',
									body: [
										{
											type: 'textbox',
											name: 'vimeo_id',
											label: 'Vimeo Video ID',
											value: '',
											minWidth: 300,	
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_vimeo]' + e.data.youtube_id + '[/ecko_vimeo]');
									}
								});
							}
						},
					]
				},
				{
					text: 'Post Formats',
					menu: [
						{
							text: 'Status / Aside',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Status',
									body: [
										{
											type: 'textbox',
											name: 'status_message',
											label: 'Status Message',
											value: '',
											multiline: true,
											minWidth: 300,
											minHeight: 100	
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_statusmessage]' + e.data.status_message + '[/ecko_statusmessage]');
									}
								});
							}
						},
						{
							text: 'Quote',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Quote',
									body: [
										{
											type: 'textbox',
											name: 'quote_main',
											label: 'Quote Text',
											value: '',
											multiline: true,
											minWidth: 300,
											minHeight: 100	
										},
										{
											type: 'textbox',
											name: 'quote_source',
											label: 'Quote Source',
											value: '',
											minWidth: 300,	
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_quote source="' + e.data.quote_source + '"]' + e.data.quote_main + '[/ecko_quote]');
									}
								});
							}
						},
						{
							text: 'Link',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Link',
									body: [
										{
											type: 'textbox',
											name: 'link_url',
											label: 'Link Destination URL',
											value: '',
											minWidth: 300,	
										},
										{
											type: 'textbox',
											name: 'link_title',
											label: 'Link Title',
											value: '',
											minWidth: 300,	
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[ecko_link url="' + e.data.link_url + '"]' + e.data.link_title + '[/ecko_link]');
									}
								});
							}
						},
						{
							text: 'Gallery/Image Wrapper',
							onclick: function() {
								editor.insertContent( '[ecko_gallery_wrapper][/ecko_gallery_wrapper]');
							}
						},
						{
							text: 'Gallery/Image Item',
							onclick: function() {
								editor.insertContent( '[ecko_gallery_item][/ecko_gallery_item]');
							}
						},
					]
				},
				{
					text: 'Cedar Theme',
					classes: 'theme-specific theme-Cedar',
					menu: [
						{
							text: 'Wide Block',
							onclick: function() {
								editor.insertContent( '[ecko_wide]REPLACE WITH CONTENT[/ecko_wide]');
							}
						},
						{
							text: 'Contrast Block',
							onclick: function() {
								editor.insertContent( '[ecko_contrast]REPLACE WITH CONTENT[/ecko_contrast]');
							}
						},
						{
							text: 'Full Page Image',
							onclick: function() {
								editor.insertContent( '[ecko_fullpage_image]SELECT THIS TEXT AND CLICK \'ADD MEDIA\' ABOVE TO INSERT IMAGE[/ecko_fullpage_image]');
							}
						}
					]
				},
			]
		});
	});
})();