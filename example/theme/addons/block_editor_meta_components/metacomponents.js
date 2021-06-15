;( function ( wp ) {

	wp.components = { 
		...wp.components , 
		...{

			MetaDateTimePicker : wp.compose.compose( wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , )( ( props ) => { return wp.element.createElement( wp.components.DateTimePicker , { ...props , ...{ currentDate : props.metaValue || props.default , onChange : ( value ) => { props.setMetaValue( value ); } } } ); } ) , 
			
			MetaDatePicker : wp.compose.compose( wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , )( ( props ) => { return wp.element.createElement( wp.components.DatePicker , { ...props , ...{ currentDate : props.metaValue || props.default , onChange : ( value ) => { props.setMetaValue( value ); } } } ); } ) , 
			
			MetaColorPalette : wp.compose.compose( wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , )( ( props ) => { return wp.element.createElement( wp.components.ColorPalette , { ...props , ...{ value : props.useSlug ? ( wp.blockEditor.getColorObjectByAttributeValues( props.colors , props.metaValue ).color || wp.blockEditor.getColorObjectByAttributeValues( props.colors , props.default ).color ) : ( props.metaValue || props.default ) , onChange : ( value ) => { props.setMetaValue( ( props.useSlug ? wp.blockEditor.getColorObjectByColorValue( props.colors , value ).slug : value ) ); } } , } ); } ) , 
			
			MetaComboboxControl : wp.compose.compose( wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , )( ( props ) => { return wp.element.createElement( wp.components.ComboboxControl , { ...{ onFilterValueChange : () => {} , } , ...props , ...{ value : props.metaValue , onChange : ( value ) => { props.setMetaValue( value ); } , } , } ); } ) , 

			/* MetaPopoverDatePicker */
			MetaPopoverDatePicker : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , 
				wp.compose.withState( { isVisible : false } ) 
			)
			( ( props ) => { 
				
				var el = wp.element.createElement;
				var { DatePicker , TimePicker , DateTimePicker , Button , Popover , PanelRow } = wp.components;
				var togglePopover = () => { props.setState( ( state ) => ( { isVisible : !state.isVisible } ) ); }
				return el( 'div' , { className : 'wp-metacompontents-metapopoverdatepicker' } ,  
					el( Button , { 
						...{ 
							onClick : togglePopover 
						} , 
						...props.button 
					} , 
					[ 
						props.metaValue ? wp.date.date( ( props.button.dateFormat || 'Y-m-d' ) , props.metaValue ) : props.button.label , 
						props.isVisible && ( el( Popover , props.popover , [ 
							props.popover.title && ( el( 'p' , { style : { 'font-weight' : 'bold' , 'text-align' : 'center' } } , props.popover.title ) ) , 
							el( DatePicker , { 
								currentDate : props.metaValue || false , 
								onChange : ( value ) => { 
									props.setMetaValue( wp.date.date( 'Y-m-d' , value ) ); 
									togglePopover();
								} 
							} , null ) , 
							props.clearButton && (
								el( 'div' , { style : { 'display' : 'flex' , 'justify-content' : 'space-between' , 'align-items' : 'center' , 'margin' : '0' , 'padding' : '10px 20px' } } , 
									[ 
										el( Button , { 
												...{ 
													isLink : true , 
													onClick : () => { props.setState( null ); } 
												} , 
												...props.closeButton
											} , 
											props.closeButton.label 
										) , 
										el( Button , { 
												...{ 
													isLink : true , 
													onClick : () => { props.setMetaValue( null ); } 
												} , 
												...props.clearButton
											} , 
											props.clearButton.label 
										) 
									]
								)
							)
						] ) ) 
					] ) 
				); 
			} ) , 

			/* MetaPopoverTimePicker */
			MetaPopoverTimePicker : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , 
				wp.compose.withState( { isVisible : false } ) 
			)
			( ( props ) => { 
				
				var el = wp.element.createElement;
				var { DatePicker , TimePicker , DateTimePicker , Button , Popover , PanelRow } = wp.components;
				var togglePopover = () => { props.setState( ( state ) => ( { isVisible : !state.isVisible } ) ); }
				return el( 'div' , { className : 'wp-metacompontents-metapopovertimepicker' } ,  
					el( Button , { 
						...{ 
							onClick : togglePopover 
						} , 
						...props.button 
					} , 
					[ 
						props.metaValue ? wp.date.date( ( props.button.dateFormat || 'Y-m-d' ) , props.metaValue ) : props.button.label , 
						props.isVisible && ( el( Popover , props.popover , [ 
							props.popover.title && ( el( 'p' , { style : { 'font-weight' : 'bold' , 'text-align' : 'center' } } , props.popover.title ) ) , 
							el( TimePicker , { 
								currentDate : props.metaValue || false , 
								onChange : ( value ) => { 
									props.setMetaValue( wp.date.date( 'Y-m-d' , value ) ); 
									togglePopover();
								} 
							} , null ) , 
							props.clearButton && (
								el( 'div' , { style : { 'display' : 'flex' , 'justify-content' : 'space-between' , 'align-items' : 'center' , 'margin' : '0' , 'padding' : '10px 20px' } } , 
									[ 
										el( Button , { 
												...{ 
													isLink : true , 
													onClick : () => { props.setState( null ); } 
												} , 
												...props.closeButton
											} , 
											props.closeButton.label 
										) , 
										el( Button , { 
												...{ 
													isLink : true , 
													onClick : () => { props.setMetaValue( null ); } 
												} , 
												...props.clearButton
											} , 
											props.clearButton.label 
										) 
									]
								)
							)
						] ) ) 
					] ) 
				); 
			} ) , 

			/* MetaPopoverDateTimePicker */
			MetaPopoverDateTimePicker : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) , 
				wp.compose.withState( { popoverVisible : false } ) 
			)
			( ( props ) => { 
				
				var __ = wp.i18n.__;
				var el = wp.element.createElement;
				var { DateTimePicker , Button , Popover } = wp.components;
				
				return el( 'div' , { className : 'components-meta-popover-datetimepicker' } , 
					el( Button , 
						{ 
							...props.button , 
							...{ 
								onClick : () => { props.setState( { popoverVisible : !props.popoverVisible } ); } 
							} 
						} , 
						props.metaValue ? wp.date.date( ( props.button.dateFormat || 'Y-m-d H:i' ) , props.metaValue ) : ( __( props.button.label ) || __( 'Select' ) )
					) , 
					props.popoverVisible && el( Popover , props.popover , 
						
						el( 'div' , { style : { 'padding' : '10px' , 'width' : '270px' } } , 
							
							props.popover && [ el( 'p' , { className : 'components-meta-popover-datetimepicker--popover-title' } , props.popover.title ) , el( 'hr' ) ] , 

							el( DateTimePicker , 
								{ 
									...props.dateTimePicker , 
									...{
										currentDate : props.metaValue || false , 
										onChange : ( value ) => { props.setMetaValue( wp.date.date( 'Y-m-d H:i' , value ) ); } 
									}
								}
							) , 
							
							el( 'div' , 
								{ 
									className : 'components-meta-popover-datetimepicker--popover-close-clear' , 
									style : { 'display' : 'flex' , 'justify-content' : 'space-between' , 'align-items' : 'center' , 'margin' : '0' , 'padding' : '10px 0' } 
								} , 
								
								props.closeButton !== false && el( Button , 
									{ 
										...{
											isLink : true , 
										} , 
										...props.closeButton , 
										...{ 
											onClick : () => { props.setState( ( state ) => ( { popoverVisible : false } ) ); } 
										} , 
									} , 
									__( props.closeButton.label ) || __( 'Close' )
								) , 

								props.clearButton !== false && el( Button , 
									{ 
										...{
											isLink : true , 
											isDestructive : true
										} , 
										...props.clearButton , 
										...{ 
											onClick : () => { props.setMetaValue( null ); } 
										} , 
									} , 
									__( props.clearButton.label ) || __( 'Clear selection.' )
								) , 

							)

						)

					)
				);

			} ) , 

			/* MetaTextControl */
			/* Can recieve any property from TextControl, however, value and onChange will be overridden. */
			MetaTextControl : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				var { TextControl } = wp.components;
				return el( TextControl, { 
					...props , 
					...{
						value: props.metaValue , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaTextareaControl */
			/* Can recieve any property from TextareaControl, however, value and onChange will be overridden. */
			MetaTextareaControl : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				var { TextareaControl } = wp.components;
				return el( TextareaControl, { 
					...props , 
					...{
						value: props.metaValue , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaRadioControl */
			/* Same properties as RadioControl, but with added default functionality. */
			MetaRadioControl : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				var { RadioControl } = wp.components;
				return el( RadioControl , { 
					...props , 
					...{
						selected : props.metaValue || props.default , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaCheckboxControl */
			/* Same properties as CheckboxControl, but with added default functionality. */
			MetaCheckboxControl : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				var { CheckboxControl } = wp.components;
				return el( CheckboxControl , { 
					...props , 
					...{
						checked : props.metaValue || props.default , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaSelectControl */
			/* Same properties as SelectControl */
			MetaSelectControl : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				var { SelectControl } = wp.components;
				return el( SelectControl , { 
					...props , 
					...{
						value : props.metaValue , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaRichText */
			/* Same properties as RichText */
			MetaRichText : wp.compose.compose( 
				wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , 
				wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) 
			)
			( ( props ) => { 
				var el = wp.element.createElement;
				const { RichText } = wp.blockEditor;
				return el( RichText , { 
					...props , 
					...{
						value : props.metaValue , 
						onChange : ( value ) => { props.setMetaValue( value ); }
					}						
				} ); 
			} ) , 

			/* MetaLinkControl */
			/* Same properties as __experimentalLinkControl, may get changed in the future!!! */
			/* NB: Value is stored as stringified JSON as WP is not willing to store the plain object */
			MetaLinkControl : wp.compose.compose( wp.data.withDispatch( function( dispatch , props ) { return { setMetaValue : function( metaValue ) { dispatch( 'core/editor' ).editPost( { meta: { [ props.metaKey ] : metaValue } } ); } } } ) , wp.data.withSelect( function( select , props ) { return { metaValue : select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metaKey ] , } } ) )( ( props ) => { return wp.element.createElement( wp.blockEditor.__experimentalLinkControl , { ...props , ...{ value : props.metaValue ? JSON.parse( props.metaValue ) : null , onChange : ( value ) => { props.setMetaValue( JSON.stringify( value ) ); } , } } ); } ) , 
		
		}
	};

} )( window.wp )