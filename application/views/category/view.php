<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$i=0;?>

<h1 class="text-center">Categorie</h1>
<div class="row" id="categorie-list">
    <?php foreach($cate as $key=>$value): ?>
      <article class="categorie col-sm-4 col-md-4" >
          <a href="<?= base_url().'Categorie/'.$value['cName'] ?>">         
                <?= img($value['url'],$value['pName'],'col-md-12 img') ?>
                <div class="categorieTitle">
                    <h4><?= $value['cName'] ?></h4>
                </div>
            </a>
        </article>
<?php endforeach; ?>
</div>
