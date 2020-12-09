<?php
/**
 * Created by PhpStorm.
 * User: whts
 * Date: 2020-05-09
 * Time: 10:19
 */
?>
<script>
    (function() {
        function foucs(i, j) {
            if(j!=null) {
                $('.main-nav .first-node').eq(i).addClass('active').find('.nav li').eq(j).addClass('focus');
            } else {
                $('.main-nav .first-node').eq(i).addClass('focus')
            }
        }
        foucs({
            130: 0,
            131: 1,
            132: 2,
            133: 3,
            134: 4,
            135: 5,
            136: 6,
            137: 7,
            222: 8,
            220: 9
        }[<?php echo $seq; ?>]);
    })();
</script>
