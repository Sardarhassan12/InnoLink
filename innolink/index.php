<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   InnoLink
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   .fade-in {
    animation: fadeIn 2s ease-in-out;
   }
   @keyframes fadeIn {
    0% {
     opacity: 0;
    }
    100% {
     opacity: 1;
    }
   }
   @keyframes fadeInUp {
    from {
     opacity: 0;
     transform: translateY(20px);
    }
    to {
     opacity: 1;
     transform: translateY(0);
    }
   }
   .fade-in-up {
    animation: fadeInUp 1s ease-out;
   }
   .card:hover .icon {
    transform: rotate(360deg);
   }
  </style>
 </head>
 <body class="font-roboto bg-gradient-to-r from-blue-300 to-white">
    <header class="flex justify-between items-center p-6">
        <div class="text-2xl font-bold">
           InnoLink
        </div>
        <nav class="space-x-6 ml-[120px]">
           <a class="text-gray-600 hover:text-black" href="#">
              Home
           </a>
           <a class="text-gray-600 hover:text-black" href="#">
              Services
           </a>
           <a class="text-gray-600 hover:text-black" href="#">
              Startups
           </a>
           <a class="text-gray-600 hover:text-black" href="#">
              Contact
           </a>
        </nav>
        <div class="flex space-x-4"> 
           <a href="./login.php">
              <button class=" border-2 border-blue-400 text-blue-400 px-8 py-2 rounded-full">
                 Login
              </button>
           </a>
           <a href="./register.php">
              <button class="border-2 border-blue-400 bg-blue-400 text-white px-8 py-2 rounded-full">
                 Sign up
              </button>
           </a>
        </div>
     </header>
     
  <main class="flex flex-col md:flex-row items-center justify-between p-6 min-h-screen fade-in ml-[160px] -mt-[40px]">
   <div class="md:w-1/2 space-y-6 -ml-[80px] leading-[1.6] ">
    <h1 class="text-4xl md:text-5xl font-bold ">
     CONNECT WITH THE RIGHT
     <span class="text-blue-600 leading-[1.2]">
      INVESTORS
     </span>
     AND <span class="text-yellow-400 ">MENTORS</span> WITH INNOLINK!
    </h1>
    <p class="text-gray-600 ">
     A comprehensive platform that helps startups pitch their ideas, secure funding, and receive expert guidance to grow their businesses.
    </p>
    <button class="bg-blue-400 text-white px-10 py-4 rounded-full mt-9">
     Get Started
    </button>
    <div class="flex space-x-6">
     <div class="text-center">
      <div class="text-2xl font-bold">
       5,000+
      </div>
      <div class="text-gray-600">
       Successful Connections
      </div>
     </div>
     <div class="text-center">
      <div class="text-2xl font-bold">
       4.9/5
      </div>
      <div class="text-yellow-400">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star-half-alt">
       </i>
      </div>
      <div class="text-gray-600">
       Rating
      </div>
     </div>
    </div>
   </div>
   <div class="relative md:w-1/2 -mt-[40px] ">
    <img alt="Entrepreneur pitching an idea" class="rounded-full ml-[100px]" height="400" src="https://storage.googleapis.com/a1aa/image/LB1-7Pt0cabVZzZEB5pWOBQPndXWtsYTM9v5sHUVvc8.jpg" width="400"/>
    <div class="absolute top-0 right-0 bg-white p-4 rounded-lg shadow-lg flex items-center space-x-2">
     <img alt="Profile picture of a mentor" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/zldKyXjbNaFjgg0BHmXt1HKyy2fx1BKwO0fVHfZ72fw.jpg" width="40"/>
     <div>
      <div class="font-bold">
       Expert Mentor
      </div>
      <div class="text-gray-600">
       Alex Johnson
      </div>
     </div>
    </div>
    <div class="absolute bottom-0 left-0 bg-white p-4 rounded-lg shadow-lg flex items-center space-x-2">
     <img alt="Profile picture of an investor" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/FXtArGeUW1zJwWRoF2iUVr_IiTuviYQtq6GLM9llgTM.jpg" width="40"/>
     <div>
      <div class="font-bold">
       Leading Investor
      </div>
      <div class="text-gray-600">
       Sarah Lee
      </div>
     </div>
    </div>
   </div>
  </main>
  <section class="p-6 bg-white min-h-screen fade-in">
   <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-3xl font-bold mb-8 fade-in-up mt-[30px]">
     How InnoLink Works
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-[120px]">
    <div class="card bg-yellow-100  h-[300px] p-6 rounded-lg shadow-md transform transition duration-500 hover:scale-105 fade-in-up">
        <div class="icon text-yellow-500 text-4xl mb-4 transition duration-500">
       <i class="fas fa-lightbulb">
       </i>
      </div>
      <h3 class="text-xl font-bold mb-2">
       Pitch Your Idea
      </h3>
      <p class="text-gray-600">
       Create a compelling pitch to showcase your startup to potential investors and mentors.
      </p>
     </div>
     <div class="card bg-blue-100 p-6 h-[300px] rounded-lg shadow-md transform transition duration-500 hover:scale-105 fade-in-up  mt-[90px]">
      <div class="icon text-blue-500 text-4xl mb-4 transition duration-500">
       <i class="fas fa-handshake">
       </i>
      </div>
      <h3 class="text-xl font-bold mb-2">
       Connect with Investors
      </h3>
      <p class="text-gray-600">
       Browse through a list of investors and connect with those who are interested in your startup.
      </p>
     </div>
     <div class="card bg-green-100 p-6 h-[300px] rounded-lg shadow-md transform transition duration-500 hover:scale-105 fade-in-up ">
      <div class="icon text-green-500 text-4xl mb-4 transition duration-500">
       <i class="fas fa-user-tie">
       </i>
      </div>
      <h3 class="text-xl font-bold mb-2">
       Get Expert Guidance
      </h3>
      <p class="text-gray-600">
       Receive insights and guidance from experienced mentors to help grow your business.
      </p>
     </div>
     <div class="card bg-red-100 p-6 rounded-lg h-[300px] shadow-md transform transition duration-500 hover:scale-105 fade-in-up mt-[90px]">
      <div class="icon text-red-500 text-4xl mb-4 transition duration-500">
       <i class="fas fa-lock">
       </i>
      </div>
      <h3 class="text-xl font-bold mb-2">
       Secure Communication
      </h3>
      <p class="text-gray-600">
       Ensure secure communication and document sharing with role-based access control.
      </p>
     </div>
    </div>
   </div>
  </section>
  <section class="p-6 bg-gray-100 min-h-screen fade-in">
   <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-6 mt-[20px]">
     Our Services
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-[100px]">
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-chart-line text-4xl text-blue-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Business Analysis
      </h3>
      <p class="text-gray-600">
       Detailed analysis of your business to identify strengths, weaknesses, opportunities, and threats.
      </p>
     </div>
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-bullhorn text-4xl text-yellow-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Marketing Strategy
      </h3>
      <p class="text-gray-600">
       Develop effective marketing strategies to reach your target audience and grow your customer base.
      </p>
     </div>
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-dollar-sign text-4xl text-green-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Financial Planning
      </h3>
      <p class="text-gray-600">
       Comprehensive financial planning to ensure your startup's financial health and sustainability.
      </p>
     </div>
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-users text-4xl text-red-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Team Building
      </h3>
      <p class="text-gray-600">
       Assistance in building a strong and effective team to drive your startup's success.
      </p>
     </div>
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-network-wired text-4xl text-purple-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Networking Opportunities
      </h3>
      <p class="text-gray-600">
       Access to a vast network of industry professionals, investors, and mentors.
      </p>
     </div>
     <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <i class="fas fa-cogs text-4xl text-gray-500 mb-4">
      </i>
      <h3 class="text-xl font-bold mb-2">
       Technical Support
      </h3>
      <p class="text-gray-600">
       Technical support to help you overcome any challenges and ensure smooth operations.
      </p>
     </div>
    </div>
   </div>
  </section>
  <section class="p-6 bg-white min-h-screen fade-in">
   <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-6 mt-[50px]">
     Testimonials
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-[160px]">
     <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center">
      <img alt="Profile picture of a satisfied user" class="rounded-full mx-auto mb-4" height="80" src="https://storage.googleapis.com/a1aa/image/1hDzdY0EKMskL0xb0CigcxnYu7QELAeR2jA2KVffw8E.jpg" width="80"/>
      <h3 class="text-xl font-bold mb-2">
       John Doe
      </h3>
      <p class="text-gray-600">
       "InnoLink helped me connect with the right investors and mentors. My startup has grown exponentially since I joined the platform."
      </p>
     </div>
     <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center">
      <img alt="Profile picture of a satisfied user" class="rounded-full mx-auto mb-4" height="80" src="https://storage.googleapis.com/a1aa/image/LOYQg1YoBHLZjobWJh-UefITwTo0yIi_-UG2iSNRoNo.jpg" width="80"/>
      <h3 class="text-xl font-bold mb-2">
       Jane Smith
      </h3>
      <p class="text-gray-600">
       "The expert guidance and support I received from InnoLink's mentors have been invaluable. I highly recommend this platform to any entrepreneur."
      </p>
     </div>
     <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center">
      <img alt="Profile picture of a satisfied user" class="rounded-full mx-auto mb-4" height="80" src="https://storage.googleapis.com/a1aa/image/FXtArGeUW1zJwWRoF2iUVr_IiTuviYQtq6GLM9llgTM.jpg" width="80"/>
      <h3 class="text-xl font-bold mb-2">
       Michael Brown
      </h3>
      <p class="text-gray-600">
       "Thanks to InnoLink, I was able to secure the funding I needed to take my startup to the next level. The platform is user-friendly and highly effective."
      </p>
     </div>
    </div>
   </div>
  </section>
  
  <footer class="p-6 bg-white text-center">
   <p class="text-gray-600">
    &copy; 2023 InnoLink. All rights reserved.
   </p>
  </footer>
 </body>
</html>