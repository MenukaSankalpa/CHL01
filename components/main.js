<script>
  const fileInput = document.getElementById('cvFile');
  const fileLabel = document.querySelector('.file-label');

  fileInput.addEventListener('change', function () {
    if (this.files && this.files.length > 0) {
      fileLabel.textContent = this.files[0].name; // Always show file name
    } else {
      fileLabel.textContent = "Choose file..."; // Reset if no file
    }
  });
</script>

