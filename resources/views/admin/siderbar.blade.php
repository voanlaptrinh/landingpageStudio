  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="index.html">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->


          <li class="nav-item">
              <a class="nav-link {{ in_array(Request::route()->getName(), ['admin.sliders.index', 'admin.sliders.create', 'admin.sliders.edit']) ? '' : 'collapsed' }}"
                  href="{{ route('admin.sliders.index') }}">
                  <i class="bi bi-card-image"></i>
                  <span>Sliders</span>
              </a>
          </li><!-- End Profile Page Nav -->
          <li class="nav-heading">Danh mục Video</li>

          <li class="nav-item">
              <a class="nav-link  {{ in_array(Request::route()->getName(), ['admin.category_videos.index', 'admin.category_videos.create', 'admin.category_videos.edit']) ? '' : 'collapsed' }}"
                  href="{{ route('admin.category_videos.index') }}">
                  <i class="bi bi-collection"></i>
                  <span>Danh mục video</span>
              </a>
              <a class="nav-link  {{ in_array(Request::route()->getName(), ['admin.videos.index', 'admin.videos.create', 'admin.videos.edit']) ? '' : 'collapsed' }}"
                  href="{{ route('admin.videos.index') }}">
                  <i class="bi bi-film"></i>
                  <span>Video</span>
              </a>
          </li>
          <li class="nav-heading">Pages</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li><!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>F.A.Q</span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-contact.html">
                  <i class="bi bi-envelope"></i>
                  <span>Contact</span>
              </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-register.html">
                  <i class="bi bi-card-list"></i>
                  <span>Register</span>
              </a>
          </li><!-- End Register Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-login.html">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>Login</span>
              </a>
          </li><!-- End Login Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-error-404.html">
                  <i class="bi bi-dash-circle"></i>
                  <span>Error 404</span>
              </a>
          </li><!-- End Error 404 Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-blank.html">
                  <i class="bi bi-file-earmark"></i>
                  <span>Blank</span>
              </a>
          </li><!-- End Blank Page Nav -->

      </ul>

  </aside><!-- End Sidebar-->
