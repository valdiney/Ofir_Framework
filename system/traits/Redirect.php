<?php

/**
* This trait is used to Redirect the page
*
* @param path : string : Name of the controller and name of the method of the controller
* @param vareables : mixed : Name of the variable and values of the variables via HTTP-GET
* @return url of the destination page
*/

trait Redirect
{
    public function to($path = false, $variables = false)
    {
        $path = str_replace(".", "=", $path);
        $complete_path = GeneratingPerfectURL::generatingPerfectURL($path, $variables);
        header("Location:?{$complete_path}&p=1");
    }

    public static function back($variables = false)
    {
        $server = $_SERVER['HTTP_REFERER'];
        $extract_question_mark = explode('?', $server);
        $extract_again = explode('&p=', $extract_question_mark[1]);

        $path = $extract_again[0];
        header("Location:?{$path}&p=1");
    }
}
