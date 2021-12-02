# inv_system

#roles and permissions
Super Admin $\_SESSION["role"] = 0

- All features both web and mobile

Property Personnel $\_SESSION["role"] = 1

- All features both web and mobile

\*except user management

Laboratory Staff $\_SESSION["role"] = 2

- by default:

Web - Unable to manage all modules only viewing and generating reports.

Mobile - all features

Faculty $\_SESSION["role"] = 3 -- okay

- Mobile Only - all features

USERS

SUPER ADMIN
username:admin password:1234

Property Personnel
username:a password:a

Laboratory Staff
username:b password:b

Mobile user
username:c password:c
