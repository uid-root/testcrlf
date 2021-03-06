#!/usr/bin/php
<?php

/**
 * I don't believe in license
 * You can do want you want with this program
 * - gwen -
 */

function __autoload( $c ) {
	include( __DIR__.'/'.$c.'.php' );
}


// parse command line
{
	$testcrlf = new TestCrlf();

	$argc = $_SERVER['argc'] - 1;

	for ($i = 1; $i <= $argc; $i++) {
		switch ($_SERVER['argv'][$i]) {
			case '-h':
				Utils::help();
				break;

			case '-l':
				$testcrlf->listPayloads();
				break;

			case '-o':
				$testcrlf->setHost($_SERVER['argv'][$i + 1]);
				$i++;
				break;

			case '-p':
				$testcrlf->setProtocol($_SERVER['argv'][$i + 1]);
				$i++;
				break;

			case '-r':
				$testcrlf->setRedirect( true );
				break;

			case '-s':
				$testcrlf->setSsl( true );
				break;

			default:
				Utils::help('Unknown option: '.$_SERVER['argv'][$i]);
		}
	}

	if( !$testcrlf->getHost() ) {
		Utils::help('Host not found!');
	}
}
// ---


// main loop
{
	$testcrlf->run();
}
// ---


exit();

?>
