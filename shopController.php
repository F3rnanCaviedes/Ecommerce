<?php
require_once "../conexion.php";
/*
 * Example PHP implementation used for the REST example.
 * This file defines a DTEditor class instance which can then be used, as
 * required, by the CRUD actions.
 */

// DataTables PHP library
include( dirname(__FILE__)."vista/modules/DataTables/lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
$editor = Editor::inst( $conexion, 'producto' )
	->fields(
		Field::inst( 'tipo_producto' )
		->validator( Validate::numeric() )
		->setFormatter( Format::ifEmpty(null) ),
		) ),
			Field::inst( 'coleccion' )
		->validator( Validate::notEmpty( ValidateOptions::inst()
			->message( 'El nombre de la colección es necesario' )	
		) ),
			Field::inst( 'descripcion_producto' )
		->validator( Validate::notEmpty( ValidateOptions::inst()
			->message( 'el nombre del producto es necesario' )	
		) ),
		Field::inst( 'detalle_producto' )
		->validator( Validate::notEmpty( ValidateOptions::inst()
			->message( 'el detalle del producto es necesario' )	
		) ),
/*	Field::inst( 'email' )
		->validator( Validate::email( ValidateOptions::inst()
			->message( 'Please enter an e-mail address' )	
		) ),*/
	Field::inst( 'cantidad_producto' )
		->validator( Validate::numeric() )
		->setFormatter( Format::ifEmpty(null) ),
	Field::inst( 'precio_producto' )
		->validator( Validate::numeric() )
		->setFormatter( Format::ifEmpty(null) );
