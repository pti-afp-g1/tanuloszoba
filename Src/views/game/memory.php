<?php
/* @var $deck */

/* @var $uuid */

use app\assets\MemoryAsset;

$i = 1;

MemoryAsset::register($this);
?>
<div id="lexical-board" data-identifier="<?= $uuid ?>"></div>
<div class="row result-board">
    <div class="col-sm-4" id="game-timer"></div>
    <div class="col-sm-4" id="game-point">0</div>
    <div class="col-sm-4">
        <a class="btn btn-success" href="/game/memory">Újrakezdés</a>
    </div>
</div>
<div class="row">

    <?php foreach ($deck as $card): ?>
    <div class="col-sm-3 game-row">
        <img
            class="card-to-pair img-border memory-card"
            src="/uploads/cover.jpg"
            alt="card" data-src="/uploads/<?= $card['img'] ?>"
            data-key="<?= $card['key'] ?>">
    </div>
    <?php if (($i++ % 4 === 0) && ($i < 12)): ?>
</div>
<div class="row">
    <?php endif; ?>
    <?php endforeach; ?>

</div>

<!-- Modal -->
<div id="result-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Gratulálunk!</h4>
            </div>
            <div class="modal-body">
                <p>Az eredményedet tároltuk.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
            </div>
        </div>

    </div>
</div>
