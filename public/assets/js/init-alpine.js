function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    isDanaMenuOpen: false,
    toggleDanaMenu() {
      this.isDanaMenuOpen = !this.isDanaMenuOpen
    },
    isPegawaiMenuOpen: false,
    togglePegawaiMenu() {
      this.isPegawaiMenuOpen = !this.isPegawaiMenuOpen
    },
    isLaporanMenuOpen: false,
    toggleLaporanMenu() {
      this.isLaporanMenuOpen = !this.isLaporanMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
    // Modal Pegawai
    isModalOpenPegawai: false,
    openModalPegawai() {
      this.isModalOpenPegawai = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModalPegawai() {
      this.isModalOpenPegawai = false
      this.trapCleanup()
    },
    // Modal Supplier
    isModalOpenSupplier: false,
    openModalSupplier() {
      this.isModalOpenSupplier = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModalSupplier() {
      this.isModalOpenSupplier = false
      this.trapCleanup()
    },
    // Modal Barang
    isModalOpenBarang: false,
    openModalBarang() {
      this.isModalOpenBarang = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModalBarang() {
      this.isModalOpenBarang = false
      this.trapCleanup()
    },
  }
}
