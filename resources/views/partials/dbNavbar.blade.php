<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5" id="breadcrumb">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page" id="current-page">{{ $currentPage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0" id="page-title">{{ $currentPage }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="javascript:;"
                       class="nav-link text-body font-weight-bold px-0"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- @stack('scripts') -->
</nav>


<!-- @push('scripts')
<script>   
   const pageTitles = {
       '/dashboard': 'Dashboard',
       '/jabatanKegiatan/': 'Jabatan Kegiatan',
       '/jabatanStatus': 'Jabatan Kegiatan',
       '/dpa': 'DPA',
       '/kategori': 'Kategori',
       '/alur': 'Alur',
       '/dokumen': 'Dokumen',
       '/permohonans': 'Permohonan',
       '/Pegawai': 'Pegawai'
   };    

   const currentPath = window.location.pathname;

   const currentPageTitle = pageTitles[currentPath] || 'Unknown Page';
 
   const breadcrumb = document.getElementById('breadcrumb');
   const pageTitle = document.getElementById('page-title');
   const currentPage = document.getElementById('current-page');

   document.getElementById('current-page').textContent = currentPage;
   document.getElementById('page-title').textContent = currentPage;
 
   if (breadcrumb && pageTitle && currentPage) {
       currentPage.textContent = currentPageTitle; // Breadcrumb
       pageTitle.textContent = currentPageTitle;  // Heading
 
       breadcrumb.innerHTML = `
           <li class="breadcrumb-item text-sm">
               <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
           </li>
           <li class="breadcrumb-item text-sm text-dark active" aria-current="page">${currentPageTitle}</li>
       `;
   }
 
</script>
@endpush -->