# 修改Thinkphp记录 #


```php
<?php
    /**
     * view.class.php #@modify# private function getTemplateTheme() -> protected function getTemplateTheme()
     *
     * Model.class.php select find union where save add addAll count
     * 	# public function __construct 设置默认siteCode 管理中心忽略siteCode 和 model忽略siteCode设置
     *
     * Template.class.php 多次继承问题
     *  # protected function parseExtend #@add# $content = $this->parseExtend($content);
     *  # private function replaceBlock($content)	#@modify# $content = $content[3]; -> $content = $content[0];
     */
 ?>
```
