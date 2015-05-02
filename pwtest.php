<?php

/**
 *
 * @simple function to test password strength
 *
 * @param string $password
 *
 * @return int 
 *
 * http://www.phpro.org/examples/Password-Strength-Tester.html
 */
function testPassword($password)
{
    if ( strlen( $password ) == 0 )
    {
        return 1;
    }

    $strength = "0";

    /*** get the length of the password ***/
    $length = strlen($password);

    /*** check if password is not all lower case ***/
    if(strtolower($password) != $password)
    {
        $strength += 1;
    }
    
    /*** check if password is not all upper case ***/
    if(strtoupper($password) == $password)
    {
        $strength += 1;
    }

    /*** check string length is 8 -15 chars ***/
    if($length >= 8 && $length <= 15)
    {
        $strength += 1;
    }

    /*** check if lenth is 16 - 35 chars ***/
    if($length >= 16 && $length <=35)
    {
        $strength += 5;
    }

    /*** check if length greater than 35 chars ***/
    if($length > 10)
    {
        $strength += 3;
    }
    
    /*** get the numbers in the password ***/
    preg_match_all('/[0-9]/', $password, $numbers);
    $strength += count($numbers[0]);

    

    /*** get the number of unique chars ***/
    $chars = str_split($password);
    $num_unique_chars = sizeof( array_unique($chars) );
    $strength += $num_unique_chars * 2;

    /*** strength is a number 1-10; ***/
    $strength = $strength > 99 ? 99 : $strength;
    $strength = floor($strength / 10 + 1);

	return $strength;	
	}



	$pwfeedback="";

	function testStrength($pwfeedback) {
	if ($strength = 5)
	{
		$pwfeedback = "<p class=\"text-yellow\">Svagt lösenord!</p>";
	}
		if ($strength = 6)
		{
			
		$pwfeedback = "<p class=\"text-yellow\">OK lösenord!</p>";
		
		}
		
		if ($strength = 8)
		{
			
		$pwfeedback = "<p class=\"text-yellow\">Starkt lösenord!</p>";
		
		}
	
	
	
	return $pwfeedback;
}
	/*** example usage ***/
$password = 'PhP56TutorialsAndExamPles123AndMoreTo9027561';
echo testPassword($password);
/* $pwfeedback = $pwfeedback; */
echo testStrength($pwfeedback);

?>