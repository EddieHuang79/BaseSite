<!doctype html>
<html>
	<head></head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $txt['Site'] }}</title>
	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/common.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
	<body>