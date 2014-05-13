<?php 

class Url extends Eloquent{

	protected $fillable = array('url', 'shortened');

	public $timestamps = false; // tem que desabilitar senao da erro, pois nao foi criado na tabela

	public static $rules = array('url' => 'required|url');

	public static function validate($input)
	{
		$v = Validator::make($input, static::$rules);
		return $v->fails() ? $v : true;
	}


	public static function get_unique_short_url(){
		$shortened = base_convert(rand(10000, 99999), 10, 36); // base 62 // uppercase, lower etc...
		
		if (static::whereShortened($shortened)->first() )
		{
			return static::get_unique_short_url();
		}
		
		return $shortened;
	}


}