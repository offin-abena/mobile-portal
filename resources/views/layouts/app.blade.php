
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Brassica Pay | @yield('title', 'Default Title')</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Mobile Backend | Dashboard" />
    <meta name="author" content="TGL Systems" />
    <meta
      name="description"
      content="Mobile Backend Portal for Brassica."
    />
    <meta
      name="keywords"
      content="Mobile Backend, Brassica, TGL Systems, Pay, Payment, Mobile Money"/>
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('adminlte/css/adminlte.min.css') }}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">


@yield('styles')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" style="color: #fff;font-weight: bold"  href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>

          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">


            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline text-white">{{auth()->user()->fullName}}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    {{ Auth::user()->fullName }}
                    <small>User Type: {{ Auth::user()->userType }}</small>
                  </p>
                </li>
                <!--end::User Image-->

                <!--begin::Menu Footer-->
                <li class="user-footer">
                  {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                  <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">
                        @csrf
                        <button type="submit" class="btn btn-default btn-flat">
                            Sign out
                        </button>
                    </form>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('home') }}" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img
              src="{{ asset('assets/images/favicon.png') }}"
              alt="Logo"
              class="brand-image opacity-75 shadow"
            /> --}}
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light text-white text-lg">Brassica Pay</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation"
        >
  <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
      <i class="fa fa-home"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.index') ? 'active' : '' }}">
      <i class="fa fa-users"></i>
      <p>Customer List</p>
    </a>
  </li>
  <li class="nav-item {{ request()->routeIs('users.index') || request()->routeIs('referrers.index') || request()->routeIs('audit-trails.index') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('users.index') || request()->routeIs('referrers.index') || request()->routeIs('audit-trails.index') ? 'active' : '' }}">
      <i class="fa fa-user"></i>
      <p>
        Users
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-circle"></i>
          <p>List Users</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('audit-trails.index') }}" class="nav-link {{ request()->routeIs('audit-trails.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-circle"></i>
          <p>Audit Trail</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('referrers.index') }}" class="nav-link {{ request()->routeIs('referrers.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-circle"></i>
          <p>Referrers</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('system.index') || request()->routeIs('promo-codes.create') || request()->routeIs('promo-codes.index') || request()->routeIs('terminals.index') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-gears"></i>
      <p>
        System Setup
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item ">
        <a href="{{ route('system.index') }}" class="nav-link {{ request()->routeIs('system.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>System Settings</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('promo-codes.create') }}" class="nav-link {{ request()->routeIs('promo-codes.create') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Generate Promo Code</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('promo-codes.index') }}" class="nav-link {{ request()->routeIs('promo-codes.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>List Promo Codes</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('terminals.index') }}" class="nav-link {{ request()->routeIs('terminals.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Increase Vendor Terminal</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('refunds.index') || request()->routeIs('transactions.index') || request()->routeIs('meters.remove') || request()->routeIs('meters.find') || request()->routeIs('balances.tgl') || request()->routeIs('transactions.failed-to-write') || request()->routeIs('vendors.index') || request()->routeIs('transactions.postpaid') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-support"></i>
      <p>
        Support
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('refunds.index') }}" class="nav-link {{ request()->routeIs('refunds.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refund Power</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>All Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('meters.remove') }}" class="nav-link {{ request()->routeIs('meters.remove') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Reset Meter Profile</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('meters.find') }}" class="nav-link {{ request()->routeIs('meters.find') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Polymorph Info</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('balances.tgl') }}" class="nav-link {{ request()->routeIs('balances.tgl') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>TGL Balance</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.failed-to-write') }}" class="nav-link {{ request()->routeIs('transactions.failed-to-write') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Failed To Write Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('vendors.index') }}" class="nav-link {{ request()->routeIs('vendors.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Vendors Database</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.postpaid') }}" class="nav-link {{ request()->routeIs('transactions.postpaid') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Postpaid Transactions</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('refunds.index') || request()->routeIs('refunds.others') || request()->routeIs('refunds.payments') || request()->routeIs('meters.remove') || request()->routeIs('meters.find') || request()->routeIs('transactions.failed-to-write') || request()->routeIs('sms.quick-send') || request()->routeIs('transactions.refunded') || request()->routeIs('refunds.candidates') || request()->routeIs('customers.referrals') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-desktop"></i>
      <p>
        Operations
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('refunds.index') }}" class="nav-link {{ request()->routeIs('refunds.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refund Power</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('refunds.others') }}" class="nav-link {{ request()->routeIs('refunds.others') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refund Others</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('refunds.payments') }}" class="nav-link {{ request()->routeIs('refunds.payments') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refund Payment</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('meters.remove') }}" class="nav-link {{ request()->routeIs('meters.remove') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Reset Meter Profile</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('meters.find') }}" class="nav-link {{ request()->routeIs('meters.find') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Polymorph Info</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.failed-to-write') }}" class="nav-link {{ request()->routeIs('transactions.failed-to-write') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Failed To Write Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('sms.quick-send') }}" class="nav-link {{ request()->routeIs('sms.quick-send') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Quick SMS</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.refunded') }}" class="nav-link {{ request()->routeIs('transactions.refunded') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refunded Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('refunds.candidates') }}" class="nav-link {{ request()->routeIs('refunds.candidates') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Refund Candidates</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.referrals') }}" class="nav-link {{ request()->routeIs('customers.referrals') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Referred Customers</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('users.systemAccount') || request()->routeIs('services.index') || request()->routeIs('prices.main') || request()->routeIs('currencies.index') || request()->routeIs('quota.index') || request()->routeIs('settlements.capital') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-money"></i>
      <p>
        Finance
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @if (Auth::user()->userType == 'SYSTEMADMIN')
        <li class="nav-item">
            <a href="{{ route('users.systemAccount') }}" class="nav-link {{ request()->routeIs('users.systemAccount') ? 'active' : '' }}">
            <i class="nav-icon bi bi-circle"></i>
            <p>Add System Account</p>
            </a>
        </li>
      @endif

      <li class="nav-item">
        <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Services</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('prices.main') }}" class="nav-link {{ request()->routeIs('prices.main') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Main Pricing</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('currencies.index') }}" class="nav-link {{ request()->routeIs('currencies.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Currency Mgt</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('quota.index') }}" class="nav-link {{ request()->routeIs('quota.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Credit Merchant Account</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('settlements.capital') }}" class="nav-link {{ request()->routeIs('settlements.capital') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Capital Settlement</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item {{ request()->routeIs('kycs.index') || request()->routeIs('kycs.manual') || request()->routeIs('kycs.request') || request()->routeIs('kycs.approvals') || request()->routeIs('kycs.unapproved') || request()->routeIs('transactions.flagged') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-balance-scale"></i>
      <p>
        Compliance
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('kycs.index') }}" class="nav-link {{ request()->routeIs('kycs.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            KYC Limits
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('kycs.manual') }}" class="nav-link {{ request()->routeIs('kycs.manual') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            Manual KYC Review
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('kycs.request') }}" class="nav-link {{ request()->routeIs('kycs.request') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            KYC Request List
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('kycs.approvals') }}" class="nav-link {{ request()->routeIs('kycs.approvals') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            KYC Approved List
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('kycs.unapproved') }}" class="nav-link {{ request()->routeIs('kycs.unapproved') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            KYC Unapproved List
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.flagged') }}" class="nav-link {{ request()->routeIs('transactions.flagged') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>
            Flagged Transactions
          </p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item {{ request()->routeIs('translations.index') || request()->routeIs('translations.create') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link ">
      <i class="fa fa-language"></i>
      <p>
        Translations
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('translations.create') }}" class="nav-link {{ request()->routeIs('translations.create') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Create Translations</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('translations.index') }}" class="nav-link {{ request()->routeIs('translations.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>View Translations</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('meters.find') || request()->routeIs('transactions.postpaid') || request()->routeIs('balances.tgl') || request()->routeIs('tsa-mgt.index') || request()->routeIs('vendors.index') || request()->routeIs('quota.topup') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-university"></i>
      <p>
        TGL
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('meters.find') }}" class="nav-link {{ request()->routeIs('meters.find') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Polymorph Info</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.postpaid') }}" class="nav-link {{ request()->routeIs('transactions.postpaid') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Postpaid Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('balances.tgl') }}" class="nav-link {{ request()->routeIs('balances.tgl') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>TGL Balance</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('tsa-mgt.index') }}" class="nav-link {{ request()->routeIs('tsa-mgt.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>TSA TM Mgt</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('vendors.index') }}" class="nav-link {{ request()->routeIs('vendors.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Vendors Database</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('quota.topup') }}" class="nav-link {{ request()->routeIs('quota.topup') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>TGL Offline Quota TopUp</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('brassica.dashboard') || request()->routeIs('settlements.capital') || request()->routeIs('customers.capital.partial_onboarding') || request()->routeIs('customers.capital') || request()->routeIs('transactions.investments') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-signal"></i>
      <p>
        Capital
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('brassica.dashboard') }}" class="nav-link {{ request()->routeIs('brassica.dashboard') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('settlements.capital') }}" class="nav-link {{ request()->routeIs('settlements.capital') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Settle Custodian</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.capital.partial_onboarding') }}" class="nav-link {{ request()->routeIs('customers.capital.partial_onboarding') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Partial onboarding</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.capital') }}" class="nav-link {{ request()->routeIs('customers.capital') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Customer List</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.investments') }}" class="nav-link {{ request()->routeIs('transactions.investments') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Customers Transactions</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item {{ request()->routeIs('customers.transactions') || request()->routeIs('customers.top_selling') || request()->routeIs('transactions.bog_monthly_report') || request()->routeIs('customers.partial_onboarding') || request()->routeIs('customers.customer_report') || request()->routeIs('transactions.index') || request()->routeIs('transactions.monthly_revenue') || request()->routeIs('customers.active_customers') || request()->routeIs('forensics.index') || request()->routeIs('customers.referrals') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
      <i class="fa fa-server"></i>
      <p>
        Reports
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{  route('customers.top_selling') }}" class="nav-link {{ request()->routeIs('customers.top_selling') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Top Selling Customers</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.bog_monthly_report') }}" class="nav-link {{ request()->routeIs('transactions.bog_monthly_report') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>BOG Monthly Report</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.partial_onboarding') }}" class="nav-link {{ request()->routeIs('customers.partial_onboarding') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Partially Onboarded</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.customer_report') }}" class="nav-link {{ request()->routeIs('customers.customer_report') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Customer Report</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>All Transactions</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('transactions.monthly_revenue') }}" class="nav-link {{ request()->routeIs('transactions.monthly_revenue') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Monthly Revenue</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.active_customers') }}" class="nav-link {{ request()->routeIs('customers.active_customers') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Active Customers</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('forensics.index') }}" class="nav-link {{ request()->routeIs('forensics.index') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Forensic Investigations</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('customers.referrals') }}" class="nav-link {{ request()->routeIs('customers.referrals') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>Referred Customers</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="{{ route('password.change') }}" class="nav-link {{ request()->routeIs('password.change') ? 'active' : '' }}">
      <i class="fa fa-lock"></i>
      <p>Change Password</p>
    </a>
  </li>

</ul>
<!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">
                    @hasSection('sub-title')
                      @yield('sub-title', 'Default Title')
                    @else
                      @yield('title', 'Default Title')
                    @endif
                </h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Default Title')</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          @include('components.alerts')
          <div class="container-fluid">
            @yield('content')
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">

        <strong>
          Copyright &copy; <?php echo date('Y'); ?>&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">TGL Systems</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('adminlte/js/adminlte.min.js')}}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}


    <!--end::OverlayScrollbars Configure-->


    @yield('scripts')
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
