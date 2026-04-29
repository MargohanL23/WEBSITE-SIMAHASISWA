</div><!-- end page-content -->
</div><!-- end main -->

<script>
  // Live clock
  function updateClock() {
    const now = new Date();
    document.getElementById('clock').textContent =
      now.toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit',second:'2-digit'});
  }
  setInterval(updateClock, 1000);
  updateClock();
</script>
</body>
</html>