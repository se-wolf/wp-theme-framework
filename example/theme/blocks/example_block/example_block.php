<?php

namespace Blocks;

if ( !defined( 'ABSPATH' ) ) exit;

class ExampleBlock extends \BlockFactory {

	static $block			=	__CLASS__;
	static $block_dir		=	__DIR__;

	static $title			=	'Example block';
	static $namespace       =   'common';
	static $slug            =   'example_block';
	static $icon			=	'block-default';
	static $ver				=	'1.0.0';

	static $attributes		=	array( 
		'content' => array( 'type' => 'string' , ) ,
	);

	static $editor_js		=	'js/editor.js';
	static $block_css		=	'css/block.css';

}

ExampleBlock::init();