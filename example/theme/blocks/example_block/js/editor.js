;( function ( wp ) {
	
	const { __ } = wp.i18n;
	const { createElement , Fragment } = wp.element;
	const { InspectorControls , BlockControls , RichText } = wp.blockEditor;
	const { TextControl , BaseControl , PanelBody } = wp.components;
	const el = createElement;

	wp.blocks.registerBlockType( blockSettings.name , {

		title : 		blockSettings.title , 
		icon : 			blockSettings.icon , 
		category : 		blockSettings.category , 
		attributes : 	blockSettings.attributes , 
		
		supports : { anchor : true , } , 
		transforms : { from: [ { type : 'block' , blocks : [ 'core/paragraph' ] , isMultiBlock : false , transform : ( attributes ) => { return wp.blocks.createBlock( 'common/example_block', attributes ); } , } , ] , to: [ { type: 'block' , blocks: [ 'core/paragraph' ] , transform : ( attributes ) => { return wp.blocks.createBlock( 'core/paragraph', attributes ); } , } , ] } ,
		
		edit : ( props ) => {
			
			return el( Fragment , null , 

				el( BlockControls , null ) , 
				
				el( InspectorControls , null , 
					el( PanelBody , { title : __( 'Example block' , 'foo_domain' ) , } , 
						
						el( BaseControl , { label : __( 'Content' , 'foo_domain' ) } , 
							el( TextControl , { 
								value : props.attributes.content , 
								onChange : ( value ) => { props.setAttributes( { content : value } ); } , 
							} ) , 
						) ,
					
					) , 
				) , 

				el( RichText , {
					tagName : 'p' , 
					placeholder : __( 'Write some awesome content!' , 'foo_domain' ) , 
					value : props.attributes.content , 
					onChange : ( value ) => { props.setAttributes( { content : value } ); } , 
					multiline : false , 
				} )  , 
			
			);

		} , 
		
		save : ( { attributes } ) => {
			
			return el( RichText.Content , { tagName : 'p' , value : attributes.content , } );
			
		} , 

	} );

} )( window.wp );