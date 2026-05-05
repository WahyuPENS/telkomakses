<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KML Tools</title>
    <style>
        :root {
            --primary-color: #2C2159;
            --primary-light: #3D2E7C;
            --primary-dark: #1E153E;
            --secondary-color: #4CAF50;
            --accent-color: #FF5722;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --text-muted: #6B7280;
            --bg-light: #F8FAFC;
            --bg-white: #FFFFFF;
            --bg-gray: #F1F5F9;
            --border-color: #E2E8F0;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --radius: 8px;
        }

        /* Dark Mode Variables */
        .dark-mode {
            --primary-color: #7C6FCF;
            --primary-light: #8F83E3;
            --primary-dark: #5A4F9C;
            --secondary-color: #4CAF50;
            --accent-color: #FF7043;
            --text-light: #E2E8F0;
            --text-dark: #F1F5F9;
            --text-muted: #94A3B8;
            --bg-light: #0F172A;
            --bg-white: #1E293B;
            --bg-gray: #334155;
            --border-color: #475569;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* Layout */
        .app-container {
            display: flex;
            flex: 1;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar - White Modern */
        .sidebar {
            width: 280px;
            background-color: var(--bg-white);
            color: var(--text-dark);
            transition: var(--transition);
            overflow-y: auto;
            z-index: 100;
            border-right: 2px solid var(--border-color);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 18px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--bg-white);
            min-height: 70px;
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .logo {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            color: var(--primary-color);
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header h1 {
            opacity: 0;
            width: 0;
            position: absolute;
        }

        .sidebar-menu {
            padding: 16px 0;
            flex: 1;
            transition: var(--transition);
        }

        .menu-item {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-dark);
            transition: var(--transition);
            border-left: 3px solid transparent;
            margin: 4px 12px;
            border-radius: var(--radius);
            white-space: nowrap;
            position: relative;
        }

        .menu-item:hover {
            background-color: var(--bg-gray);
            color: var(--primary-color);
        }

        .menu-item.active {
            background-color: var(--primary-color);
            color: var(--text-light);
            border-left-color: var(--accent-color);
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar.collapsed .menu-item span {
            opacity: 0;
            width: 0;
            position: absolute;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
        }

        .sidebar.collapsed .menu-item {
            padding: 14px;
            justify-content: center;
            margin: 4px 12px;
        }

        /* Tooltip untuk menu item saat collapsed */
        .menu-item::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--primary-color);
            color: white;
            padding: 8px 12px;
            border-radius: var(--radius);
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 1000;
            margin-left: 10px;
            box-shadow: var(--shadow-lg);
        }

        .sidebar.collapsed .menu-item:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 20px;
            border-top: 2px solid var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: var(--transition);
            position: relative;
        }

        .sidebar.collapsed .sidebar-footer {
            padding: 20px 16px;
        }

        /* TOGGLE SIDEBAR - POSISI BARU DI SIDEBAR FOOTER */
        .toggle-sidebar {
            background: none;
            border: none;
            color: #EF4444;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 0;
            border-radius: 6px;
            transition: var(--transition);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            border: 2px solid #EF4444;
            background-color: var(--bg-white);
            z-index: 1001;
        }

        .toggle-sidebar:hover {
            background-color: #EF4444;
            color: white;
        }

        .toggle-sidebar i {
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .sidebar.collapsed .toggle-sidebar i {
            transform: rotate(180deg);
        }

        .theme-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background-color: var(--bg-gray);
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            margin-top: 8px; /* Memberi jarak dari toggle button */
        }

        .sidebar.collapsed .theme-toggle {
            padding: 12px;
            justify-content: center;
        }

        .theme-toggle:hover {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .theme-toggle-content {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .theme-toggle i {
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .theme-toggle-text {
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .theme-toggle-text {
            opacity: 0;
            width: 0;
            position: absolute;
        }

        .theme-toggle-switch {
            position: relative;
            width: 44px;
            height: 24px;
            background-color: var(--border-color);
            border-radius: 12px;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .theme-toggle-switch::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background-color: var(--bg-white);
            border-radius: 50%;
            transition: var(--transition);
        }

        .dark-mode .theme-toggle-switch {
            background-color: var(--primary-color);
        }

        .dark-mode .theme-toggle-switch::after {
            transform: translateX(20px);
        }

        .sidebar.collapsed .theme-toggle-switch {
            display: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            min-width: 0; /* Untuk mencegah overflow */
        }

        .top-bar {
            background-color: var(--bg-white);
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100; /* Lebih rendah dari toggle sidebar */
            border-bottom: 2px solid var(--border-color);
            position: sticky;
            top: 0;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .content-area {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Footer */
        .footer {
            background-color: var(--bg-white);
            padding: 12px 30px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            border-top: 1px solid var(--border-color);
            position: sticky;
            bottom: 0;
        }

        /* Card Styles - Border only without shadow */
        .card {
            background-color: var(--bg-white);
            border-radius: var(--radius);
            margin-bottom: 0;
            overflow: hidden;
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            height: fit-content;
            max-height: calc(100vh - 200px);
        }

        .card-header {
            padding: 16px 20px;
            background-color: var(--primary-color);
            color: var(--text-light);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Welcome Page Styles */
        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 30px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .welcome-icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 16px;
        }

        .welcome-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 24px;
            max-width: 600px;
        }

        .welcome-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-top: 30px;
            width: 100%;
        }

        .feature-card {
            background-color: var(--bg-white);
            border-radius: var(--radius);
            padding: 20px;
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary-color);
        }

        .feature-icon {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--primary-color);
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.5;
            font-size: 0.9rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        /* MODERN DROPDOWN STYLES - Hanya untuk elemen select */
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 0.9rem;
            transition: var(--transition);
            background-color: var(--bg-white);
            color: var(--text-dark);
        }

        /* Hanya dropdown select yang dapat arrow */
        .form-control:is(select) {
            appearance: none; /* Remove default arrow */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 14px;
            padding-right: 40px; /* Space for the arrow */
        }

        .dark-mode .form-control:is(select) {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394A3B8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(44, 33, 89, 0.1);
        }

        .dark-mode .form-control:focus {
            box-shadow: 0 0 0 2px rgba(124, 111, 207, 0.2);
        }

        .form-control:is(select):focus {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232C2159'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        }

        .dark-mode .form-control:is(select):focus {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%237C6FCF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        }

        .form-control:hover {
            border-color: var(--primary-light);
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-col {
            flex: 1;
        }

        .form-text {
            display: block;
            margin-top: 4px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            text-decoration: none;
            gap: 6px;
        }

        .btn:hover {
            background-color: var(--primary-light);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background-color: var(--bg-gray);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #E2E8F0;
        }

        .dark-mode .btn-secondary:hover {
            background-color: #475569;
        }

        .btn-success {
            background-color: var(--secondary-color);
        }

        .btn-success:hover {
            background-color: #3D8B40;
        }

        .btn-block {
            display: flex;
            width: 100%;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius);
            padding: 30px;
            text-align: center;
            transition: var(--transition);
            background-color: var(--bg-light);
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background-color: rgba(44, 33, 89, 0.08);
        }

        .dark-mode .file-upload-area:hover {
            background-color: rgba(124, 111, 207, 0.12);
        }

        .file-upload-area.dragover {
            border-color: var(--primary-color);
            background-color: rgba(44, 33, 89, 0.12);
            border-width: 2px;
        }

        .dark-mode .file-upload-area.dragover {
            background-color: rgba(124, 111, 207, 0.16);
        }

        .file-upload-area.has-file {
            border-color: var(--secondary-color);
            background-color: rgba(76, 175, 80, 0.08);
        }

        .dark-mode .file-upload-area.has-file {
            background-color: rgba(76, 175, 80, 0.12);
        }

        .file-upload-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 12px;
            transition: var(--transition);
        }

        .file-upload-area:hover .file-upload-icon {
            color: var(--primary-light);
        }

        .file-upload-area.has-file .file-upload-icon {
            color: var(--secondary-color);
        }

        .file-name {
            margin-top: 8px;
            font-size: 0.85rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .file-upload-area.has-file .file-name {
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .data-table th {
            background-color: var(--bg-gray);
            font-weight: 600;
            color: var(--primary-color);
        }

        .data-table tr:hover {
            background-color: rgba(44, 33, 89, 0.03);
        }

        .dark-mode .data-table tr:hover {
            background-color: rgba(124, 111, 207, 0.08);
        }

        /* Alert Styles */
        .alert {
            padding: 14px;
            border-radius: var(--radius);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .alert-error {
            background-color: #FEF2F2;
            color: #991B1B;
            border-left: 3px solid #EF4444;
        }

        .dark-mode .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: #FCA5A5;
        }

        .alert-success {
            background-color: #F0FDF4;
            color: #166534;
            border-left: 3px solid #10B981;
        }

        .dark-mode .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #6EE7B7;
        }

        .alert i {
            font-size: 1.1rem;
        }

        /* Icon Grid */
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            gap: 12px;
            margin: 12px 0;
        }

        .icon-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            background-color: var(--bg-white);
        }

        .icon-option:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .icon-option.selected {
            border-color: var(--primary-color);
            background-color: rgba(44, 33, 89, 0.05);
        }

        .dark-mode .icon-option.selected {
            background-color: rgba(124, 111, 207, 0.1);
        }

        .icon-image {
            width: 35px;
            height: 35px;
            object-fit: contain;
            margin-bottom: 6px;
        }

        /* Button Separator */
        .button-separator {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar.collapsed {
                width: 100%;
                height: 70px;
                overflow: hidden;
            }

            .sidebar.collapsed .sidebar-menu {
                display: none;
            }

            .sidebar-footer {
                display: none;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .top-bar {
                padding: 14px 20px;
            }

            .content-area {
                padding: 16px;
                gap: 16px;
            }
            
            .card-body {
                padding: 16px;
            }
            
            .footer {
                padding: 10px 20px;
            }
            
            .welcome-title {
                font-size: 1.8rem;
            }
            
            .welcome-features {
                grid-template-columns: 1fr;
            }
            
            .menu-item::after {
                display: none; /* Sembunyikan tooltip di mobile */
            }
            
            .toggle-sidebar {
                width: 28px;
                height: 28px;
                top: -14px;
            }
            
            .toggle-sidebar i {
                font-size: 0.7rem;
            }
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 16px;
            overflow-x: auto;
        }

        .tab-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: var(--transition);
            white-space: nowrap;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .tab-item.active {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Section Title */
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 16px 0 10px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Checkbox Group */
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 10px;
            margin-top: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background-color: var(--bg-white);
            border-radius: var(--radius);
            border: 1.5px solid var(--border-color);
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .checkbox-item:hover {
            border-color: var(--primary-color);
        }

        .checkbox-item input[type="checkbox"] {
            transform: scale(1.1);
        }

        /* Column Selection Animation */
        .column-selection-hidden {
            opacity: 0;
            visibility: hidden;
            height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .column-selection-visible {
            opacity: 1;
            visibility: visible;
            height: auto;
            overflow: visible;
            transition: all 0.3s ease;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="assets/earth-asia.svg">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <div class="logo">
                        <img src="assets/earth-asia.svg" alt="KML Tools Logo" style="width: 32px; height: 32px;">
                    </div>
                    <h1>KML Tools</h1>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="menu-item active" data-tab="welcome" data-tooltip="Welcome">
                    <i class="fas fa-home"></i>
                    <span>Welcome</span>
                </a>
                <a href="#" class="menu-item" data-tab="create-lop" data-tooltip="Create LOP">
                    <i class="fas fa-layer-group"></i>
                    <span>Create LOP</span>
                </a>
                <a href="#" class="menu-item" data-tab="line-to-point" data-tooltip="Line to Point">
                    <i class="fas fa-route"></i>
                    <span>Line to Point</span>
                </a>
                <a href="#" class="menu-item" data-tab="rename-placemarks" data-tooltip="Rename Placemarks">
                    <i class="fas fa-tag"></i>
                    <span>Rename Placemarks</span>
                </a>
                <a href="#" class="menu-item" data-tab="centroid-polygon" data-tooltip="Centroid Polygon">
                    <i class="fas fa-draw-polygon"></i>
                    <span>Centroid Polygon</span>
                </a>
                <a href="#" class="menu-item" data-tab="wkt-to-kml" data-tooltip="WKT to KML">
                    <i class="fas fa-exchange-alt"></i>
                    <span>WKT to KML</span>
                </a>
                <a href="#" class="menu-item" data-tab="kml-to-csv" data-tooltip="KML to CSV">
                    <i class="fas fa-file-csv"></i>
                    <span>KML to CSV</span>
                </a>
                <a href="#" class="menu-item" data-tab="point-in-polygon" data-tooltip="Point in Polygon">
                    <i class="fas fa-dot-circle"></i>
                    <span>Point in Polygon</span>
                </a>
                <a href="#" class="menu-item" data-tab="polygon-in-polygon" data-tooltip="Polygon in Polygon">
                    <i class="fas fa-object-group"></i>
                    <span>Polygon in Polygon</span>
                </a>
            </div>
            
            <!-- Sidebar Footer with Theme Toggle -->
            <div class="sidebar-footer">
                <!-- Toggle Sidebar Button - POSISI BARU DI ATAS FOOTER -->
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="theme-toggle" id="themeToggle">
                    <div class="theme-toggle-content">
                        <i class="fas fa-moon" id="themeIcon"></i>
                        <span class="theme-toggle-text">Dark Mode</span>
                    </div>
                    <div class="theme-toggle-switch"></div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <div class="page-title" id="pageTitle">Welcome</div>
            </div>

            <div class="content-area">
                <!-- Alert Area -->
                <div id="alertArea"></div>

                <!-- Welcome Tab -->
                <div class="tab-content active" id="welcome">
                    <div class="welcome-container">
                        <div class="welcome-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h1 class="welcome-title">Selamat Datang di KML Tools</h1>
                        <p class="welcome-subtitle">
                            Platform lengkap untuk mengelola, mengonversi, dan menganalisis data geospasial dalam format KML. 
                            Dengan berbagai alat yang tersedia, Anda dapat dengan mudah memproses data geografis untuk kebutuhan pemetaan dan analisis.
                        </p>
                        
                        <div class="welcome-features">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <h3 class="feature-title">Create LOP</h3>
                                <p class="feature-description">
                                    Buat Layer of Points (LOP) dari data ODP dan BOQ Excel dengan mudah.
                                </p>
                            </div>
                            
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-route"></i>
                                </div>
                                <h3 class="feature-title">Line to Point</h3>
                                <p class="feature-description">
                                    Konversi garis menjadi titik dengan jarak yang dapat disesuaikan.
                                </p>
                            </div>
                            
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <h3 class="feature-title">Format Converter</h3>
                                <p class="feature-description">
                                    Konversi antara berbagai format data geospasial seperti KML, CSV, dan WKT.
                                </p>
                            </div>
                            
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <h3 class="feature-title">Spatial Analysis</h3>
                                <p class="feature-description">
                                    Lakukan analisis spasial seperti point in polygon dan centroid calculation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create LOP Tab -->
                <div class="tab-content" id="create-lop">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-layer-group"></i> Create LOP
                        </div>
                        <div class="card-body">
                            <form id="createLopForm" enctype="multipart/form-data" action="create-lop.php" method="POST">
                                <!-- Form Upload Mendatar -->
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Data ODP <span style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="createLopOdpUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Klik untuk memilih file atau drag & drop di sini</p>
                                                <input type="file" name="odp" accept=".csv,.xls,.xlsx,.xlsm" required style="display: none;">
                                                <div class="file-name" id="createLopOdpFileName">Belum ada file dipilih</div>                                                
                                            </div>
                                            <span class="form-text">Format: CSV, Dengan isi file : <span style="font-weight: 500; color: var(--text-dark);">"Nama ODP, Latitude, Longitude, Nama Lop Auto"</span></span>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">BOQ Excel <span id="boq-required" style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="createLopBoqUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Klik untuk memilih file atau drag & drop di sini</p>
                                                <input type="file" name="boq" accept=".xls,.xlsx,.xlsm" style="display: none;">
                                                <div class="file-name" id="createLopBoqFileName">Belum ada file dipilih</div>                                                
                                            </div>
                                            <span class="form-text">Wajib untuk mode ZIP</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Nama Dokumen</label>
                                            <input type="text" class="form-control" name="docname" placeholder="Misal: 3SBU Project" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">Output <span style="color: #EF4444;">*</span></label>
                                            <select class="form-control" name="mode" id="mode-select" required>
                                                <option value="kml">KML gabungan (1 file)</option>
                                                <option value="zip">ZIP: folder per LOP + BOQ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="section-title">
                                        <i class="fas fa-icons"></i> Pilih Ikon Penanda
                                    </div>
                                    <div class="icon-grid" id="createLopIconGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="createLopBtn">
                                        <span id="createLopBtnText">Generate</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Line to Point Tab -->
                <div class="tab-content" id="line-to-point">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-route"></i> Line to Point
                        </div>
                        <div class="card-body">
                            <form id="lineToPointForm" enctype="multipart/form-data" action="line-to-point.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label">File KML/KMZ <span style="color: #EF4444;">*</span></label>
                                    <div class="file-upload-area" id="lineToPointUpload">
                                        <div class="file-upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Klik untuk memilih file atau drag & drop di sini</p>
                                        <input type="file" name="kmlFile" accept=".kml,.kmz" required style="display: none;">
                                        <div class="file-name" id="lineToPointFileName">Belum ada file dipilih</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Jarak Antar Titik (meter) <span style="color: #EF4444;">*</span></label>
                                    <input type="number" class="form-control" name="distance" value="100" min="1" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Pola Nama Placemark</label>
                                    <input type="text" class="form-control" name="placemarkName" value="Titik {n}" placeholder="Gunakan {n} untuk nomor urut">
                                </div>

                                <div class="form-group">
                                    <div class="section-title">
                                        <i class="fas fa-icons"></i> Pilih Ikon Penanda
                                    </div>
                                    <div class="icon-grid" id="lineToPointIconGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="lineToPointBtn">
                                        <span id="lineToPointBtnText">Generate & Download</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Rename Placemarks Tab -->
                <div class="tab-content" id="rename-placemarks">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-tag"></i> Rename Placemarks
                        </div>
                        <div class="card-body">
                            <form id="renamePlacemarksForm" enctype="multipart/form-data" action="rename-placemarks.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label">File KML/KMZ <span style="color: #EF4444;">*</span></label>
                                    <div class="file-upload-area" id="renamePlacemarksUpload">
                                        <div class="file-upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Klik untuk memilih file atau drag & drop di sini</p>
                                        <input type="file" name="kmlFile" accept=".kml,.kmz" required style="display: none;">
                                        <div class="file-name" id="renamePlacemarksFileName">Belum ada file dipilih</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tipe Penamaan <span style="color: #EF4444;">*</span></label>
                                    <select class="form-control" name="labelType" id="labelType">
                                        <option value="numeric">Numerik</option>
                                        <option value="custom">Kustom</option>
                                    </select>
                                </div>

                                <div id="numericFields">
                                    <div class="form-group">
                                        <label class="form-label">Prefix</label>
                                        <input type="text" class="form-control" name="numericPrefix" value="Lokasi" placeholder="Contoh: Lokasi">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Nomor Awal</label>
                                                <input type="number" class="form-control" name="startNumber" value="1" min="1">
                                            </div>
                                        </div>
                                        <div class="form-col">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Penomoran</label>
                                                <select class="form-control" name="numbering">
                                                    <option value="sequential">Berurutan</option>
                                                    <option value="random">Acak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="customFields" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Format Nama Kustom</label>
                                        <input type="text" class="form-control" name="customName" value="Lokasi {n}" placeholder="Gunakan {n} untuk nomor">
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="renamePlacemarksBtn">
                                        <span id="renamePlacemarksBtnText">Rename & Download</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Centroid Polygon Tab -->
                <div class="tab-content" id="centroid-polygon">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-draw-polygon"></i> Centroid Polygon
                        </div>
                        <div class="card-body">
                            <form id="centroidPolygonForm" enctype="multipart/form-data" action="centroid-polygon.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label">File KML/KMZ <span style="color: #EF4444;">*</span></label>
                                    <div class="file-upload-area" id="centroidPolygonUpload">
                                        <div class="file-upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Klik untuk memilih file atau drag & drop di sini</p>
                                        <input type="file" name="kmlFile" accept=".kml,.kmz" required style="display: none;">
                                        <div class="file-name" id="centroidPolygonFileName">Belum ada file dipilih</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Pola Nama Placemark</label>
                                    <input type="text" class="form-control" name="placemarkName" value="Rumah {n}" placeholder="Gunakan {n} untuk nomor urut">
                                </div>

                                <div class="form-group">
                                    <div class="section-title">
                                        <i class="fas fa-icons"></i> Pilih Ikon Penanda
                                    </div>
                                    <div class="icon-grid" id="centroidPolygonIconGrid">
                                        <!-- Icons will be populated by JavaScript -->
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="centroidPolygonBtn">
                                        <span id="centroidPolygonBtnText">Proses Centroid</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- WKT to KML Tab -->
                <div class="tab-content" id="wkt-to-kml">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-exchange-alt"></i> WKT to KML
                        </div>
                        <div class="card-body">
                            <form id="wktToKmlForm" enctype="multipart/form-data" action="wkt-to-kml.php" method="POST" novalidate>
                                <div class="form-group">
                                    <label class="form-label">File CSV <span style="color: #EF4444;">*</span></label>
                                    <div class="file-upload-area" id="wktToKmlUpload">
                                        <div class="file-upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Klik untuk memilih file atau drag & drop di sini</p>
                                        <input type="file" name="csv_file" accept=".csv" required style="display: none;">
                                        <div class="file-name" id="wktToKmlFileName">Belum ada file dipilih</div>
                                    </div>
                                </div>

                                <!-- Column Selection Section - Awalnya hidden dengan opacity -->
                                <div id="columnSelection" class="column-selection-hidden">
                                    <div class="form-group">
                                        <label class="form-label">Kolom WKT (Data Geometri) <span style="color: #EF4444;">*</span></label>
                                        <select class="form-control" name="wkt_column" id="wkt_column" required>
                                            <option value="">-- Pilih Kolom WKT --</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Kolom Nama (Label) <span style="color: #EF4444;">*</span></label>
                                        <select class="form-control" name="name_column" id="name_column" required>
                                            <option value="">-- Pilih Kolom Nama --</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Kolom Deskripsi</label>
                                        <div class="checkbox-group" id="descriptionColumns">
                                            <!-- Checkboxes will be populated by JavaScript -->
                                        </div>
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="wktToKmlBtn">
                                        <span id="wktToKmlBtnText">Konversi ke KML</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- KML to CSV Tab -->
                <div class="tab-content" id="kml-to-csv">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-file-csv"></i> KML to CSV
                        </div>
                        <div class="card-body">
                            <form id="kmlToCsvForm" enctype="multipart/form-data" action="kml-to-csv.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label">File KML <span style="color: #EF4444;">*</span></label>
                                    <div class="file-upload-area" id="kmlToCsvUpload">
                                        <div class="file-upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Klik untuk memilih file atau drag & drop di sini</p>
                                        <input type="file" name="kmlfile" accept=".kml" required style="display: none;">
                                        <div class="file-name" id="kmlToCsvFileName">Belum ada file dipilih</div>
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="kmlToCsvBtn">
                                        <span id="kmlToCsvBtnText">Konversi ke CSV</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Point in Polygon Tab -->
                <div class="tab-content" id="point-in-polygon">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-dot-circle"></i> Point in Polygon
                        </div>
                        <div class="card-body">
                            <form id="pointInPolygonForm" enctype="multipart/form-data" action="point-in-polygon.php" method="POST">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">File Points (KML) <span style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="pointsUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Upload file points KML</p>
                                                <input type="file" name="points" accept=".kml" required style="display: none;">
                                                <div class="file-name" id="pointsFileName">Belum ada file dipilih</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">File Polygons (KML) <span style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="polygonsUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Upload file polygons KML</p>
                                                <input type="file" name="polygons" accept=".kml" required style="display: none;">
                                                <div class="file-name" id="polygonsFileName">Belum ada file dipilih</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="pointInPolygonBtn">
                                        <span id="pointInPolygonBtnText">Proses & Unduh CSV</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Polygon in Polygon Tab -->
                <div class="tab-content" id="polygon-in-polygon">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-object-group"></i> Polygon in Polygon
                        </div>
                        <div class="card-body">
                            <form id="polygonInPolygonForm" enctype="multipart/form-data" action="polygon-in-polygon.php" method="POST">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">File Polygon Kecil <span style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="smallPolygonUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Upload file polygon kecil (multiple polygons)</p>
                                                <input type="file" name="small_kml" accept=".kml" required style="display: none;">
                                                <div class="file-name" id="smallPolygonFileName">Belum ada file dipilih</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-group">
                                            <label class="form-label">File Polygon Besar <span style="color: #EF4444;">*</span></label>
                                            <div class="file-upload-area" id="bigPolygonUpload">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p>Upload file polygon besar (multiple polygons)</p>
                                                <input type="file" name="big_kml" accept=".kml" required style="display: none;">
                                                <div class="file-name" id="bigPolygonFileName">Belum ada file dipilih</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-separator">
                                    <button type="submit" class="btn btn-block" id="polygonInPolygonBtn">
                                        <span id="polygonInPolygonBtnText">Proses & Generate CSV</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="footer">
                2025 | <span style="font-weight: 700;">SDI Surabaya Utara</span> | Versi 1.1.0
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        // Tab Navigation
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all menu items
                document.querySelectorAll('.menu-item').forEach(i => {
                    i.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Show selected tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
                
                // Update page title
                document.getElementById('pageTitle').textContent = this.querySelector('span').textContent;
            });
        });

        // Available Icons
        const availableIcons = [
            { name: 'U', url: 'https://maps.google.com/mapfiles/kml/paddle/U.png' },
            { name: 'L', url: 'https://maps.google.com/mapfiles/kml/paddle/L.png' },
            { name: 'Yellow Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/ylw-circle.png' },
            { name: 'Red Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/red-circle.png' },
            { name: 'Blue Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/blu-circle.png' },
            { name: 'Green Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/grn-circle.png' },
            { name: 'Pink Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/pink-circle.png' },
            { name: 'White Circle', url: 'https://maps.google.com/mapfiles/kml/paddle/wht-circle.png' },
            { name: 'Circle Dot', url: 'https://maps.google.com/mapfiles/kml/shapes/placemark_circle.png' },
            { name: 'Flag', url: 'https://maps.google.com/mapfiles/kml/shapes/flag.png' },
            { name: 'Home', url: 'https://maps.google.com/mapfiles/kml/shapes/homegardenbusiness.png' }
        ];

        // Function to create icon grid
        function createIconGrid(containerId, formName) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            
            availableIcons.forEach(icon => {
                const iconOption = document.createElement('div');
                iconOption.className = 'icon-option';
                iconOption.innerHTML = `
                    <img src="${icon.url}" alt="${icon.name}" class="icon-image">
                    <span>${icon.name}</span>
                    <input type="radio" name="${formName}" value="${icon.name}" style="display: none;">
                `;
                
                iconOption.addEventListener('click', () => {
                    // Remove selected class from all icons in this container
                    container.querySelectorAll('.icon-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // Add selected class to clicked icon
                    iconOption.classList.add('selected');
                    
                    // Check the radio button
                    iconOption.querySelector('input[type="radio"]').checked = true;
                });
                
                container.appendChild(iconOption);
            });
            
            // Select first icon by default
            if (container.firstChild) {
                container.firstChild.classList.add('selected');
                container.firstChild.querySelector('input[type="radio"]').checked = true;
            }
        }

        // Initialize icon grids
        createIconGrid('createLopIconGrid', 'icon');
        createIconGrid('lineToPointIconGrid', 'placemarkIcon');
        createIconGrid('centroidPolygonIconGrid', 'placemarkIcon');

        // File Upload Handling
        document.querySelectorAll('.file-upload-area').forEach(area => {
            const fileInput = area.querySelector('input[type="file"]');
            const fileName = area.querySelector('.file-name');
            
            area.addEventListener('click', () => {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                    area.classList.add('has-file');
                } else {
                    fileName.textContent = 'Belum ada file dipilih';
                    area.classList.remove('has-file');
                }
            });
            
            // Drag and drop functionality
            area.addEventListener('dragover', (e) => {
                e.preventDefault();
                area.classList.add('dragover');
            });
            
            area.addEventListener('dragleave', () => {
                area.classList.remove('dragover');
            });
            
            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('dragover');
                
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    fileName.textContent = fileInput.files[0].name;
                    area.classList.add('has-file');
                }
            });
        });

        // Create LOP Form - Mode Toggle
        document.getElementById('mode-select').addEventListener('change', function() {
            const boqRequired = document.getElementById('boq-required');
            if (this.value === 'zip') {
                boqRequired.style.display = 'inline';
            } else {
                boqRequired.style.display = 'none';
            }
        });

        // Rename Placemarks - Label Type Toggle
        document.getElementById('labelType').addEventListener('change', function() {
            const numericFields = document.getElementById('numericFields');
            const customFields = document.getElementById('customFields');
            
            if (this.value === 'numeric') {
                numericFields.style.display = 'block';
                customFields.style.display = 'none';
            } else {
                numericFields.style.display = 'none';
                customFields.style.display = 'block';
            }
        });

        // ====================================================================
        // DARK MODE TOGGLE
        // ====================================================================
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const body = document.body;
        
        // Check for saved theme preference or default to light mode
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
            themeIcon.className = 'fas fa-sun';
        } else {
            themeIcon.className = 'fas fa-moon';
        }
        
        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            // Update icon based on current theme
            if (body.classList.contains('dark-mode')) {
                themeIcon.className = 'fas fa-sun';
            } else {
                themeIcon.className = 'fas fa-moon';
            }
            
            // Save the current theme to localStorage
            const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', currentTheme);
        });

        // ====================================================================
        // FORM RESET FUNCTION
        // ====================================================================
        // Fungsi untuk mereset form
        function resetForm(formId) {
            const form = document.getElementById(formId);
            
            // Reset form menggunakan built-in reset method
            form.reset();
            
            // Reset semua area upload file
            form.querySelectorAll('.file-upload-area').forEach(area => {
                area.classList.remove('has-file', 'dragover');
                const fileName = area.querySelector('.file-name');
                if (fileName) {
                    fileName.textContent = 'Belum ada file dipilih';
                }
            });
            
            // Reset pilihan ikon ke ikon pertama
            form.querySelectorAll('.icon-grid').forEach(grid => {
                if (grid.firstChild) {
                    grid.querySelectorAll('.icon-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    grid.firstChild.classList.add('selected');
                    grid.firstChild.querySelector('input[type="radio"]').checked = true;
                }
            });
            
            // Reset visibility untuk kolom selection di WKT to KML
            if (formId === 'wktToKmlForm') {
                const columnSelection = document.getElementById('columnSelection');
                columnSelection.classList.remove('column-selection-visible');
                columnSelection.classList.add('column-selection-hidden');
            }
            
            // Reset mode select di Create LOP
            if (formId === 'createLopForm') {
                const modeSelect = document.getElementById('mode-select');
                const boqRequired = document.getElementById('boq-required');
                if (modeSelect.value === 'kml') {
                    boqRequired.style.display = 'none';
                }
            }
            
            // Reset label type di Rename Placemarks
            if (formId === 'renamePlacemarksForm') {
                const labelType = document.getElementById('labelType');
                const numericFields = document.getElementById('numericFields');
                const customFields = document.getElementById('customFields');
                
                if (labelType.value === 'numeric') {
                    numericFields.style.display = 'block';
                    customFields.style.display = 'none';
                } else {
                    numericFields.style.display = 'none';
                    customFields.style.display = 'block';
                }
            }
        }

        // ====================================================================
        // FORM SUBMISSION HANDLING - DIPERBAIKI
        // ====================================================================

        // ====== EVENT LISTENER KHUSUS UNTUK WKT TO KML - DENGAN DEBUGGING ======
        document.getElementById('wktToKmlForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('span');
            
            // Show loading state
            submitBtn.disabled = true;
            const originalText = btnText.textContent;
            btnText.innerHTML = '<span class="loading-spinner"></span> Memproses...';
            
            // Validasi file
            const fileInput = this.querySelector('input[name="csv_file"]');
            if (!fileInput.files.length) {
                showAlert('Silakan pilih file CSV terlebih dahulu', 'error');
                submitBtn.disabled = false;
                btnText.textContent = originalText;
                return;
            }
            
            // Validasi tipe file
            const file = fileInput.files[0];
            if (!file.name.toLowerCase().endsWith('.csv')) {
                showAlert('Hanya file CSV yang diperbolehkan', 'error');
                submitBtn.disabled = false;
                btnText.textContent = originalText;
                return;
            }
            
            // Validasi ukuran file (max 10MB)
            if (file.size > 10 * 1024 * 1024) {
                showAlert('Ukuran file terlalu besar. Maksimal 10MB', 'error');
                submitBtn.disabled = false;
                btnText.textContent = originalText;
                return;
            }
            
            // Cek apakah ini submit pertama (untuk get headers) atau kedua (untuk convert)
            const columnSelection = document.getElementById('columnSelection');
            const isFirstSubmit = columnSelection.classList.contains('column-selection-hidden');
            
            // Jika bukan submit pertama, validasi pilihan kolom
            if (!isFirstSubmit) {
                const wktColumn = document.getElementById('wkt_column').value;
                const nameColumn = document.getElementById('name_column').value;
                
                if (!wktColumn || !nameColumn) {
                    showAlert('Silakan pilih kolom WKT dan Nama', 'error');
                    submitBtn.disabled = false;
                    btnText.textContent = originalText;
                    return;
                }
            }
            
            // Buat FormData secara manual untuk debugging
            const formData = new FormData();
            
            // Tambahkan file
            if (fileInput.files.length > 0) {
                formData.append('csv_file', fileInput.files[0]);
            }
            
            // Jika bukan submit pertama, tambahkan data kolom
            if (!isFirstSubmit) {
                formData.append('wkt_column', document.getElementById('wkt_column').value);
                formData.append('name_column', document.getElementById('name_column').value);
                
                // Tambahkan kolom deskripsi yang dipilih
                const descCheckboxes = document.querySelectorAll('input[name="description_columns[]"]:checked');
                descCheckboxes.forEach(checkbox => {
                    formData.append('description_columns[]', checkbox.value);
                });
            }
            
            // Debug: Log semua data yang akan dikirim
            console.log('=== DEBUG WKT TO KML ===');
            console.log('Form action:', this.action);
            console.log('Is first submit:', isFirstSubmit);
            console.log('FormData contents:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin' // Penting untuk session
            })
            .then(response => {
                console.log('Response received. Status:', response.status);
                console.log('Content-Type:', response.headers.get('content-type'));
                
                // Clone response untuk mencegah "Body has already been consumed" error
                const responseClone = response.clone();
                
                const contentType = response.headers.get('content-type');
                
                // Jika response adalah JSON (berarti upload sukses, tapi perlu pilih kolom)
                if (contentType && contentType.includes('application/json')) {
                    return response.json().then(data => {
                        console.log('JSON Data received:', data);
                        if (data.success && data.headers) {
                            // Isi dropdown dengan headers
                            populateColumnDropdowns(data.headers);
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    });
                }
                
                // Jika response adalah KML (berarti konversi sukses)
                if (contentType && contentType.includes('application/vnd.google-earth.kml+xml')) {
                    console.log('KML response received, proceeding to download');
                    return response.blob().then(blob => {
                        // Dapatkan filename dari header Content-Disposition
                        const contentDisposition = response.headers.get('Content-Disposition');
                        let filename = 'converted_data.kml';
                        
                        if (contentDisposition) {
                            const filenameMatch = contentDisposition.match(/filename="(.+)"/);
                            if (filenameMatch) {
                                filename = filenameMatch[1];
                            }
                        }
                        
                        console.log('Downloading file:', filename);
                        
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = filename;
                        
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                        
                        showAlert('File KML berhasil dihasilkan dan sedang diunduh!', 'success');
                        
                        // Reset form setelah submit berhasil
                        resetForm('wktToKmlForm');
                        
                        return { success: true };
                    });
                }
                
                // Jika response adalah text/html (error dari backend)
                if (contentType && contentType.includes('text/html')) {
                    return responseClone.text().then(text => {
                        console.error('HTML Error response:', text);
                        throw new Error('Terjadi kesalahan pada server: ' + text.substring(0, 100));
                    });
                }
                
                // Jika response adalah plain text (error message)
                if (contentType && contentType.includes('text/plain')) {
                    return responseClone.text().then(text => {
                        console.error('Plain text error:', text);
                        throw new Error(text);
                    });
                }
                
                console.error('Unknown content type:', contentType);
                throw new Error('Response format tidak dikenali: ' + contentType);
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = originalText;
            });
        });

        // Fungsi untuk mengisi dropdown kolom WKT to KML
        function populateColumnDropdowns(headers) {
            const wktSelect = document.getElementById('wkt_column');
            const nameSelect = document.getElementById('name_column');
            const descriptionContainer = document.getElementById('descriptionColumns');
            const columnSelection = document.getElementById('columnSelection');
            
            // Clear existing options
            wktSelect.innerHTML = '<option value="">-- Pilih Kolom WKT --</option>';
            nameSelect.innerHTML = '<option value="">-- Pilih Kolom Nama --</option>';
            descriptionContainer.innerHTML = '';
            
            // Add options untuk setiap header
            headers.forEach(header => {
                // WKT select
                const wktOption = document.createElement('option');
                wktOption.value = header;
                wktOption.textContent = header;
                if (header.toLowerCase().includes('wkt') || header.toLowerCase().includes('geometry')) {
                    wktOption.selected = true;
                }
                wktSelect.appendChild(wktOption);
                
                // Name select
                const nameOption = document.createElement('option');
                nameOption.value = header;
                nameOption.textContent = header;
                if (header.toLowerCase().includes('nama') || header.toLowerCase().includes('name')) {
                    nameOption.selected = true;
                }
                nameSelect.appendChild(nameOption);
                
                // Description checkboxes (exclude geometry columns)
                if (!header.toLowerCase().includes('wkt') && !header.toLowerCase().includes('geometry')) {
                    const checkboxItem = document.createElement('div');
                    checkboxItem.className = 'checkbox-item';
                    checkboxItem.innerHTML = `
                        <input type="checkbox" name="description_columns[]" value="${header}" id="desc_${header}">
                        <label for="desc_${header}">${header}</label>
                    `;
                    descriptionContainer.appendChild(checkboxItem);
                }
            });
            
            // Show column selection section dengan animasi
            setTimeout(() => {
                columnSelection.classList.remove('column-selection-hidden');
                columnSelection.classList.add('column-selection-visible');
            }, 100);
            
            // Update button text
            const submitBtn = document.getElementById('wktToKmlBtnText');
            submitBtn.textContent = 'Konversi ke KML';
            
            // Show success message
            showAlert('Kolom berhasil dimuat. Silakan pilih kolom WKT dan Nama, lalu submit kembali.', 'success');
        }

        // ====== EVENT LISTENER KHUSUS UNTUK KML TO CSV ======
        document.getElementById('kmlToCsvForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('span');
            
            // Show loading state
            submitBtn.disabled = true;
            const originalText = btnText.textContent;
            btnText.innerHTML = '<span class="loading-spinner"></span> Memproses...';
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => {
                // Clone response untuk mencegah "Body has already been consumed" error
                const responseClone = response.clone();
                
                if (!response.ok) {
                    // Jika response error, coba baca sebagai JSON
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Terjadi kesalahan server');
                    }).catch(() => {
                        // Jika bukan JSON, baca sebagai text
                        return responseClone.text().then(text => {
                            throw new Error('Terjadi kesalahan server: ' + text.substring(0, 100));
                        });
                    });
                }
                
                // Dapatkan filename dari header Content-Disposition
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'converted_data.csv';
                
                if (contentDisposition) {
                    const filenameMatch = contentDisposition.match(/filename="(.+)"/);
                    if (filenameMatch) {
                        filename = filenameMatch[1];
                    }
                }
                
                // Return both blob and filename
                return response.blob().then(blob => ({ blob, filename }));
            })
            .then(({ blob, filename }) => {
                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = filename; // Gunakan filename dari server
                
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                
                showAlert('File CSV berhasil diproses dan sedang diunduh!', 'success');
                
                // Reset form setelah submit berhasil
                resetForm('kmlToCsvForm');
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = originalText;
            });
        });

        // ====== EVENT LISTENER KHUSUS UNTUK POLYGON IN POLYGON ======
        document.getElementById('polygonInPolygonForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('span');
            
            // Show loading state
            submitBtn.disabled = true;
            const originalText = btnText.textContent;
            btnText.innerHTML = '<span class="loading-spinner"></span> Memproses...';
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => {
                // Clone response untuk mencegah "Body has already been consumed" error
                const responseClone = response.clone();
                
                if (!response.ok) {
                    // Jika response error, coba baca sebagai JSON
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Terjadi kesalahan server');
                    }).catch(() => {
                        // Jika bukan JSON, baca sebagai text
                        return responseClone.text().then(text => {
                            throw new Error('Terjadi kesalahan server: ' + text.substring(0, 100));
                        });
                    });
                }
                
                // Dapatkan filename dari header Content-Disposition
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'polygon_analysis.csv';
                
                if (contentDisposition) {
                    const filenameMatch = contentDisposition.match(/filename="(.+)"/);
                    if (filenameMatch) {
                        filename = filenameMatch[1];
                    }
                }
                
                // Return both blob and filename
                return response.blob().then(blob => ({ blob, filename }));
            })
            .then(({ blob, filename }) => {
                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = filename; // Gunakan filename dari server
                
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                
                showAlert('File CSV berhasil diproses dan sedang diunduh!', 'success');
                
                // Reset form setelah submit berhasil
                resetForm('polygonInPolygonForm');
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan: ' + error.message, 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = originalText;
            });
        });

        // ====== EVENT LISTENER GENERIC UNTUK SEMUA FORM LAINNYA ======
        document.querySelectorAll('form').forEach(form => {
            // Skip forms yang sudah punya handler khusus
            if (form.id === 'wktToKmlForm' || form.id === 'kmlToCsvForm' || form.id === 'polygonInPolygonForm') {
                return;
            }
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const btnText = submitBtn.querySelector('span');
                
                // Show loading state
                submitBtn.disabled = true;
                const originalText = btnText.textContent;
                btnText.innerHTML = '<span class="loading-spinner"></span> Memproses...';
                
                // Create FormData object
                const formData = new FormData(this);
                
                // Submit form via AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                })
                .then(response => {
                    // Clone response untuk mencegah "Body has already been consumed" error
                    const responseClone = response.clone();
                    
                    if (!response.ok) {
                        // Jika response error, coba baca sebagai JSON
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Terjadi kesalahan server');
                        }).catch(() => {
                            // Jika bukan JSON, baca sebagai text
                            return responseClone.text().then(text => {
                                throw new Error(text || 'Terjadi kesalahan server');
                            });
                        });
                    }
                    
                    // Dapatkan filename dari header Content-Disposition
                    const contentDisposition = response.headers.get('Content-Disposition');
                    let filename = 'download';
                    
                    if (contentDisposition) {
                        const filenameMatch = contentDisposition.match(/filename="(.+)"/);
                        if (filenameMatch) {
                            filename = filenameMatch[1];
                        }
                    }
                    
                    // Return both blob and filename
                    return response.blob().then(blob => ({ blob, filename }));
                })
                .then(({ blob, filename }) => {
                    // Create download link
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = filename; // Gunakan filename dari server
                    
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                    
                    showAlert('File berhasil diproses dan sedang diunduh!', 'success');
                    
                    // Reset form setelah submit berhasil
                    resetForm(this.id);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan: ' + error.message, 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.disabled = false;
                    btnText.textContent = originalText;
                });
            });
        });

        // Alert Function
        function showAlert(message, type) {
            const alertArea = document.getElementById('alertArea');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
            alert.innerHTML = `
                <i class="fas ${icon}"></i>
                <span>${message}</span>
            `;
            
            alertArea.appendChild(alert);
            
            // Remove alert after 5 seconds
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        // Responsive behavior
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.add('collapsed');
            }
        });

        // Initialize on page load
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('collapsed');
        }
    </script>
</body>
</html>