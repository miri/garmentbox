Feature: Production order delivery.
  Allow user to mark the items that were received from production.

  @javascript
  Scenario: Viewing the delivery tab.
    Given I am logged in as "user"
     When I am on a "Production delivery" page of the default "production-order"
     Then the table "delivery-inventory" should have the following <contents>:
      | Received   | Item variation             | Type      | Small          | Medium         | Large          | Production price |
      | <checkbox> | Black v-neck shirt         | Received  | <textfield> 16 | <textfield> 6  |                | $990.00          |

  @javascript
  Scenario: Setting a production order as delivered and viewing the delivery tab.
    Given I am logged in as "user"
      And I am on a "Production delivery" page of the default "production-order"
     When I check "Received" in row containing "Black v-neck shirt" in table "delivery-inventory"
      And I fill in "Small" with "7" in row containing "Received" in table "delivery-inventory"
      And I fill in "Medium" with "9" in row containing "Received" in table "delivery-inventory"
      And I fill in "Small" with "0" in row containing "Customer: Gap" in table "delivery-inventory"
      And I fill in "Medium" with "3" in row containing "Defective" in table "delivery-inventory"
     Then the table "delivery-inventory" should have the following <contents>:
      | Received           | Item variation             | Type      | Small         | Medium        | Large | Production price |
      | <checkbox> checked | Black v-neck shirt         | Received  | <textfield> 7 | <textfield> 7 |       | <ignore>         |
      |                    |                            | Original  |               | 8             |       | <ignore>         |
      |                    |                            | Missing   |               | 8             |       | <ignore>         |
      |                    |                            | Defective |               | 8             |       | <ignore>         |
      |                    |                            | Extras    |               | 8             |       | <ignore>         |
