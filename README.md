## Laravel 11 with Shreyu Theme

#### This setup includes following modules
- Admin
    - Login
    - Forget password
    - Reset password
    - Change password
    - Dashboard
    - User - Listing, Add, Update, Delete
    - Blogs - Listing, Add, Update, Delete
    - FAQs - Listing, Add, Update, Delete
    - Categories - Listing, Add with add more, Update, Delete
    - Enquiries - Listing, Delete
    - Email Templates - Listing, Update
    - CMS pages - Listing, Update - like (Home page, About us - section wise update)
    - Application settings
    - About Us - edit content
    - Privacy Policy - edit content
    - Terms & Conditions - edit content
  
- User
    - Login
    - Register
    - Forget password
    - Reset password
    - Change password
    - Home
    - Profile
    - FAQs
    - Blogs
    - Contact Us
    - About Us
    - Privacy Policy
    - Terms & Conditions

- Basic API with postman collection
    - Login
    - Register
    - Forget password
    - Resend code
    - Reset password
    - Terms conditions
    - Privacy policy
    - About us
    - Complete profile
    - Profile
    - Update profile
    - Change password
    - Logout
    - Delete account
    - Contact
    - Notifications
    - Notifications clear
    - Country
    - Masters - for all constant, master tables
  
- Also includes push notification, google auto complete for location search, for more details read custom.js file

### Push notification types

-   1 => Account created
-   2 => Account approved

### Status codes

-   0 - Error / Message
-   200 - Success
-   401 - Unauthorize (While user account is deactivated)
-   403 - User deleted or Token miss or Token invalid or Token expired or Token required
-   404 - Not found
-   422 - Validation message
-   426 - Force Update
-   500 - Server internal error
-   503 - Under maintenance

### Commands

- To setup project or installation follow the install.sh file commands or run the file using below command
  -  `sh install.sh`
