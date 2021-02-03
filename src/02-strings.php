<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into a camel-cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
    $resultString = '';
    $wordsArray = explode('_', $input);
    foreach ($wordsArray as $elem) {
        $resultString .= ucfirst($elem);
    }
    return lcfirst($resultString);
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{
    $coding = mb_detect_encoding($input);
    $wordsArray = explode(' ', $input);
    $reversedWordsArray = array_map(
        function($word) use ($coding)
        {
            $reversedWord = '';
            for ($i = mb_strlen($word, $coding); $i >= 0; $i--) {
                $reversedWord .= (mb_substr($word, $i, 1, $coding));
            }
            return ($reversedWord);
        },
        $wordsArray);
    $resultString = implode(" ", $reversedWordsArray);
    return ($resultString);
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with the first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
	if ($noun[0] == $noun[strlen($noun)-1]) {
		return ucfirst($noun . substr($noun,1));
	}
	return ("The " . ucfirst($noun));
}