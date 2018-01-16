'use strict';

// Function for confirmation pop up window - delete post
function confirmDeletePost() {
  if (confirm("Do you really want to delete the post?") == true) {
    return true;
  }
  else {
    return false;
  }
}

// Function for confirmation pop up window - delete account
function confirmDeleteAccount() {
  if (confirm("Do you really want to delete your account?") == true) {
    return true;
  }
  else {
    return false;
  }
}
