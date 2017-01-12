<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$i=0;?>

<div class="row">

    <div class="row">
        <div id="formSearch" class="form-group">
            <label for="filter"  class="col-sm-2" ><h5>Precisez votre recherche</h5></label>
            <div class="col-sm-6">
                <input type="text" name="filter" class="form-control" id="filter">
            </div>
        </div>
    </div>

    <div id="tableAjax">
        <div class="row">
            <?php foreach ($list as $value) : ?>
                <?php $i++;?>
                <!-- 16:9 aspect ratio -->

                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-4 ">
                    <div class="panel panel-default  ">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><?= $value['name'] ?></h3>
                        </div>
                        <div class="panel-body bodyImg">
                            <a class="col-xs-12" href="">
                                <?= img($value['url'],$value['name'],'pop col-xs-12',$value['id']) ?>
                            </a>
                        </div>
                        <div class="panel-footer pFooter">
                            Franchise: <?= $value['franchise'] ?>
                            <?= ( $value['exclusivity'] != NULL ) ? '<br>ExclusivitÃ©: '.$value['exclusivity'] : ''?>
                        </div>
                    </div>
                </div>

                <?php if($i==3)
                {
                    echo '</div><div class="row">';
                    $i=0 ;
                }  ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<nav aria-label="Page navigation" id="nav">
    <ul class="pagination">
       
    </ul>
</nav>
