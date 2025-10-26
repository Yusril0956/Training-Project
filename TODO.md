# TODO: Refactor Auth to Service Layer

## 1. Create AuthService

-   [ ] Create `app/Services/AuthService.php`
-   [ ] Move login logic from AuthController
-   [ ] Move register logic from AuthController
-   [ ] Move complete profile logic from AuthController
-   [ ] Move logout logic from AuthController
-   [ ] Move Google OAuth callback logic from AuthController
-   [ ] Add role management methods (consistent with user_roles table)

## 2. Create ProfileService

-   [ ] Create `app/Services/ProfileService.php`
-   [ ] Move update password logic from ProfileController
-   [ ] Move update avatar logic from ProfileController
-   [ ] Move delete avatar logic from ProfileController
-   [ ] Move update profile logic from ProfileController
-   [ ] Move update profile logic from Profile Livewire component

## 3. Refactor AuthController

-   [ ] Inject AuthService in constructor
-   [ ] Simplify login method to validation + service call + response
-   [ ] Simplify register method to validation + service call + response
-   [ ] Simplify completeForm and saveCompleteForm methods
-   [ ] Simplify logout method
-   [ ] Simplify googleCallback method

## 4. Refactor ProfileController

-   [ ] Inject ProfileService in constructor
-   [ ] Simplify updatePassword method
-   [ ] Simplify updateAvatar method
-   [ ] Simplify deleteAvatar method
-   [ ] Simplify updateProfile method

## 5. Refactor Livewire Components

-   [ ] Refactor Profile Livewire component to use ProfileService
-   [ ] Refactor UserSearch Livewire component to use AuthService for user creation/update
-   [ ] Refactor CreateUserAndMember Livewire component to use AuthService for user creation

## 6. Fix Role Management Inconsistencies

-   [ ] Ensure all role assignments use user_roles table instead of direct 'role' column
-   [ ] Update User model accessor if needed
-   [ ] Update AuthController register method to use proper role assignment
-   [ ] Update UserSearch to properly handle role assignment

## 7. Testing

-   [ ] Test login functionality (normal and admin)
-   [ ] Test register functionality
-   [ ] Test profile updates
-   [ ] Test user CRUD in admin panel
-   [ ] Test Google OAuth
-   [ ] Test role assignments
