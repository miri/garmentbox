Feature: Test item variant page
  Verify the BOM and BOL tables are shown correctly and that the prices are
  presented correctly.

  @api
  Scenario: Test the tabs of an item variant.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see the following <links>
    | Main                  |
    | Pink Vest dress       |
    | Salmon Vest dress     |
    | Peach Vest dreslinks  |

  @api
  Scenario: Test the prices on the BOM table.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see a table titled "Bill of materials":
    | Quantity  | Material item   | Unit  | Price |
    | 2.50      | [Vogue Fabrics] | Meter | $5.00 |
    And I shoud see the text "Total: $5.00"


  @api
  Scenario: Test the prices on the BOL table.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see a table titled "Bill of labour":
    | Price   | Labour  |
    | $10.00  | Cutting |
    | $10.00  | Sewing  |

  @api
  Scenario: Test the total production price.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I shoud see the text "production price: $25.00"

  @api
  Scenario:
