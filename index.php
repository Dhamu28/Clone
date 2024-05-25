<script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Open Sans', 'sans-serif'],
                    },
                },
            },
        };
    </script>
<?php
    $session_lifetime = 3600 * 24 * 10; // 10 days

    session_set_cookie_params ($session_lifetime);

    session_start();
    // require_once('include/db.php');
    require_once('config.php');
    // require_once('top.php');
    // require_once('install.php');
if (isset($_POST['login'])) {
    $userId = $_POST['user'];
    $pass = $_POST['pass'];

    echo "<pre>"; print_r($userId); echo "</pre>";
    echo "<pre>"; print_r($pass); echo "</pre>";
    // $pass = md5($pass);
    // $rows = $db->Q("SELECT * FROM `users` WHERE `phone`= '$phone' AND `pass` = '$password'");
    $q = "SELECT * FROM `student` WHERE `user`= '$userId' AND `pass` = '$pass'";
    // echo $q;
    $row = mysqli_query($conn, $q);
    $rows = mysqli_fetch_assoc($row);
    // echo "<pre>"; print_r($rows); echo "</pre>";

    if ($rows['user']) {
        $_SESSION['user']['user'] = $rows['user'];
        $_SESSION['user']['pass'] = $rows['pass'];
        
    echo "<pre>"; print_r($_SESSION['user']); echo "</pre>";

        header('location:/library/dashboard');

    } else {
        $message = 'Wrong login details! Check and try again.';
        $type="red";
    }
}

if (isset($_POST['signup'])) {
    // check user already exits
        $name = $_POST['sign_name'];
        $phone = $_POST['sign_phone'];
        $email = $_POST['sign_email'];
    // $password = md5($password);
    // $rows = $db->Q("SELECT * FROM `student` WHERE `phone`= '$phone'");
    $q = "SELECT * FROM `student` WHERE `phone`= '$phone'";
    $row = mysqli_query($conn, $q);
    $rows = mysqli_num_rows($row);

    // echo "<pre>"; 
    // print_r($rows); 
    // echo "</pre>";
    
    if ($rows <= 0) {
        // get first latter of the user
        $u = ucfirst(substr($name, 0, 1));
        // Create user name 
        $userId = "DL-$u".substr($phone, 6);
        $pass = ucfirst(substr($name, 0, 3))."#".rand(0, 999);
        $q = "INSERT INTO `student`(`name`,`phone`, `user`, `pass`, `email`) VALUES ('$name','$phone', '$userId', '$pass', '$email')";
        $rows = mysqli_query($conn, $q);
        // $db->Q("INSERT INTO `student`(`user`,`pass`) VALUES ('$userId','$pass')");
        if(!isset($rows)){
        $message =  "User not registerd";      
        $type="red";

        }
        // echo "user registerd";
        $message =  'You are successfully registered plese login';
        $type="green";
        // $done = true;

    } else {
        $message = 'Sorry! but account with '.$phone.' phone number already exists.';
        $type="amber";
    }
}


$title = "Login: Dhamu Softech.com";
$description = $title;
mysqli_close($conn);

?>



<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dhamu Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>

	:root {
		--yelo: #ffb534;
	  --lite-green: #c1f2b0;
	  --gren: #65b741;
	}
	body{
		margin-top: 0;
		margin-bottom: 0;
		box-shadow: border-box;
	}
.animat{
	animation: rotate-icon 20s linear infinite;
}

	@keyframes rotate-icon {
		0% {
		    transform: rotate(0deg);
		}
		100% {
		    transform: rotate(365deg);
		}
	}
	.abs-center{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
	}
</style>
<body class="bg-white dark:bg-gray-900 overflow-x-hidden">
	<header class="">
		<nav class="bg-white border-gray-200 dark:bg-gray-900">
		  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
		    <a href="https://dhamutech.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
		        <img src="/library/images/logo.svg" class="h-20 -mt-3" alt="Dhamu Library Logo" />
		        <!-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span> -->
		    </a>
		    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
		        <span class="sr-only">Open main menu</span>
		        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
		            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
		        </svg>
		    </button>
		    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
		      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 text-xl">
		        <li>
		          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Powerd By <span class="md:text-amber-500">Dhamutech</span></a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>
	<!-- Seciton Hero -->
	<section class="">
	    <div class="flex flex-col-reverse text-center md:text-start md:flex-row py-3 px-4 mx-auto gap-6 items-center max-w-screen-xl lg:py-6">
	    	<div class="md:w-1/2 w-full">	    		
					<img class="h-auto max-w-full" src="/library/images/Home-screen-pana.svg" alt="image description">
	    	</div>
	    	<div class="md:w-1/2 w-full">
	        	<p class="md:mb-6 mb-1 text-xl font-normal text-gray-400 md:text-2xl lg:text-3xl dark:text-white ">Welcome to Dhamu Library</p>
	        	<h1 class="md:mb-6 mb-1 text-4xl font-bold tracking-wide leading-relaxed text-amber-500 md:text-5xl lg:text-6xl ">Empowering Students for Success</h1>
	        	<p class="md:mb-6 mb-1 text-md font-normal text-gray-500 md:text-lg lg:text-xl dark:text-gray-500">Designed for Fix Success</p>
	        	<div class="flex text-start items-center space-y-4 sm:flex-row md:justify-start justify-center sm:space-y-0 md:gap-4 gap-2"> 
		        	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-800 dark:text-white">
							  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
							  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
							</svg>
		        	<div class="">
		        		<p class="mb-2 text-md font-normal text-gray-500 lg:text-lg dark:text-gray-500">Scan the QR Code to Book the Seat</p>
		        		<div class="flex gap-4">
				        	<img src="/library/images/Home-screen-pana.svg" class="h-8" alt="Dhamu Library Logo" />
				        	<img src="/library/images/Home-screen-pana.svg" class="h-8" alt="Dhamu Library Logo" />	
		        		</div>
		        	</div>
	        	</div>
	        	<a href="#signup">
<button class="rounded-lg text-lg md:text-xl mt-4 lg:text-2xl bg-gray-400 font-semibold dark:bg-white dark:text-blue-800 text-white md:px-4 px-2 py-2">Register Now</button></a>
	    	</div>
	    </div>
	</section>
	<section class="md:pb-12 pb-6 px-4">
	    <div class="flex flex-col py-3 mx-auto gap-6 text-start max-w-screen-xl lg:py-6">
			<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg">Book a Fixed Seat & Get an<span class="text-amber-500"> Assured Card</span></h2>
			<div class="grid grid-cols-2 md:grid-cols-4 justify-between gap-4 text-center md:text-start">
				<div class="flex flex-col md:flex-row items-center md:gap-4 gap-2">
					<div class="flex items-center justify-center rounded-3xl size-20 bg-black/10 dark:bg-white/10 dark:hover:bg-white/20 p-4 shadow">
						<span class="p-2 rounded-full dark:bg-white/20 bg-black/20">0</span>
					</div>
					<p class="font-normal text-gray-400 text-md dark:text-white px-3">No Credit score <br>required</p>
				</div>
				<div class="flex flex-col md:flex-row items-center md:gap-4 gap-2">
					<div class="flex items-center justify-center rounded-3xl size-20 bg-black/10 dark:bg-white/10 dark:hover:bg-white/20 p-4 shadow">
						<span class="p-2 rounded-full dark:bg-white/20 bg-black/20 ">0</span>
					</div>
					<p class="font-normal text-gray-400 text-md dark:text-white px-3">No Income proof <br>required</p>
				</div>
				<div class="flex flex-col md:flex-row items-center md:gap-4 gap-2">
					<div class="flex items-center justify-center rounded-3xl size-20 bg-black/10 dark:bg-white/10 dark:hover:bg-white/20 p-4 shadow">
						<span class="p-2 rounded-full dark:bg-white/20 bg-black/20 ">0</span>
					</div>
					<p class="font-normal text-gray-400 text-md dark:text-white px-3">Earn up to <br>6.55% p.a. on FD</p>
				</div>
				<div class="flex flex-col md:flex-row items-center md:gap-4 gap-2">
					<div class="flex items-center justify-center rounded-3xl size-20 bg-black/10 dark:bg-white/10 dark:hover:bg-white/20 p-4 shadow">
						<span class="p-2 rounded-full dark:bg-white/20 bg-black/20 ">0</span>
					</div>
					<p class="font-normal text-gray-400 text-md dark:text-white px-3">Card limit is <br>90% of FD amount</p>
				</div>
			</div>
	    </div>
	</section>
	<!-- Section ribbon -->
	<section class="">
		<div class="backdrop-blur-sm bg-black/10 dark:bg-white/10 md:py-8 py-4 px-4">
			<div class="flex md:flex-row flex-col items-center justify-between max-w-screen-xl mx-auto">
				<div class="">
					<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg">Trusted by over <span class="text-amber-500"> 31 Million </span>Consumers from 820+ cities</h2>
				</div>
				<div class="flex gap-12">
					<div class="">
						<h3 class="text-4xl font-bold tracking-wide md:leading-relaxed dark:text-white text-gray-800 md:text-5xl">4.4</h3>
						<p class="font-normal text-gray-400 text-md dark:text-white">app ratings</p>
					</div>
					<div class="">
						<h3 class="text-4xl font-bold tracking-wide md:leading-relaxed dark:text-white text-gray-800 md:text-5xl">10M+</h3>
						<p class="font-normal text-gray-400 text-md dark:text-white">downloads</p>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!-- Section benefits -->
	<section class="md:py-12 py-6 px-4">
	    <div class="flex flex-col py-3 mx-auto gap-6 text-start max-w-screen-xl lg:py-6">
	    	<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg"><span class="text-amber-500">Benefits of </span>Fixed Seat</h2>
	    	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-8 gap-2">
	    		<div class="block max-w-sm md:p-6 p-4 backdrop-blur-sm bg-black/10 hover:bg-black/15 dark:bg-white/10 rounded-3xl shadow dark:hover:bg-white/15">
					<h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Focused Environment</h5>
					<p class="font-normal text-gray-700 dark:text-gray-400">Escape distractions and immerse yourself in a conducive environment designed to enhance concentration and productivity.</p>
	    		</div>
	    		<div class="block max-w-sm md:p-6 p-4 backdrop-blur-sm bg-black/10 hover:bg-black/15 dark:bg-white/10 rounded-3xl shadow dark:hover:bg-white/15">
					<h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Resource Accessibility</h5>
					<p class="font-normal text-gray-700 dark:text-gray-400">While students bring their own study materials, our library also provides access to essential reference books and online resources to supplement your learning.</p>
	    		</div>
	    		<div class="block max-w-sm md:p-6 p-4 backdrop-blur-sm bg-black/10 hover:bg-black/15 dark:bg-white/10 rounded-3xl shadow dark:hover:bg-white/15">
					<h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Community Support</h5>
					<p class="font-normal text-gray-700 dark:text-gray-400">
					Connect with like-minded peers and foster a sense of camaraderie through group study sessions and knowledge-sharing opportunities.</p>
	    		</div>	
	    		<div class="block max-w-sm md:p-6 p-4 backdrop-blur-sm bg-black/10 hover:bg-black/15 dark:bg-white/10 rounded-3xl shadow dark:hover:bg-white/15">
					<h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Expert Guidance</h5>
					<p class="font-normal text-gray-700 dark:text-gray-400">
					Benefit from occasional workshops and study sessions conducted by experienced educators, providing valuable insights and guidance for exam preparation.</p>
	    		</div>	
	    		
	    	</div>
		</div>
	</section>
	<!-- Features -->
	<section class="px-4">
	    <div class="flex md:flex-row flex-col md:p-8 p-4 mx-auto gap-6 items-center text-start max-w-screen-xl rounded-3xl bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 shadow">
	    	<div class="md:w-3/5 w-full">
				<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg"><span class="text-amber-500">Benefits of </span>Fixed Seat</h2>
				<ul class="flex flex-col md:gap-3 gap-1 space-y-1 text-gray-500 md:text-xl text-md list-inside dark:text-gray-400">
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Monitor your study hours and track your progress conveniently.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Monitor your study hours and track your progress conveniently.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				        Access your booking information and account details anytime, anywhere.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				        Access your booking information and account details anytime, anywhere.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				    Keep track of your study progress with personalized analytics, allowing you to identify strengths and areas for improvement to optimize your study strategy effectively.
					</li>
				</ul>
	    	</div>
	    	<div class="md:w-2/5 w-full pt-6 md:pt-0">
	    		<img class="h-auto max-w-full" src="/library/images/booked_seat.svg" alt="image description">
	    	</div>
		</div>
	</section>
	<!-- Two box sections -->
	<section class="md:py-20 py-10 px-4">
		<div class="flex md:flex-row flex-col mx-auto md:gap-8 gap-4 items-center text-start max-w-screen-xl">
			<div class="md:w-1/2 w-full md:p-8 p-4 bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 border border-gray-200 rounded-3xl shadow dark:border-gray-700">
				<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg"><span class="text-amber-500">Best Suited</span> for those who</h2>
				<ul class="flex flex-col md:gap-3 gap-1 space-y-1 text-gray-500 md:text-xl text-md list-inside dark:text-gray-400">
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.

				    </li>
				</ul>
				<!-- <div class="mx-auto pt-10">					
					<video class="w-full rounded-3xl" controls>
					  <source src="/docs/videos/flowbite.mp4" type="video/mp4">
					  Your browser does not support the video tag.
					</video>
				</div> -->	
			</div>
			<div class="md:w-1/2 w-full md:p-8 p-4 bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 border border-gray-200 rounded-3xl shadow dark:border-gray-700">
				<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg"><span class="text-amber-500">Best Suited</span> for those who</h2>
				<ul class="flex flex-col md:gap-3 gap-1 space-y-1 text-gray-500 md:text-xl text-md list-inside dark:text-gray-400">
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.

				    </li>
				</ul>
				<!-- <div class="mx-auto pt-10">					
					<video class="w-full rounded-3xl" controls>
					  <source src="/docs/videos/flowbite.mp4" type="video/mp4">
					  Your browser does not support the video tag.
					</video>
				</div> -->	
			</div>
		</div>
	</section>
	<!-- rounded circle seciton -->
	<section class="px-4">
		<div class="flex flex-col md:flex-row items-center mx-auto gap-10 items-center text-start max-w-screen-xl">
			<div class="block md:w-1/2 w-full relative">
				<img class="animat" alt="Rounded Circle" src="/library/images/circle.svg" alt="">
				<img class="abs-center md:h-[600px]" alt="Rounded Circle" src="/library/images/mobile.svg" alt="">
			</div>
			<div class="block md:w-1/2 w-full">
				<div class="block md:text-end text-center text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white">
					<p>Attractive</p> 
					<p class="md:py-4 py-2"><span class="text-amber-500">Offer and discount</span></p> 
					<p class="md:pb-6 pb-3">from Top Brands</p>
				<button class="rounded-lg text-lg md:text-xl lg:text-2xl bg-gray-400 font-normal dark:bg-white dark:text-blue-800 text-white md:px-8 px-4 md:py-6 py-2">Avail Now</button> 
				</div>
			</div>
		</div>
	</section class="">
	<!-- section half rounded -->
	<section class="md:py-20 py-8 px-4 md:px-0">
		<div class="flex md:flex-row flex-col-reverse items-center max-w-screen-xl w-full md:p-8 p-4 bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 border border-gray-200 md:rounded-e-full rounded-t-full md:rounded-tl-none shadow dark:border-gray-700">
			<div class="md:ms-24 md:w-1/2 w-full">
				<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-lg"><span class="text-amber-500">Best Suited</span> for those who</h2>
				<ul class="flex flex-col md:gap-3 gap-1 space-y-1 text-gray-500 md:text-xl text-md list-inside dark:text-gray-400">
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.
				    </li>
				    <li class="flex items-center gap-2">
				        <svg class="w-5 h-5 me-2 text-amber-500 dark:text-amber-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
				            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
				         </svg>
				         Have no imcome i.e. Student, housewife.

				    </li>
				</ul>
			</div>
			<div class="md:w-1/2 w-full mx-auto flex justify-end items-center p-10">
				<div class="relative rounded-full">
					<img class=" w-auto h-auto -mt-8" src="/library/images/meter_bg.svg" alt="image description">
						<img src="/library/images/needle_icon_light.webp" class="abs-center md:pt-[12%] pt-[6%] md:ps-[24%] ps-[35%]">				
				</div>
			</div>	
		</div>
	</section>
<!-- Carousesl -->
<section class="">
	<div class="md:ms-24 w-full md:p-8 p-4 shadow">
		<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-xs leading-relaxed">Get <span class="text-amber-500">24/7 Control</span> Step up your seat</h2>
		<div class="flex md:pt-10 pt-5 md:gap-8 gap-4 overflow-x-scroll">
			<div class="bg-pink-100 md:px-8 px-4 md:pt-5 pt-2 md:max-w-screen-sm max-w-screen-xl rounded-t-3xl ">
				<h3 class="text-xl font-bold text-gray-800 md:text-2xl lg:text-3xl md:py-3 py-1">Speading Power</h3>
				<p class="leading-relaxed font-light">How much you can spend</p>
				<img class="w-auto h-auto md:pt-10 pt-5" src="/library/images/card_limit.webp" alt="image description">
			</div>
			<div class="bg-amber-100 md:px-8 px-4 md:pt-5 pt-2 md:max-w-screen-sm max-w-screen-xl rounded-t-3xl">
				<h3 class="text-xl font-bold text-gray-800 md:text-2xl lg:text-3xl md:py-3 py-1">Speading Power</h3>
				<p class="leading-relaxed font-light">How much you can spend</p>
				<img class="w-auto h-auto md:pt-10 pt-5" src="/library/images/card_limit.webp" alt="image description">
			</div>
			<div class="bg-green-100 md:px-8 px-4 md:pt-5 pt-2 md:max-w-screen-sm max-w-screen-xl rounded-t-3xl">
				<h3 class="text-xl font-bold text-gray-800 md:text-2xl lg:text-3xl md:py-3 py-1">Speading Power</h3>
				<p class="leading-relaxed font-light">How much you can spend</p>
				<img class="w-auto h-auto md:pt-10 pt-5" src="/library/images/card_limit.webp" alt="image description">
			</div>
			<div class="bg-red-100 md:px-8 px-4 md:pt-5 pt-2 md:max-w-screen-sm max-w-screen-xl rounded-t-3xl">
				<h3 class="text-xl font-bold text-gray-800 md:text-2xl lg:text-3xl md:py-3 py-1">Speading Power</h3>
				<p class="leading-relaxed font-light">How much you can spend</p>
				<img class="w-auto h-auto md:pt-10 pt-5" src="/library/images/card_limit.webp" alt="image description">
			</div>
		</div>
	</div>
</section>
<!-- Login signup form -->
<section class="md:py-20 py-10 px-4">
	<div class="flex md:flex-row flex-col max-w-screen-xl shadow mx-auto md:gap-8 gap-4">
		<div class="block md:w-1/2 w-full md:p-8 p-4 bg-black/10 dark:bg-amber-50 border border-gray-200 rounded-3xl shadow dark:border-gray-700">
				<h2 class="text-xl font-bold md:text-2xl lg:text-3xl dark:text-gray-800 text-white pb-6 md:text-start text-center leading-relaxed max-w-xs leading-relaxed"><span class="text-pink-500">Best Suited</span> for those who</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div class="bg-amber-200 rounded-xl p-5">
						<img class="w-5 h-5" src="/library/images/card_limit.webp" alt="image description">
						<h4 class="font-semibold text-md md:text-xl">Lorem, ipsum dolo</h4>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
					</div>
					<div class="bg-amber-200 rounded-xl p-5">
						<img class="w-5 h-5" src="/library/images/card_limit.webp" alt="image description">
						<h4 class="font-semibold text-md md:text-xl">Lorem, ipsum dolo</h4>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
					</div>
					<div class="bg-amber-200 rounded-xl p-5">
						<img class="w-5 h-5" src="/library/images/card_limit.webp" alt="image description">
						<h4 class="font-semibold text-md md:text-xl">Lorem, ipsum dolo</h4>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
					</div>
					<div class="bg-amber-200 rounded-xl p-5">
						<img class="w-5 h-5" src="/library/images/card_limit.webp" alt="image description">
						<h4 class="font-semibold text-md md:text-xl">Lorem, ipsum dolo</h4>
						<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
					</div>
				</div>
		</div>
		<div class="block md:w-1/2 w-full md:p-8 p-4 bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 border border-gray-200 rounded-3xl shadow dark:border-gray-700">
				<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed leading-relaxed"><span class="text-amber-500">Live Offer</span> When register</h2>
				<div>
		    <nav id="signup" class="max-w-fit mx-auto rounded-xl bg-gray-700 p-2" aria-label="Tabs" role="tablist">
			    <button type="button" class="text-xs md:text-md text-gray-800 border border-transparent hover:border-gray-400 font-medium rounded-md py-2 px-2.5 dark:text-neutral-200 dark:hover:text-white dark:hover:border-neutral-500 dark:bg-purple-600" id="login-item" data-hs-tab="#login" aria-controls="login" role="tab" aria-selected="true">
			        Log In
			    </button>
			    <button type="button" class="text-xs md:text-md text-gray-800 border border-transparent hover:border-gray-400 font-medium rounded-md py-2 px-2.5 dark:text-neutral-200 dark:hover:text-white dark:hover:border-neutral-500" id="signup-item" data-hs-tab="#validation-states-tab-html" aria-controls="validation-states-tab-html" role="tab" aria-selected="false">
			        Sign Up
			    </button>
			</nav>

			<div class="py-10">
			    <!-- Tab Content -->
			    <div id="login" role="tabpanel" aria-labelledby="login-item">

			        <form class="max-w-md mx-auto" action="" method="POST">
									  <div class="relative z-0 w-full mb-5 group">
									      <input type="text" name="user" id="user" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									      <label for="user" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">User Id</label>
									  </div>
									  <div class="relative z-0 w-full mb-5 group">
									      <input type="password" name="pass" id="pass" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									      <label for="pass" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
									  </div>
									  <button type="submit" name="login" class="text-white bg-purple-600 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Log In</button>
									</form>
									<?php if (isset($_POST['login'])) {?>

			    	<div class="p-4 text-sm text-<?=$type?>-800 rounded-lg bg-<?=$type?>-50 dark:bg-gray-800 dark:text-<?=$type?>-400" role="alert">
						  <?=$message?>
						</div> <?php } ?> 
			    </div>
			    <!-- End Tab Content -->

			    <!-- Sign up Tab Content -->
			    <div id="validation-states-tab-html" class="hidden relative" role="tabpanel" aria-labelledby="validation-states-tab-html-item">
						<form class="max-w-md mx-auto" action="" method="POST">
							<div class="grid md:grid-cols-2 md:gap-6">
						    <div class="relative z-0 w-full mb-5 group">
						        <input type="text" name="sign_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
						        <label for="sign_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
						    </div>
						    <div class="relative z-0 w-full mb-5 group">
						        <input type="tel" pattern="\d{10}"  name="sign_phone" id="sign_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
						        <label for="sign_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number </label>
						    </div>
						  </div>
						  <div class="relative z-0 w-full mb-5 group">
						      <input type="email" name="sign_email" id="sign_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
						      <label for="sign_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
						  </div>
						  <button type="submit" name="signup" class="text-white bg-purple-600 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Sign Up</button>
						</form>
<?php if (isset($_POST['signup'])) {?>
			    			<div class="absolute left-0 p-4 mb-6 text-sm text-<?=$type?>-800 rounded-lg bg-<?=$type?>-50 dark:bg-gray-800 dark:text-<?=$type?>-400" role="alert">
						  	<?=$message?>
						</div> <?php } ?> 
			    </div>
			    <!-- End Tab Content -->
				</div>		
			</div>				
		</div>
	</div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabButtons = document.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');

    tabButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Deactivate all tabs and panels
            tabButtons.forEach(btn => {
                btn.classList.remove("dark:bg-purple-600");
                btn.classList.remove("bg-purple-500");
                btn.setAttribute("aria-selected", "false");
            });
            tabPanels.forEach(panel => panel.classList.add("hidden"));

            // Activate the clicked tab and corresponding panel
            button.classList.add("dark:bg-purple-600");
            button.classList.add("bg-purple-500");
            button.setAttribute("aria-selected", "true");
            const tabPanel = document.querySelector(button.getAttribute("data-hs-tab"));
            tabPanel.classList.remove("hidden");
        });
    });

    // Activate the first tab by default
    tabButtons[0].click();
});
</script>

<!-- Section CTA -->
<section>
	<div class="flex md:flex-row flex-col max-w-screen-xl items-center shadow md:mx-auto md:gap-8 gap-4 px-4">
		<div class="md:p-8 p-4 max-w-screen-sm md:w-1/2 w-full">
			<h2 class="text-xl font-bold text-gray-400 md:text-2xl lg:text-3xl dark:text-white pb-6 md:text-start text-center leading-relaxed max-w-xs leading-relaxed">Let's get started with <span class="text-amber-500"> Dhamu Library</span></h2>
			<p class="text-gray-400 md:text-xl text-md md:text-start text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
			<div class="flex gap-4 items-center pt-5 justify-center">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-800 dark:text-white">
					  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
					  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
					</svg>
				<div class="flex flex-col">
					<button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Google Play</button>
					<button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">App Store</button>
				</div>		
			</div>
		</div>
		<div class="md:w-1/2 w-full flex justify-center">
			<img class="h-96" src="/library/images/card_limit.webp" alt="image description">
		</div>
	</div>
</section>
<!-- Footer content -->


<footer class="p-4 bg-black/10 hover:bg-black/15 dark:bg-white/10 dark:hover:bg-white/15 border border-gray-200 shadow dark:border-gray-700">
    <div class="mx-auto w-full max-w-screen-xl py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://dhamutech.com/" class="flex items-center">
                  <img src="/library/images/logo.svg" class="h-20 me-3" alt="FlowBite Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dhamu Library</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="md:mb-6 mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Flowbite</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Tailwind CSS</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="md:mb-6 mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline ">Github</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Discord</a>
                      </li>
                  </ul>
              </div>
              <div class="">
                  <h2 class="md:mb-6 mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="https://dhamutech.com/" class="hover:underline">Dhamutech™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                  <span class="sr-only">Facebook page</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                        <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                    </svg>
                  <span class="sr-only">Discord community</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                    <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                </svg>
                  <span class="sr-only">Twitter page</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                  </svg>
                  <span class="sr-only">GitHub account</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd"/>
                </svg>
                  <span class="sr-only">Dribbble account</span>
              </a>
          </div>
      </div>
    </div>
</footer>

</body>
</html>