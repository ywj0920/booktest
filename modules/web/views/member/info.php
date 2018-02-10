<?php
use \app\common\services\UrlService;
use \app\common\services\UtilService;
use \app\common\services\ConstantMapService;
?>
<?php echo Yii::$app->view->renderFile("@app/modules/web/views/common/tab_member.php",[ 'current' => 'index' ]);?>
<div class="row m-t">
	<div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-b-md">
					<?php if( $info && $info['status']):?>
                    <a class="btn btn-outline btn-primary pull-right" href="<?=UrlService::buildWebUrl("/member/set",[ 'id' => $info['id'] ]);?>">编辑</a>
					<?php endif;?>
                    <h2>会员信息</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 text-center">
                <img class="img-circle" src="" width="100px" height="100px"/>
            </div>
            <div class="col-lg-9">
                <dl class="dl-horizontal">
                    <dt>姓名：</dt> <dd><?=UtilService::encode( $info['nickname'] );?></dd>
                    <dt>手机：</dt> <dd><?=UtilService::encode( $info['mobile'] );?></dd>
                    <dt>性别：</dt> <dd><?=ConstantMapService::$sex_mapping[ $info['sex'] ];?></dd>
                </dl>
            </div>
        </div>
        <div class="row m-t">
            <div class="col-lg-12">
                <div class="panel blank-panel">
                    <div class="panel-heading">
                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab-1" data-toggle="tab" aria-expanded="false">会员订单</a>
                                </li>
                                <li>
                                    <a href="#tab-2" data-toggle="tab" aria-expanded="true">会员评论</a>
                                </li>
                            </ul>
                        </div>
                    </div>


            </div>
        </div>
	</div>
</div>
