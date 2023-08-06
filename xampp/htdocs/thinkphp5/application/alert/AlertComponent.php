<?php
namespace app\alert;

/**
 * 
 * 弹窗组件 
 * 
 * */
class AlertComponent {

	/**
	 * 
	 * 成功跳转
	 * @param @defaultUrl 默认跳转的地址(
	 * 如果$ignoreHttpReferer为true时，将直接跳转到该地址；
	 * 如果$ignoreHttpReferer为false时，将优先跳转HTTP_REFERER的地址
	 * @param $ignoreHttpReferer 是否忽略HTTP_REFERER的地址
	 * @return script字符串 
	 * */
	static function success($defaultUrl = 'index.php', $ignoreHttpReferer = false) {
		$httpReferer = $_SERVER['HTTP_REFERER'];
	    if (is_null($httpReferer) || $ignoreHttpReferer === true) {
	       $httpReferer = $defaultUrl;
	    }

	    extract(['referer' => $httpReferer]);
    	ob_start();
    	include('view/success.js');
    	$result = ob_get_clean();
    	return $result;
	}

	static function error($message) {
		extract(['message' => $message]);
		ob_start();
    	include('view/error.js');
    	return ob_get_clean();
	}

}