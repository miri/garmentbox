<div class="inventory-cell clearfix">
  <div class="main-figure">
    <span class="amount"><?php print $available; ?> </span>
    <div class="label">available</div>
  </div>

  <div class="sub-figures">
    <?php foreach($subfigure_types as $type => $label): ?>
        <div class="sub-figure <?php print $type; ?>">
          <span class="amount"><?php print $$type; ?></span><span class="label"><?php print $label; ?></span>
        </div>
    <?php endforeach; ?>
  </div>
</div>
