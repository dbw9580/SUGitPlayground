<?php
class DatabaseDef
{
	const USERNAME = "root";
	const PASSWORD = "";
	const DSN = "mysql:host=localhost;dbname=;charset=utf8";
	const DB_NAME = "su";
	const TABLE_SERVICE_NAME = "service";
	const TABLE_WORKER_NAME = "worker";
	const TABLE_SERVICE_INFO_NAME = "service_info";
	
	const TABLE_SERVICE_FIELD_ID = "id";
	const TABLE_SERVICE_FIELD_STATE = "state";
	const TABLE_SERVICE_FIELD_FROM_CLUB = "from_club";
	const TABLE_SERVICE_FIELD_INVOICE = "total_invoice";
	const TABLE_SERVICE_FIELD_CONFIRMED = "total_confirmed";
	const TABLE_SERVICE_FIELD_DESCRIPTION = "description";
	const TABLE_SERVICE_FIELD_C_TIME = "created_time";
	const TABLE_SERVICE_FIELD_U_TIME = "last_updated_time";
	
	const TABLE_WORKER_FIELD_ID = "id";
	const TABLE_WORKER_FIELD_NAME = "name";
	const TABLE_WORKER_FIELD_PASS = "pass";
	const TABLE_WORKER_FIELD_ENABLED = "enabled";
	const TABLE_WORKER_FIELD_CLEARANCE = 'clearance';
	
	const TABLE_SERVICE_INFO_FIELD_ID = "id";
	const TABLE_SERVICE_INFO_FIELD_SERVICE_ID = "service_id";
	const TABLE_SERVICE_INFO_FIELD_AUDIT_FAIL_REASON = "audit_fail_reason";
	const TABLE_SERVICE_INFO_FIELD_INVOICE_DISPOSAL = "invoice_disposal";
	
	private /*PDO*/$dataBaseConnection;
	/*returns the sole instance of connection each time a new DatabaseDef instance is constructed*/
	static private $soleInstance;
	
	static public function makePassword($origin)
	{
		if(strlen($origin) >= 6){
			$salt = ['@1%v','A0c&','d24*']; 
			$p = str_split($origin, (int)ceil(strlen($origin)/3));
			$res = $p[0].$salt[0].$p[1].$salt[1].$p[2].$salt[2];
			return md5(sha1($res));
		}else{
			throw new Error(Error::ErrBadPasswordLength);
		}
	}
	
	public function __construct()
	{
		if(self::$soleInstance instanceof PDO){
			$this->dataBaseConnection = self::$soleInstance;
		}else{
			try{
				self::$soleInstance = new PDO(self::DSN, self::USERNAME, self::PASSWORD);
				self::$soleInstance->query('SET CHARACTER SET \'utf8\'');
				self::$soleInstance->query('SET NAMES \'utf8\'');
				self::$soleInstance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->dataBaseConnection = self::$soleInstance;
			}
			catch(PDOException $e){
				throw new Error(Error::ErrDatabaseConnectionFailure, '', [$e->getCode(), $e->getMessage()]);
			}
		}
	}
	
	public function closeConnection()
	{
		$this->dataBaseConnection = null;
	}
	
	public function getConnection()
	{
		return $this->dataBaseConnection;
	}
}


?>