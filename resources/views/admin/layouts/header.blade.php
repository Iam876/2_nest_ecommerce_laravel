<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{asset('adminBackend')}}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('adminBackend')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{asset('adminBackend')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('adminBackend')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('adminBackend')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="{{asset('adminBackend')}}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet">

	<link href="{{asset('adminBackend')}}/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet">

	<link href="{{asset('adminBackend')}}/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="{{asset('adminBackend')}}/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('adminBackend')}}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
	<!-- loader-->
	<link href="{{asset('adminBackend')}}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('adminBackend')}}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('adminBackend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('adminBackend')}}/assets/css/app.css" rel="stylesheet">
	<link href="{{asset('adminBackend')}}/assets/css/icons.css" rel="stylesheet">
	<link href="{{asset('adminBackend')}}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('adminBackend')}}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{asset('adminBackend')}}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{asset('adminBackend')}}/assets/css/header-colors.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

	<title>@yield('title')</title>
</head>

<body>