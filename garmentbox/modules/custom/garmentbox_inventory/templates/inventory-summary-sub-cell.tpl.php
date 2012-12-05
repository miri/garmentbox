<div class="inventory-sub-cell clearfix">
  <?php if ($quantity): ?>
    <div class="main-figure <?php print $quantity_color; ?>">
      <span class="amount"><?php print $quantity; ?></span>
    </div>

    <?php if ($ordered): ?>
      <div class="sub-figure">
        <div class="ordered"><?php print $ordered; ?> <span class="label">ordered</span></div>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
