Feature: Test item variant page
  Verify the BOM and BOL tables are shown correctly and that the prices are
  presented correctly.

  @api
  Scenario: Verify that the basic information is shown correctly.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see the heading "Pink Vest dress"
    And I the production price should be "$25.00"

  @api
  Scenario: Test the tabs of an item variant.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see the following <links>
    | links             |
    | Main              |
    | Pink Vest dress   |
    | Salmon Vest dress |
    | Peach Vest dress  |

  @api @wip
  Scenario: Test the prices on the BOM table.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see a table titled "Bill of materials" with the following <contents>:
    | Quantity  | Material item                                             | Unit  | Price |
    | 2.50      | Novelle Art Noveau Natural Shell Buttons [Vogue Fabrics]  | Meter | $5.00 |
    And the BOM total should be "$5.00"

  @api
  Scenario: Test the prices on the BOL table.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "item-variant" page with id "37"
    Then I should see a table titled "Bill of labour" with the following <contents>:
    | Price   | Labour term |
    | $10.00  | Cutting     |
    | $10.00  | Sewing      |
