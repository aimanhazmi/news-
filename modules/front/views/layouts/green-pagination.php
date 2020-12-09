<?php
/**
 * Created by lonisy@163.com
 * User: lilei
 * Date: 2018-12-05 22:23:12
 */
//$data['items']       = $items;
//$data['first']       = 1;
//$data['current']     = $pagination->page ? $pagination->page + 1 : 1;
//$data['before']      = $data['current'] > 1 ? $data['current'] - 1 : 1;
//$data['next']        = $data['current'] < $pagination->pageCount ? $data['current'] + 1 : $pagination->pageCount;
//$data['limit']       = count($items);
//$data['total_items'] = $pagination->totalCount + 0;
//$data['total_pages'] = $pagination->pageCount;


use app\components\CommonToolkit;

$pageUrl = $baseUrl ?? Yii::$app->request->getPathInfo();

$total = isset($data['total_pages']) ? intval($data["total_pages"]) : 0;//总页数
$current = isset($data['current']) ? intval($data["current"]) : 1;//当前页
$before = $current - 1;
$next = $current + 1;
$bottomPageNum = \Yii::$app->params['bottomPageNum']; //显示页码数量

$displayPages = [];
if ($current <= $total) {
    if ($current < $bottomPageNum) {
        //当前页数小于显示条数
        $min = min($bottomPageNum, $total);
        for ($i = 1; $i < $min + 1; $i++) {
            $displayPages[] = $i;
        }
    } else {
        //当前页数大于显示条数
        $middle = $current - floor($bottomPageNum / 2);
        if ($middle > $total - $bottomPageNum) {
            $middle = $total - $bottomPageNum + 1;
        }
        for ($i = 0; $i < $bottomPageNum; $i++) {
            $displayPages[] = $middle++;
        }
    }
}
?>
<?php if ($total > 0): ?>
 
    <div class="hlgd-page page-nav">
        <ul class="pagination">

            <?php if ($current > 1): ?>
                <li>
                    <a href="<?php echo CommonToolkit::makeUrl(['page_no' => $before], $pageUrl, $data); ?>"
                       aria-label="Previous"><span aria-hidden="true">上一页</span></a>
                </li>
            <?php endif; ?>

            <?php foreach ($displayPages as $key => $val): ?>
                <li>
                    <a href="<?php echo CommonToolkit::makeUrl(['page_no' => $val], $pageUrl, $data); ?>" <?php if ($current == $val) echo "class='active'"; ?>>第<?php echo $val; ?>页</a>
                </li>
            <?php endforeach; ?>

            <?php if ($current < $total): ?>
                <li>
                    <a href="<?php echo CommonToolkit::makeUrl(['page_no' => $next], $pageUrl, $data); ?>"
                       aria-label="Previous"><span aria-hidden="true">下一页</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>