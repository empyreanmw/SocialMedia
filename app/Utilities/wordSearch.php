<?php 

namespace App\Utilities;

class wordSearch
{
	static function get($string, $startingLetter)
	{
		$splitStrings = explode(' ', $string);
		$words = array();

		foreach ($splitStrings as $splitString)
		{
			if (starts_with($splitString, $startingLetter) && 
				!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', substr($splitString, 1))) //removing first letter bencuase it will trigger preg_match
			{
				$words[] = substr($splitString, 1); //removing first letter which is #
			}
		}

		return $words;
	}
}