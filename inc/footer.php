  <footer class="site-footer">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?> Aplikasi HPP</p>
    </div>
  </footer>
  <!-- Theme toggle script: persist preference to localStorage -->
  <script>
    (function(){
      function applyTheme(theme){
        if(theme === 'light'){
          document.body.classList.add('theme-light');
          var btn = document.getElementById('theme-toggle'); if(btn) btn.textContent = 'Light';
        } else {
          document.body.classList.remove('theme-light');
          var btn = document.getElementById('theme-toggle'); if(btn) btn.textContent = 'Dark';
        }
      }
      document.addEventListener('DOMContentLoaded', function(){
        var saved = localStorage.getItem('theme') || 'dark';
        applyTheme(saved);
        var tbtn = document.getElementById('theme-toggle');
        if(tbtn){
          tbtn.addEventListener('click', function(){
            var cur = document.body.classList.contains('theme-light') ? 'light' : 'dark';
            var next = cur === 'light' ? 'dark' : 'light';
            localStorage.setItem('theme', next);
            applyTheme(next);
          });
        }
      });
    })();
  </script>
  <!-- Bootstrap JS bundle (no integrity attribute to avoid CDN hash mismatch issues) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
