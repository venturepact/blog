/*global redux_change, wp, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.category_settings = redux.field_objects.category_settings || {};

    $( document ).ready(
        function() {
            //redux.field_objects.category_settings.init();
        }
    );

    redux.field_objects.category_settings.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-category_settings' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                
				
                redux.field_objects.media.init(el);

                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                
                if ( parent.hasClass( 'redux-container-category_settings' ) ) {
                    parent.addClass( 'redux-field-init' );    
                }
                
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                el.find( '.redux-category_settings-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );

                        $( this ).parent().siblings().find( 'input[type="text"]' ).val( '' );
                        $( this ).parent().siblings().find( 'input[type="hidden"]' ).val( '' );

                        var slideCount = $( this ).parents( '.redux-container-category_settings:first' ).find( '.redux-category_settings-accordion-group' ).length;

                        if ( slideCount > 1 ) {
                            $( this ).parents( '.redux-category_settings-accordion-group:first' ).slideUp(
                                'medium', function() {
                                    $( this ).remove();
                                }
                            );
                        } else {
                            var content_new_title = $( this ).parent( '.redux-category_settings-accordion' ).data( 'new-content-name' );

                            $( this ).parents( '.redux-category_settings-accordion-group:first' ).find( '.remove-image' ).click();
                            $( this ).parents( '.redux-container-category_settings:first' ).find( '.redux-category_settings-accordion-group:last' ).find( '.redux-category_settings-header' ).text( content_new_title );
                        }
                    }
                );

                el.find( '.redux-category_settings-add' ).click(
                    function() {
                        var newItem = $( this ).prev().find( '.redux-category_settings-accordion-group:last' ).clone( true );

                        var slideCount = $( newItem ).find( '.slide-name' ).attr( "name" ).match( /[0-9]+(?!.*[0-9])/ );
                        var slideCount1 = slideCount * 1 + 1;

                        $( newItem ).find( 'input[type="text"], input[type="hidden"], select' ).each(
                            function() {

                                $( this ).attr(
                                    "name", jQuery( this ).attr( "name" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 )
                                ).attr( "id", $( this ).attr( "id" ).replace( /[0-9]+(?!.*[0-9])/, slideCount1 ) );
                                $( this ).val( '' );
                                if ( $( this ).hasClass( 'slide-sort' ) ) {
                                    $( this ).val( slideCount1 );
                                }
                            }
                        );

                        var content_new_title = $( this ).prev().data( 'new-content-name' );


                        $( newItem ).find( 'h3' ).text( '' ).append( '<span class="redux-category_settings-header">' + content_new_title + '</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>' );

                        $( this ).prev().append( newItem );
                    }
                );

                el.find( '.slide-name' ).keyup(
                    function( event ) {
                        var newTitle = event.target.value;
                        $( this ).parents().eq( 3 ).find( '.redux-category_settings-header' ).text( newTitle );
                    }
                );


                el.find( ".redux-category_settings-accordion" )
                    .accordion(
                    {
                        header: "> div > fieldset > h3",
                        collapsible: true,
                        active: false,
                        heightStyle: "content",
                        icons: {
                            "header": "ui-icon-plus",
                            "activeHeader": "ui-icon-minus"
                        }
                    }
                )
                    .sortable(
                    {
                        axis: "y",
                        handle: "h3",
                        connectWith: ".redux-category_settings-accordion",
                        start: function( e, ui ) {
                            ui.placeholder.height( ui.item.height() );
                            ui.placeholder.width( ui.item.width() );
                        },
                        placeholder: "ui-state-highlight",
                        stop: function( event, ui ) {
                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                            var inputs = $( 'input.slide-sort' );
                            inputs.each(
                                function( idx ) {
                                    $( this ).val( idx );
                                }
                            );
                        }
                    }
                );
            }
        );
    };
})( jQuery );
