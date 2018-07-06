<?php
error_reporting(E_ALL ^ E_DEPRECATED);

//此类完成对数据库的操作  打印出数据的格式，在慢慢调试。
class sqlhelper{
	private $conn;
	private $dbname=""; // 数据库名
	private $username=""; // 数据库账号
	private $password=""; // 数据库密码
	private $host=""; // 主机名
	private $port=""; // 端口

	//连接数据库
	//这是一个构造方法，若果创建了new sqlhelper之后即可自动调用
    public function __construct($dbname, $username, $password, $host, $port){  
        
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;

		$this->conn=mysqli_connect($this->host.':'.$this->port,$this->username,$this->password);
		if(!$this->conn){
		    die("连接数据库失败".mysqli_errno());
        }
        mysqli_set_charset($this->conn, 'utf8') or die(mysqli_errno());
        mysqli_select_db($this->conn, $this->dbname) or die(mysqli_errno());    
	}


	//插入功能
	//$table表名字，$array数据表中的元素，$newarray插入的值
	//第一次数组设置错误，应该是'stusername'=>$_POST['stusername'] 这样就不需要设置2个数组
	function insert($table,$array){
		$keys=join(",",array_keys($array));
		$vals="'".join("','",array_values($array))."'";
		$sql = "INSERT INTO {$table} ({$keys}) VALUES ({$vals})";
		//var_dump($keys);
		//var_dump($vals);
		//echo $sql;
        mysqli_query($sql);
        //var_dump(mysql_insert_id()); //返回插入的行数,要设置主键且排序才返回
        //return mysql_insert_id();
        return mysqli_affected_rows();	
	}

	//更新功能
	//不是根据序号查找信息，应该  $where ="User_NickName = '".$nikename."'"; 缺少''
	function update($table,$array,$where=null){
		$str=null;
		foreach ($array as $key=>$val){
			if($str==null){
				$sep="";
			}else{
				$sep=",";
			}
			$str.=$sep.$key."='".$val."'";			
		}
			// var_dump($str);
			// var_dump($where);
			$sql="update {$table} set {$str}".($where==null?null:" where ".$where.";");
			// echo $sql;
			mysqli_query($this->conn, $sql);
			// var_dump(mysql_affected_rows()); //返回影响的行数
	        return mysqli_affected_rows($this->conn);
	}

	//删除
	function delete($table,$where=null){
		$where=$where==null?null:"where ".$where;
		//var_dump($where);  
		$sql="delete from {$table} {$where}".";";
		//print_r($sql);//exit();
		mysqli_query($sql);
		return mysqli_affected_rows();	
	}


	//查找一条信息
	function fetchone($sql,$result_type=MYSQL_ASSOC){
		//MYSQL_ASSOC只得到关联索引
		//print_r($sql);exit();
		$result=mysqli_query($sql);
		$row=mysqli_fetch_array($result,$result_type);
		//var_dump($row);  //直接 echo $row['stid'] 就出现里面的数据
		return $row;
	}

	//取出所有数据
	function fetchall($sql,$result_type=MYSQL_ASSOC){
		$result=mysqli_query($sql);
		while($row=mysqli_fetch_array($result,$result_type)){
			$rows[]=$row;
		}
		//var_dump($rows);
		//var_dump($rows[0]['name']);
		return $rows;
	}

	//得到结果集中的条数
	function getResultNum($sql){
		// var_dump($sql);
		$result=mysqli_query($sql);
		//echo mysql_num_rows($result);	
		return mysqli_num_rows($result);	
	}


	//关闭数据库连接
	public function close_connect(){
		if(!empty($this->conn)){
			mysqli_close($this->conn);
		}
	}

}
?>
