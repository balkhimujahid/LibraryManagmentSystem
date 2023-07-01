<script src="<?php echo BASE_URL ?>/assect/JS/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL ?>/assect/JS/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL ?>/assect/JS/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
<script src="<?php echo BASE_URL ?>/assect/JS/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL ?>/assect/JS/script.js"></script>
<script src="<?php echo BASE_URL ?>/assect/JS/fc92123054.js" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });

  // PRE LOADER BUT NOT IN WORKING
  var loader = document.getElementById("preloader");

  function load() {
    window.onload("onload", function() {
      loader.style.display = "none";
    });
  }
</script>

</body>

<html>