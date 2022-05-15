<?php

/**
 * Visitor Statistics 访客量统计
 *
 * @package VisitorStatistics
 * @author jiefei30
 * @version 1.0.0
 * @link https://makeyourchoice.cn
 */
class VisitorStatistics_Plugin implements Typecho_Plugin_Interface
{
    protected static $pluginName = "VisitorStatistics";

    /* 激活插件方法 */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('VisitorStatistics_Plugin', 'updateVisitors');
        return 'The plugin is installed successfully, please enter the settings and set the initial value';
    }

    /* 禁用插件方法 */
    public static function deactivate()
    {
        return 'Plugin uninstalled successfully';
    }
	
	/* 插件配置方法 */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $visitors = new Typecho_Widget_Helper_Form_Element_Text("visitors", null, '0', '访问量：', '网站初始访问量，默认为0');
        $form->addInput($visitors);
    }
	
	/* 个人用户的配置方法 */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
        // TODO: Implement personalConfig() method.
    }

    /**
     * 更新访问量
     * @throws Typecho_Db_Exception
     * @throws Typecho_Exception
     * @author jiefei30
     */
    public static function updateVisitors()
    {
        if (Typecho_Widget::widget('Widget_Archive')->is('single')) {
            $options = Helper::options();
            $pluginConfig = $options->plugin(self::$pluginName);
            $visitors = $pluginConfig->visitors;
            $visitors++;
            //更新浏览量
            Helper::configPlugin(self::$pluginName, array('visitors' => $visitors));
        }
    }

    /**
     * print visitors' value
     * usage: VisitorStatistics_Plugin::getVisitorStatistics();
     * print: '12,628'
     * usage: VisitorStatistics_Plugin::getVisitorStatistics('访问量','次');
     * print：'访问量 XX 次'
     *
     * @param string $prefix
     * @param string $suffix
     * @throws Typecho_Db_Exception
     * @author jiefei30
     */
    public static function getVisitorStatistics($prefix = '', $suffix = '')
    {
        $options = Helper::options();
        $pluginConfig = $options->plugin(self::$pluginName);
        $visitors = $pluginConfig->visitors;
		// 10000 --> 10,000
		$arr = str_split($visitors . "");
		$res = "";
		$length = count($arr);
		for ($i = 1; $i <= $length; $i++)
		{
		    $res = $arr[$length - $i] . $res;
			if ($i % 3 == 0 && $i != $length) 
			{
				$res = "," . $res;
			}
		}
        echo $prefix . $res . $suffix;
    }
}