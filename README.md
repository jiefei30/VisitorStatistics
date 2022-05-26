# VisitorStatistics
typecho 博客插件——网站访客量统计
# 使用方法
- 代码clone下来之后，将VisitorStatistics文件夹直接放入`/usr/plugins`下
- 进入typecho后台启用插件，在设置中设置初始访问量，默认为0
- 使用方法：`VisitorStatistics_Plugin::getVisitorStatistics();`
- 例如，在相应的php页面下加上`<?php echo VisitorStatistics_Plugin::getVisitorStatistics(); ?>`便可输出访客量，如 `120,622`

或者为`<?php echo VisitorStatistics_Plugin::getVisitorStatistics('访客量: ',' 次'); ?>`，则输出 `访客量: 120,622 次`
# 和 Handsome 主题搭配
- 修改主题页面文件内容:
修改`/usr/themes/handsome/component/sidebar.php`，找到这`<ul class="list-group box-shadow-wrap-normal">`（博客信息 section）：
在ul里的末尾加上一个li标签：
```html
<li class="list-group-item text-second"><span class="blog-info-icons"> <i data-feather="users"></i></span> <span
                       class="badge
           pull-right"><?php echo VisitorStatistics_Plugin::getVisitorStatistics(); ?></span><?php _me("访客总数") ?></li>
```

即：

```html
<ul class="list-group box-shadow-wrap-normal">
           <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
           <li class="list-group-item text-second"><span class="blog-info-icons"> <i data-feather="award"></i></span> <span
                       class="badge
           pull-right"><?php $stat->publishedPostsNum() ?></span><?php _me("文章数目") ?></li>
           <?php if (COMMENT_SYSTEM == 0): ?>
           <li class="list-group-item text-second"> <span class="blog-info-icons"> <i data-feather="message-circle"></i></span>
               <span class="badge
           pull-right"><?php $stat->publishedCommentsNum() ?></span><?php _me("评论数目") ?></li>
           <?php endif; ?>
           <li class="list-group-item text-second"><span class="blog-info-icons"> <i data-feather="calendar"></i></span>
               <span class="badge
           pull-right"><?php echo Utils::getOpenDays(); ?></span><?php _me("运行天数") ?></li>
           <li class="list-group-item text-second"><span class="blog-info-icons"> <i data-feather="activity"></i></span> <span
                       class="badge
           pull-right"><?php echo Utils::getLatestTime($this); ?></span><?php _me("最后活动") ?></li>
           <li class="list-group-item text-second"><span class="blog-info-icons"> <i data-feather="users"></i></span> <span
                       class="badge
           pull-right"><?php echo VisitorStatistics_Plugin::getVisitorStatistics(); ?></span><?php _me("访客总数") ?></li>
         </ul>
```
这里自己还可以 DIY 一些其他信息，图标是 data-feather 这个属性，大家可以去[这里](https://feathericons.com/)替换为其他的
