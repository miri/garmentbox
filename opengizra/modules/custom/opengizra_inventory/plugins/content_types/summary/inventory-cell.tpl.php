<div class="quantity"><?php print $quantity; ?></div>

<?php foreach($subfigure_types as $type => $label): ?>
  <?php if ($$type): ?>
    <div class="subfigure <?php print $type; ?>">
      <span class="amount"><?php print $$type; ?></span><span class="label"><?php print $label; ?></span>
    </div>
  <?php endif; ?>
<?php endforeach; ?>
