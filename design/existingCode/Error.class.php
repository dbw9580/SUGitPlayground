<?php
class Error extends Exception
{
	/***Error Code Def**/
	const ErrSuccess = 0;
		/***Error Code with Clearance**/
	const ErrBadClearance = 101;
	const ErrUserNotAuthed = 102;
	const ErrWrongPass = 103;
	const ErrUserNotExists = 104;
		/***Error Code with Database**/
	const ErrDatabaseUpdateFailure = 401;
	const ErrDatabaseConnectionFailure = 400;
	const ErrDatabaseQueryFailure = 402;
	const ErrDataBaseDeleteFailure = 403;
	const ErrDataBaseInsertFailure = 404;
	const ErrDataBaseOtherException = 405;
	
	const ErrNoResult = 300;
		/***Commom error code**/
	const ErrBadParam = 200;
		/*** Error with certian startegy ***/
	const ErrViolationOfStrategy = 500;
	const ErrBadPasswordLength = 501;
	private $debugInfo;
	static private $error_msg = array(
										0 => 'ok',
										101 => 'bad clearance',
										102 => 'user is not authed',
										103 => 'wrong password',
										104 => 'user does not exist',
										401 => 'unable to update database',
										400 => 'unable to connect to database',
										402 => 'data to be fetched does not exist',
										403 => 'data to be deleted does not exist',
										404 => 'unable to insert into table',
										405 => 'database error occurred',
										300 => 'no results for such query conditions',
										200 => 'bad param',
										500 => 'operation violated system strategy',
										501 => 'bad password length'
										);
	
	/*protected $message, $code: inherited from PHP internal class Exception*/
	public function __construct($code, $message = '##', $debugInfo = [])
	{
		parent::__construct();
		//$this->message = $message;
		if($message === '##'){
			$this->message = Error::$error_msg[$code]."@file:".$this->getFile().",line:".$this->getLine();
		}else{
			$this->message = $message."@file:".$this->getFile().",line:".$this->getLine();
		}
		$this->code = $code;
		$this->debugInfo = array($debugInfo, $this->getLine(), $this->getFile());
	}
	public function getDebugInfo()
	{
		return $this->debugInfo;
	}
}

?>