(function( $ ) {
	$( document ).ready(function() {
		camp_path += '/images/';

		/* Image Slider */
		var enable = true;
		var current_slide = 0;
		var next_slide;
		var size = $( '.camp-slide' ).size();
		var intervalID = setInterval(function() { $( '#right' ).click() }, 10000 );
		$( '#right' ).click(function() {
			if ( enable ) {
				enable = false;
				clearInterval( intervalID );
				if ( current_slide < size - 1 ) {
					next_slide = current_slide + 1;
				} else {
					next_slide = 0;
				}
				$( '.camp-slide#slide-' + current_slide ).css( 'z-index', '50' );
				$( '.camp-slide#slide-' + next_slide ).css( 'z-index', '40' );
				$( '.camp-slide' ).not( '#slide-' + current_slide ).hide();
				$( '.camp-slide#slide-' + next_slide ).show();
				$( '.camp-slide#slide-' + current_slide ).css( 'position', 'absolute' );
				$( '.camp-slide#slide-' + next_slide ).css( { 'left': '100%', 'top': '0%' } );
				$( '.camp-slide#slide-' + next_slide ).children( '.camp-slide-line' ).hide();
				$( '.camp-slide#slide-' + next_slide ).find( '.camp-slide-text' ).css( 'opacity', '0' );
				$( '.camp-slide#slide-' + current_slide ).children( 'img' ).animate( { 'opacity': '0' }, 1000 );
				$( '.camp-slide#slide-' + current_slide ).find( '.camp-slide-text' ).animate( { 'opacity': '0' }, 1000 );
				$( '.camp-slide#slide-' + next_slide ).animate( { left: '0' }, 1000 );
				setTimeout(function() {
					if ( current_slide < size - 1 ) {
						current_slide ++;
					} else {
						current_slide = 0;
					}
					$( '.camp-slide#slide-' + current_slide ).children( '.camp-slide-line' ).show();
					$( '.camp-slide#slide-' + current_slide ).find( '.camp-slide-text' ).animate( { 'opacity': '1' }, 500 );
					$( '.camp-slide' ).not( '#slide-' + current_slide ).hide();
					$( '.camp-slide' ).css( 'position', 'relative' );
					$( '.camp-slide' ).children( 'img' ).css( 'opacity', '1' );
					$( '.camp-slide' ).not( '#slide-' + current_slide ).find( '.camp-slide-text' ).css( 'opacity', '1' );

					enable = true;
				}, 1010 );
				intervalID = setInterval(function() { $( '#right' ).click() }, 10000 );
			}
		});
		$( '#left' ).click(function() {
			if ( enable ) {
				enable = false;
				clearInterval( intervalID );
				if ( current_slide > 0 ) {
					next_slide = current_slide - 1;
				} else {
					next_slide = size - 1;
				}
				$( '.camp-slide#slide-' + current_slide ).css( 'z-index', '50' );
				$( '.camp-slide#slide-' + next_slide ).css( 'z-index', '40' );
				$( '.camp-slide' ).not( '#slide-' + current_slide ).hide();
				$( '.camp-slide#slide-' + next_slide ).show();
				$( '.camp-slide#slide-' + current_slide ).css( 'position', 'absolute' );
				$( '.camp-slide#slide-' + next_slide ).css( { 'left': '-100%', 'top': '0%' } );
				$( '.camp-slide#slide-' + next_slide ).children( '.camp-slide-line' ).hide();
				$( '.camp-slide#slide-' + next_slide ).find( '.camp-slide-text' ).css( 'opacity', '0' );
				$( '.camp-slide#slide-' + current_slide ).children( 'img' ).animate( { 'opacity': '0' }, 1000 );
				$( '.camp-slide#slide-' + current_slide ).find( '.camp-slide-text' ).animate( { 'opacity': '0' }, 1000 );
				$( '.camp-slide#slide-' + next_slide ).animate( { left: '0' }, 1000 );
				setTimeout(function() {
					if ( current_slide > 0 ) {
						current_slide --;
					} else {
						current_slide = size - 1;
					}
					$( '.camp-slide#slide-' + current_slide ).children( '.camp-slide-line' ).show();
					$( '.camp-slide#slide-' + current_slide ).find( '.camp-slide-text' ).animate( { 'opacity': '1' }, 500 );
					$( '.camp-slide' ).not( '#slide-' + current_slide ).hide();
					$( '.camp-slide' ).css( 'position', 'relative' );
					$( '.camp-slide' ).children( 'img' ).css( 'opacity', '1' );
					$( '.camp-slide' ).not( '#slide-' + current_slide ).find( '.camp-slide-text' ).css( 'opacity', '1' );

					enable = true;
				}, 1010 );
				intervalID = setInterval(function() { $( '#right' ).click() }, 10000 );
			}
		});

		var btn_enable = true;
		$( '#left' ).on( {
			mouseenter: function() {
				if ( btn_enable ) {
					btn_enable = false;
					$( this ).animate( { opacity: '1' }, 500 );
					setTimeout(function() {
						btn_enable = true;
					}, 500);
				}
			},
			mouseleave: function() { $( this ).animate( { opacity: '0.1' }, 500 ); }
		});
		$( '#right' ).on( {
			mouseenter: function() {
				if ( btn_enable ) {
					btn_enable = false;
					$( this ).animate( { opacity: '1' }, 500 );
					setTimeout(function() {
						btn_enable = true;
					}, 500);
				}
			},
			mouseleave: function() { $( this ).animate( { opacity: '0.1'}, 500 ); }
		});

		/* Form Elements */

		/* Generate new Id for <select> */
		var camp_selectId = 0;
		$( 'select' ).each(function() {
			if ( ! this.id ) {
				$( this ).attr( 'id', 'camp-select-' + camp_selectId );
				camp_selectId++;
			}
		});

		/* Select */
		$( 'select' ).each(function() {
			if ( ! $( this ).attr( 'multiple' ) ) {
				$( this ).after( '<div class = "camp-select-main" id = "temp-main" ><ul class = "camp-select" id = "temp"/></div>' )
					.children( 'optgroup' )
						.each(function() {
							$( '#temp' ).append( '<li class = "camp-option-group">' + $( this ).attr( 'label' ) + '</li>' );
							$( this ).children( 'option' )
								.each(function() {
									$( '#temp' ).append( '<li class = "camp-option" >' + $( this ).text() + '</li>' );
								});
						})
					.end()
					.children( 'option' )
					.each(function() {
						$( '#temp' ).append( '<li class = "camp-option">' + $( this ).text() + '</li>' );
					});
				$( '#temp' ).before( '<div class = "camp-select-header" id = "temp-header"></div>' );
				$( '#temp-header' ).prepend( '<img src = ' + camp_path + 'choise.jpg alt = "< >" />' );
				$( '#temp-header' ).prepend( '<p class = "camp-header-text" id = "temp-text">Select element</p>' );
				$( '#temp-header' ).attr( 'id', this.id );
				$( '#temp-img' ).attr( 'id', this.id );
				$( '#temp-text' ).attr( 'id', this.id );
				$( '#temp' ).attr( 'id', this.id );
				$( '#temp-main' ).attr( 'id', this.id );
				$( this ).css( 'display', 'none' );
			}
		});

		$( '.camp-select-header' ).on( {
			click: function() {
				$( '.camp-select#' + this.id ).children( 'li' ).toggle( 'slow' );
				$( '.camp-select#' + this.id ).children( 'li' ).attr( 'id', this.id );
			}
		});

		$( '.camp-option' ).on( {
			click: function() {
				$( '.camp-select#' + this.id ).children( 'li' ).hide( 'slow' );
				$( 'p.camp-header-text#' + this.id ).text( $( this ).text() );
				var index = $( this ).parent().children( 'li.camp-option' ).index( $( this ) );
				var curSelect = $( 'select#' + this.id ).prop( 'selectedIndex', index );
				if ( curSelect.val() ) {
					curSelect.change();
				}
			}
		});

		$( document ).mousedown(function( e ) {
			if ( $( e.target ).closest( '.camp-select-main#' + eID ).length == 0 ) {
				var eID = $( e.target ).attr( 'id' );
				$( '.camp-select' ).not( '#' + eID ).children( 'li' ).hide( 'slow' );
			}
		});

		/* Sub Menu */
		$( '.camp-site-navigation' ).find( '.sub-menu', '.children' ).children( 'li' ).on( {
			mouseenter: function() {
				$( this ).children( 'ul' )
					.each(function() {
						if ( $( 'html' ).attr( 'class' ) == 'ie7' || $( 'html' ).attr( 'class' ) == 'ie8' ) {
							$( this ).show();
						}
						if ( $( this ).offset().left + $( this ).width() > $( window ).width() ) {
							$( this ).css( { 'top': '60%', 'left': '-222px' } );
						}
					});
			},
			mouseleave: function() {
				if ( $( 'html' ).attr( 'class' ) == 'ie7' || $( 'html' ).attr( 'class' ) == 'ie8' ) {
					$( this ).children( 'ul' ).hide();
				}
			}
		});

		if ( $( 'html' ).attr( 'class' ) == 'ie7' ) {
			$( '.camp-site-navigation' ).find( '.children' ).on( {
				mouseleave: function() {
					$( this ).hide();
				}
			});
		}

		/* Radiobutton */
		var camp_radioId = 0;
		$( 'input:radio' ).each(function() {
			if ( ! this.id ) {
				$( this ).attr( 'id', 'camp-radio-' + camp_radioId );
				camp_radioId++;
			}
			$( this ).css( 'display', 'none' );
			$( this ).after( '<img id = "' + this.id + '" class = "camp-radio" src = "' + camp_path + 'radio.jpg" alt = "Radio" />' );
			if ( $( this ).attr( 'checked' ) ) {
				$( '.radio#' + this.id ).attr( 'src', camp_path + 'radio-checked.jpg' );
			} else {
				$( '.radio#' + this.id ).attr( 'src', camp_path + 'radio.jpg' );
			}	
		});

		$( '.camp-radio' ).on( {
			click: function() {
				if ( $( 'input:radio#' + this.id ).attr( 'checked' ) ) {
					$( 'input:radio#' + this.id ).removeAttr( 'checked' );
					$( '.camp-radio#' + this.id ).attr( 'src', camp_path + 'radio.jpg' );
				} else {
					var name = $( 'input:radio#' + this.id ).attr( 'name' );
					$( 'input:radio[name = ' + name + ']' ).removeAttr( 'checked' )
						.each(function() {
							$( '.camp-radio#' + this.id ).attr( 'src', camp_path + 'radio.jpg' );
						});
					$( '.camp-radio#' + this.id ).attr( 'src', camp_path + 'radio-checked.jpg' );
					$( 'input:radio#' + this.id ).attr( 'checked', true );
				}
				$( this ).css( 'opacity', '1' );

			},
			mouseenter: function() {
				if ( ! $( 'input:radio#' + this.id ).attr( 'checked' ) ) {
					$( '.camp-radio#' + this.id ).attr( 'src', camp_path + 'radio-checked.jpg' )
						.css( 'opacity', '0.5' );
				}
			},
			mouseleave: function() {
				if ( ! $( 'input:radio#' + this.id ).attr( 'checked' ) ) {
					$( '.camp-radio#' + this.id ).attr( 'src', camp_path + 'radio.jpg' )
						.css( 'opacity', '1' );
				}
			}
		});

		/* Checkbox */
		var camp_checkboxId = 0;
		$( 'input:checkbox' ).each(function() {
			if ( ! this.id ) {
				$( this ).attr( 'id', 'camp-checkbox-' + camp_checkboxId );
				camp_checkboxId++;
			}
			$( this ).css( 'display', 'none' );
			$( this ).after( '<img id = "' + this.id + '" class = "camp-checkbox" src = "' + camp_path + 'checkbox.jpg" alt = "Checkbox" />' );
			if ( $( this ).attr( 'checked' ) ) {
				$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox-checked.jpg' );
			} else {
				$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox.jpg' );
			}	
		});

		$( '.camp-checkbox' ).on( {
			click: function() {
				if ( $('input:checkbox#' + this.id ).attr( 'checked' ) ) {
					$( 'input:checkbox#' + this.id ).removeAttr( 'checked' );
					$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox.jpg' );
				} else {
					$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox-checked.jpg' );
					$( 'input:checkbox#' + this.id ).attr( 'checked', true );
				}
				$( this ).css( 'opacity', '1' );

			},
			mouseenter: function() {
				if ( ! $( 'input:checkbox#' + this.id ).attr( 'checked' ) ) {
					$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox-checked.jpg' )
						.css( 'opacity', '0.5' );
				}
			},
			mouseleave: function() {
				if ( ! $( 'input:checkbox#' + this.id ).attr( 'checked' ) ) {
					$( '.camp-checkbox#' + this.id ).attr( 'src', camp_path + 'checkbox.jpg' )
						.css( 'opacity', '1' );
				}
			}
		});

		/* Upload File */
		var camp_uploadId = 0;
		$( 'input:file' ).wrap( '<div class = "camp-upload-file"></div>' )
			.each(function() {
				if ( ! this.id ) {
					$( this ).attr( 'id', 'camp-upload-' + camp_uploadId );
					camp_uploadId++;
				}
				$( this ).css( 'display', 'none' );	
				$( this ).attr( 'name', 'file' );
				$( this ).after( '<label class = "camp-upload-lbl" id = "' + this.id + '" for = "' + this.id + '">File is not selected</label>' );
				$( this ).after( '<img class = "camp-upload-img" id = "' + this.id + '"" src = "' + camp_path + 'upload.jpg" alt = "Upload" />' );
			});

		$( '.camp-upload-img' ).click(function() {
			$( 'input:file#' + this.id ).click();
		});

		$( 'input:file' ).change(function() {
			$( 'label.camp-upload-lbl#' + this.id ).text( $( this ).val().split( '\\' ).pop() );
		});

		/* Blockquote */
		$( 'blockquote' ).prepend( '<img class = "camp-quote" src = "' + camp_path + 'quote.jpg" alt = "Quote" />' );

		/* Clear Button */
		$( 'input:reset' ).click(function() {
			var parrentForm = $( this ).parents( 'form' );
			$( parrentForm ).find( '.camp-select' ).each(function() {
				$( 'p.camp-header-text#' + this.id ).text( 'Select element' );
				$( this ).children( 'li' ).hide();
			});
			$( parrentForm ).find( '.camp-radio' ).attr( 'src', camp_path + 'radio.jpg' );
			$( parrentForm ).find( '.camp-checkbox' ).attr( 'src', camp_path + 'checkbox.jpg' );
			$( parrentForm ).find( 'input' ).removeAttr( 'checked' );
			$( parrentForm ).find( '.camp-upload-lbl' ).text('File is not selected');
		});
	})
})(jQuery);