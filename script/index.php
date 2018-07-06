<?php


require_once __DIR__.'/config.php';
require_once __DIR__.'/mysql.class.php';

// 全部（自动化脚本），指定（一篇），需要（自动化脚本，多篇）
// php index.php [--pull/-p]  --method/-m [all/select/need] --type/-t [article/work] --name/-n [name]  # 全部

$shortopts  = "";
$shortopts .= "m:";  // all select need
$shortopts .= "t:";  // articles works
$shortopts .= "n:";  // id
$shortopts .= "p::"; // pull

$longopts  = array(
    "method:",   // all select need
    "type:",     // article work
    "name:",       // id
    "pull::",    // pull
);
$options = getopt($shortopts, $longopts);
// var_dump($options);

$method = isset($options['m']) ? $options['m'] : (isset($options['method']) ? $options['method'] : false);
$type = isset($options['t']) ? $options['t'] : (isset($options['type']) ? $options['type'] : false);
$name = isset($options['n']) ? $options['n'] : (isset($options['name']) ? $options['name'] : false);
if (empty($method) || ($method != 'all' && (empty($type) || empty($name)))) {
    echo '缺少参数';
    return ;
}

if(isset($options['p']) || isset($options['pull'])) {
    // 拉取最新代码
    exec("git pull origin master", $res, $rc);
}


if($method == 'all') {
    // 全部
    $work = glob('work/*.md');
    $article = glob('article/*.md');
    $array = array_merge($work, $article);
    
    // 遍历，打开文件，更新数据
    for ($i = 0; $i < count($array); $i++) {
        $data = explode('/', $array[$i]);
        $content = getFileContent($data[0], $data[1]);
        $result = updateContent($config, $data[0], $data[1], $content);
        judgeError($data[0], $data[1]);
    }
} elseif ($method == 'select') {
    if(is_array($type)) {
        // 遍历，打开文件，更新数据
        for ($i = 0; $i < count($type); $i++) {
            $content = getFileContent($type[$i], $name[$i]);
            $result = updateContent($config, $type[$i], $name[$i], $content);
            judgeError($type[$i], $name[$i]);
        }
    } else {
        // 打开文件，更新数据
        $content = getFileContent($type, $name);
        $result = updateContent($config, $type, $name, $content);
        judgeError($type, $name);
    }
}

/**
 * 获取文件内容
 */
function getFileContent($type, $name) {
    $result = '';
    $myfile = fopen("{$type}/{$name}", "r") or die("Unable to open file!");
    while(!feof($myfile)) {
        $result .= fgets($myfile);
    }
    fclose($myfile);
    return $result;
}

/**
 * 更新到数据库
 */
function updateContent($config, $type, $name, $content) {
    // 更新
    $table = $type;
    $array = array('content'=>$content);
    $name = explode('-', $name);
    $where = "id = {$name[0]}";
    $sqlhelper = new sqlhelper($config['db']['dbname'],$config['db']['username'],$config['db']['password'],$config['db']['host'],$config['db']['port']);
    $affectedRows = $sqlhelper->update($table,$array,$where);
    $sqlhelper->close_connect();
    return $affectedRows;
}

function judgeError($type, $name) {
    echo $result == -1 ? "{$type}/{$name} : error \n" : "{$type}/{$name} : {$result} \n";
}

