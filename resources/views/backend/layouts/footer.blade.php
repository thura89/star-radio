
<!-- App Settings FAB -->
<div id="app-settings">
    <app-settings layout-active="default"
        :layout-location="{
            'default': 'dashboard-quick-access.html',
            'fixed': 'fixed-dashboard-quick-access.html',
            'fluid': 'fluid-dashboard-quick-access.html',
            'mini': 'mini-dashboard-quick-access.html'
        }">
    </app-settings>
</div>

<!-- jQuery -->
<script src="{{ asset('flowdesh_theme/vendor/jquery.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{ asset('flowdesh_theme/vendor/popper.min.js')}}"></script>
<script src="{{ asset('flowdesh_theme/vendor/bootstrap.min.js')}}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('flowdesh_theme/vendor/perfect-scrollbar.min.js')}}"></script>

<!-- DOM Factory -->
<script src="{{ asset('flowdesh_theme/vendor/dom-factory.js')}}"></script>

<!-- MDK -->
<script src="{{ asset('flowdesh_theme/vendor/material-design-kit.js')}}"></script>

<!-- App -->
<script src="{{ asset('flowdesh_theme/js/toggle-check-all.js')}}"></script>
<script src="{{ asset('flowdesh_theme/js/check-selected-row.js')}}"></script>
<script src="{{ asset('flowdesh_theme/js/dropdown.js')}}"></script>
<script src="{{ asset('flowdesh_theme/js/sidebar-mini.js')}}"></script>
<script src="{{ asset('flowdesh_theme/js/app.js')}}"></script>

<!-- App Settings (safe to remove) -->
<script src="{{ asset('flowdesh_theme/js/app-settings.js')}}"></script>