此处的文件是当前用在服务器上的程序部件，包括：
	DatabaseDef.php - 数据库连接的定义
	Error.class.php - 错误类定义
	JSONMsg.class.php - 用于与前端交互的json messager
	main.php - 接受用户输入，处理业务流程
以及其他一些处理具体业务的类，不在此列出

南娱的项目将继续采用类似的结构，但各个部件的实现有待改善：
	数据库抽象层要实现数据库基本操作的封装；
	错误类应该根据不同层次的操作实现不同的错误类型（但共用全局的错误代码空间），例如DatabaseError, StrategyError, GeneralError等；
以及要实现一些新的部件：
	Strategy.class.php - 策略分析和计算
	Service.class.php - 服务层定义