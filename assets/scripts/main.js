'use strict';

function confirmDeletePost() {
  if (confirm("Do you really want to delete the post?") == true) {
    return true;
  }
  else {
    return false;
  }
}

function confirmDeleteAccount() {
  if (confirm("Do you really want to delete your account?") == true) {
    return true;
  }
  else {
    return false;
  }
}
