(function ($) {

/**
 * Production order inventory lines widget behaviors.
 */
Drupal.behaviors.GarmentboxOrderItems = {
  attach: function (context) {
    this.context = context;
    var self = this;

    $(context).find('.form-item-field-factory-und select').change(function(event) {
      // The URL already has "?field_season=x" attached to it.
      window.location = Drupal.settings.garmentbox_factory.url + '&field_factory=' + $(event.currentTarget).val();
    });

    // Toggle inventory lines rows.
    $(context).find('tr.expandable .item-title a').click(function(event) {
      event.preventDefault();

      var rowId = $(event.currentTarget).parents('tr').attr('id');
      $(event.currentTarget).parents('table').find('tr.il[ref="' + rowId + '"]').toggle().toggleClass('hidden');
    });

    // Handle item variant checkbox.
    $(context).find('tr.expandable input[type="checkbox"]').change(function(event) {
      var checkbox = $(event.currentTarget);
      var rowId = checkbox.parents('tr').attr('id');
      var table = checkbox.parents('table');
      var checkboxes = table.find('tr.il[ref="' + rowId + '"] input[type="checkbox"]');

      checkbox.removeClass('checked partially-checked not-checked');

      if($(event.currentTarget).attr('checked')) {
        checkboxes.attr('checked', 'checked');
        checkbox.addClass('checked');
      }
      else {
        checkboxes.removeAttr('checked');
        // When unchecking, uncheck also the "New item" checkbox.
        var row = table.find('tr.new-il[ref="' + rowId + '"]');
        row.find('input[type="checkbox"]').removeAttr('checked');
        row.find('input.new-inventory-items').attr('disabled', 'disabled');
      }

      self.updateTotals();
    });

    // Update the item price and quantity as the "Add more items" inputs get
    // changed.
    $(context).find('input.new-inventory-items').change(function(event) {
      self.updateTotals();
    }).keyup(function(event) {
      self.updateTotals();
    });

    // Determine the class of the variants' checkboxes.
    $(context).find('tr.il input[type="checkbox"]').change(function(event) {
      var table = $(event.currentTarget).parents('table');
      var rowId = $(event.currentTarget).parents('tr').attr('ref');

      self.updateVariantCheckbox(table.find('#' + rowId + ' input[type="checkbox"]'));
      self.updateTotals();
    });

    // Update the variant checkboxes on load.
    $(context).find('.triple-checkbox').each(function(index, checkbox) {
      self.updateVariantCheckbox($(checkbox));
    });

    // Update the totals on load.
    self.updateTotals();

    // Disble the "Extra items" row on load.
    $(context).find('input.new-inventory-items').attr('disabled', 'disabled');

    // Enable the "Extra items" row.
    $(context).find('.add-il').change(function(event) {
      var row = $(event.currentTarget).parents('tr');
      var rowId = row.attr('id');
      var table = $(event.currentTarget).parents('table');

      if ($(event.currentTarget).attr('checked')) {
        row.find('input.new-inventory-items').removeAttr('disabled');
      }
      else {
        row.find('input.new-inventory-items').attr('disabled', 'disabled');
      }
      self.updateTotals();
    });
  },

  // Update the "triple checkbox" on item-variant rows when thier inevntory
  // lines change.
  updateVariantCheckbox: function(variantCheckbox) {
    var rowId = variantCheckbox.parents('tr').attr('id');
    var table = variantCheckbox.parents('table');
    var checked = table.find('tr.il[ref="' + rowId + '"] input[type="checkbox"]:checked').length;
    var total = table.find('tr.il[ref="' + rowId + '"] input[type="checkbox"]').length;

    variantCheckbox.removeClass('checked partially-checked not-checked');

    if (total - checked == 0) {
      // All are checked.
      variantCheckbox.attr('checked', 'checked');
      variantCheckbox.addClass('checked');
    }
    else if (checked == 0) {
      // None are checked.
      variantCheckbox.removeAttr('checked');
      variantCheckbox.addClass('not-checked');
    }
    else {
      // Some are checked.
      variantCheckbox.attr('checked', 'checked');
      variantCheckbox.addClass('partially-checked');
    }
  },

  // Update the table wide totals.
  updateTotals: function() {
    var self = this;
    var table = $(this.context).find('table#ils-table');
    var totalItems = 0;
    var totalPrice = 0;
    // Trigger the variants' update, and sum the results.
    table.find('tr.expandable').each(function(i, element) {
      var rowId = $(element).attr('id');
      var variantNid = rowId.substring(8);
      var result = self.updateVariant(table, rowId, variantNid);
      totalItems += result.items;
      totalPrice += result.price;
    });

    // Set the values on "Total items" and "Total production price".
    $(this.context).find('#edit-total-items').val(totalItems);
    $(this.context).find('#edit-production-price').val('$' + Drupal.formatNumber(totalPrice, 2));
  },

  // Re-calculate variant production cost as inventory lines change.
  updateVariant: function(table, rowId, variantNid) {
    // Update the production cost and quantities.
    var itemPrice = Drupal.settings.garmentbox_factory.ils_data[variantNid].item_price / 100;
    var itemsCount = 0;
    var variantSizes = {};
    // Sum the items on checked inventory lines.
    table.find('tr.il[ref="' + rowId + '"] td:first-child input[type="checkbox"]:checked').each(function(i, element) {
      // Sum the inventory lines items counts.
      var ilNid = $(element).data('il-nid');
      var ilData = Drupal.settings.garmentbox_factory.ils_data[variantNid].lines[ilNid];
      itemsCount += ilData.items_count;

      // Sum the per size items counts.
      for (var key in ilData.sizes) {
        if (isNaN(variantSizes[key])) {
          variantSizes[key] = 0;
        }
        variantSizes[key] += ilData.sizes[key];
      }
    });

    var newItemsCount = 0;
    // Sum also the custom inventory inputs.
    var updateExtraItemPrice = true;
    table.find('tr.new-il[ref="' + rowId + '"] input.new-inventory-items').each(function(i, element) {
      if (!$(element).attr('disabled')) {
        var count = parseInt($(element).val());

        var tid = $(element).data('tid');

        if (!isNaN(count) && count >= 0) {
          itemsCount += count;
          newItemsCount += count;

          // Add the count to the per size items counts.
          if (isNaN(variantSizes[tid])) {
            variantSizes[tid] = 0;
          }
          variantSizes[tid] += count;
        }
      }
      else {
        // When the inputs are disabled, don't update their total price.
        updateExtraItemPrice = false;
      }
    });

    if (updateExtraItemPrice) {
      // Update the "Production price" of the custom row.
      var totalCustomItemPrice = newItemsCount * itemPrice;
      var customRowPrice = table.find('tr.new-il[ref="' + rowId + '"] td.production-price');
      customRowPrice.text('$' + Drupal.formatNumber(totalCustomItemPrice, 2));
    }

    var totalPrice = itemsCount * itemPrice;
    var variantRow = table.find('tr#' + rowId);
    variantRow.find('.production-price').text('$' + Drupal.formatNumber(totalPrice, 2));

    // Set the variant quantities.
    // Remove the existing  quantities.
    variantRow.find('.size-quantity').text('');
    // Re-set the quantities.
    for (var tid in variantSizes) {
      variantRow.find('td[data-tid="' + tid + '"]').text(variantSizes[tid]);
    }

    // Return the variant totals for summing them in the grand total.
    return {items: itemsCount, price: totalPrice};
  }
};

})(jQuery);
