<?php
class JSONMsg //define format of json communication
{
	private $header, $body;
	public function __construct($errCode = 0, $errMsg = '', $content = array(), $header = array())
	{
		$this->header = array("errCode" => $errCode, "errMsg" => $errMsg);
		$this->header = array_merge($this->header, $header);
		$this->body = is_array($content)?$content:array($content);
	}
	public function publish()
	{
		echo json_encode(array("header" => $this->header, "body" => $this->body));
	}
	public function addHeader($header){
		array_merge($this->header, $header);
	}
	public function setHeader(Error $e){
		$this->header['errCode'] = $e->getCode();
		$this->header['errMsg'] = $e->getMessage();
	}
	public function setErrorCode($code){
		$this->header['errCode'] = intval($code);
	}
	public function setErrorMessage($msg){
		$this->header['errMsg'] = $msg;
	}
	public function setBody($body){
		$this->body = is_array($body)?$body:array($body);
	}
}
?>
