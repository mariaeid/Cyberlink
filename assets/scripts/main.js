'use strict';

function confirmDelete() {
  if (confirm("Do you really want to delete the post?") == true) {
    return true;
  }
  else {
    return false;
  }
}
