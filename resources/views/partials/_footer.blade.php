<style>
  .popcat {
    position: fixed;
    bottom: 0;          /* mulai dari bawah */
    right: 20px;        /* jarak dari pojok kanan */
    width: 80px;        /* ukuran kecil biar pas */
    z-index: 1050;      /* biar nongol di atas footer */
    transform: translateY(36%); /* setengah ketutup footer */
    transition: transform 0.5s ease-in-out;
  }

  .popcat:hover {
    transform: translateY(0); /* muncul penuh kalau hover */
  }
</style>

<!-- Footer -->
<footer class="footer bg-dark text-light py-3 mt-auto">
  <div class="container-xl">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
        <span>© 2025 <a href="{{ route('index') }}" class="text-decoration-none text-info fw-semibold">PT.Dirgantara</a>. Indonesian Aerospace.</span>
        <span class="ms-2">
          <a href="./changelog.html" class="text-decoration-none text-muted small">v1</a>
        </span>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a href="https://github.com/Yusril0956/Training-Project/blob/main/README.md" target="_blank" class="text-decoration-none text-muted">Documentation</a></li>
          <li class="list-inline-item"><a href="./license.html" class="text-decoration-none text-muted">License</a></li>
          <li class="list-inline-item"><a href="https://github.com/Yusril0956/Training-Project.git" target="_blank" class="text-decoration-none text-muted">Source code</a></li>
          <li class="list-inline-item">
            <a href="https://github.com/sponsors/codecalm" target="_blank" class="text-decoration-none text-danger fw-semibold">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/>
              </svg>
              Dibuat dengan ❤️  
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- Pop Cat -->
<img src="pop.gif" alt="Pop Cat" class="popcat">
