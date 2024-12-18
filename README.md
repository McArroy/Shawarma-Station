# Shawarma Station <img align="right" width="128px" src="https://github.com/McArroy/Shawarma-Station/blob/main/customer/resources/imgs/shawarma_station_logo_transparent.png" title="Shawarma Station - Logo" alt="shawarma_station_logo"/>
A website to help Shawarma Station customers to view and order their food more easily as well as helping cashier to add Shawarma Station menus or write customer orders.

## What is this?
Shawarma Station is a website designed by IPB Vocational School Students from the Software Engineer Study Program with the aim of helping Shawarma Station customers to view and order their food more easily and also helping cashier to add Shawarma Station menus or write customer orders.

## Goals of the project
- Making it easier for Shawarma Station customers to view the menu
- Making it easier for Shawarma Station customers to order their food than before because Shawarma Station only has a piece of paper to see the entire menu
- Making it easier for Shawarma Station cashier to add, delete, and also find out what food is sold at Shawarma Station every day and how much money they get

## Developer Informations
### Changelogs
These changelogs are basically just a summary list of changes that are very important for developers information.

#### UPDATE Version 3.1.4.0 [ Last update: 11/21/2024 ]
<details>
<summary>Click to expand</summary>

**[ ADMIN ]**
- Added "style-auth.css" for a standalone admin-login-design to make easier to edit
- Added a display-text instead a blank page when there is no data to be shown
- Added client-sided inputs check
- Added confirmation before deletion
- Added quantity-counter on menu "Order" (only visible when the current product has been added)
- Fixed database data-type and maximum value
- Fixed image-menu didn't remove if the menu removed from the database
- Fixed indentation in some layouts
- Fixed non-working Menu-Order History by replacing dynamic-products into static-products and non-removeable history
- Fixed overflow element
- Fixed "Reduce" button on menu "Order" only visible when the current product has been added
- Fixed server-side data validation
- Fixed some known bugs
- Removed unused CSS-style
- Removed unused database
- Enabled WhatsApp-integrated message to send customer's receipt

**[ CUSTOMER ]**
- Enabled dynamic-database from admin-page

</details>

#### UPDATE Version 2.1.2.0 [ Last update: 11/15/2024 ]
<details>
<summary>Click to expand</summary>

**[ ADMIN ]**
- Added admin's controller
- Added admin-panel and routes
- Added admin's authentication and admin's database
- Added background-images
- Added databases
- Added databases models
- Added menu-icons
- Added action-icons
- Added Shawarma Station's logo
- Fixed file-localization
- Fixed some routes
- Fixed some default-routes
- Fixed website's name and timezone
- Fixed website's CSS
- Removed unused contents

</details>

#### UPDATE Version 1.3.0.8 [ Last update: 11/10/2024 ]
<details>
<summary>Click to expand</summary>

**[ HOSTING ]**
- Enabled hosting's domain [shawarma-station-admin.rf.gd](https://shawarma-station-admin.rf.gd) and now is fully accessible

**[ CUSTOMER ]**
- Added Shawarma Station's logo
- Added "style-responsive.css" for a standalone responsive-design to make easier to edit
- Added website icon
- Fixed overflow images by cutting them
- Fixed some known bugs
- Fixed some typos
- Fixed non-registered symbols and shown square-symbol when website opened in mobile devices
- Fixed website not updated the styles and the resources-file didn't get from the root folder
- Enabled responsive-design

</details>

#### UPDATE Version 1.2.0.7 [ Last update: 11/06/2024 ]
<details>
<summary>Click to expand</summary>

**[ CUSTOMER ]**
- Added a new style for CSS by using SCSS for a better way to edit and understand the styles
- Fixed symbols and some codes
- Fixed some typos on some codes
- Removed the old "styles.css"

</details>

#### UPDATE Version 1.2.0.5 [ Last update: 11/03/2024 ]
<details>
<summary>Click to expand</summary>

**[ ADMIN ]**
- Added Laravel's framework
> This also added Laravel's Jetstream, Livewire, etc.

**[ CUSTOMER ]**
- Fixed menus' default query to "foods" to minimize confusion between foods' and drinks' query

</details>

#### UPDATE Version 1.2.0.1 [ Last update: 10/30/2024 ]
<details>
<summary>Click to expand</summary>

**[ HOSTING ]**
- Enabled hosting's domain [shawarma-station.rf.gd](https://shawarma-station.rf.gd) and now is fully accessible

**[ CUSTOMER ]**
- Finished menu-page layout

</details>

#### UPDATE Version 1.0.0.2 [ Last update: 10/22/2024 ]
<details>
<summary>Click to expand</summary>

**[ COMMONS ]**
- Added README.md

**[ CUSTOMER ]**
- Added first-stage menu-page layout
- Finished home-page layout
- Fixed some javascript's logic-code
- Fixed javascript's code and make it more simple

</details>

#### UPDATE Version 1.0.0.0 [ Last update: 10/20/2024 ]
<details>
<summary>Click to expand</summary>

**[ COMMONS ]**
- Initial commit

</details>