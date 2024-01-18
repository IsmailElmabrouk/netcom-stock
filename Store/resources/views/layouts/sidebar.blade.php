 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <style>
             #sidebar .side-menu i {
			color: #3498db; /* Add your desired color */
			opacity: 0.8; /* Add opacity to make the icons transparent */
		}
/* Add more styles as needed */
#sidebar .brand {
    display: flex;
    align-items: center;
    padding: 10px; /* Adjust the padding as needed */
    margin-bottom: 10px; /* Adjust the margin as needed */
    text-decoration: none;
    color: #3498db;
}

#sidebar .brand i {
    margin-right: 10px; /* Adjust the margin as needed */
    font-size: 24px; /* Adjust the font size as needed */
}

#sidebar .brand .text {
    font-size: 18px; /* Adjust the font size as needed */
}
#sidebar .side-menu.top li .text {
    font-size: 18px; /* Adjust the font size as needed */
}

    </style>
    <script>
        const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');
    
    // Toggle sidebar when the menu icon is clicked
    menuBar.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    });
    
    // Close sidebar when clicking outside of it
    document.body.addEventListener('click', function (event) {
        const target = event.target;
        const isSidebar = target.closest('#sidebar');
        const isMenuBar = target.closest('#content nav .bx.bx-menu');
    
        // Check if the click is outside the sidebar and menu bar
        if (!isSidebar && !isMenuBar) {
            sidebar.classList.add('hide');
        }
    });
    
    </script>
 </head>
 <body>
    <section id="sidebar">
        
        <a href="#" class="brand">
             <div>
                <i class="fas fa-user"></i>
         
             <span class="text">{{ Auth::user()->name }}</span> <br>
             <i class="fas  fa-envelope"></i>
                           <span class="text">{{Auth::user()->email}}</span>

            </div>
        </a>
 
        <!-- User information -->
   
		<ul class="side-menu top">
         <!-- Inside your Dashboard link -->
<li class="active" id="dashboard-link">
    <a href="{{ Auth::user()->type === 'admin' ? route('Admin.admin-page') : route('Magasiner.magasiner-page') }}">
        <i class='bx bxs-dashboard'></i>
        <span class="text">Dashboard</span>
    </a>
</li>

            
			<li>
				<a href="{{ route('product.index') }}">
					<i class="fas fa-box"></i>
					<span class="text">Les Produits</span>  
				</a>
			</li>
            @if(Auth::user()->type !== 'Magasiner')
                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="fas fa-th-large"></i>
                        <span class="text">Category</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->type !== 'Magasiner')
            <li>
				<a href="{{ route('employee.index') }}">
					<i class="fas fa-users"></i>
					<span class="text">Employé</span>
				</a>
			</li>
            @endif
			<li>
				<a href="{{ route('clientes.index') }}">
					<i class="fas fa-user"></i>
					<span class="text">Client</span>
				</a>
			</li>
			<li>
				<a href="{{ route('stock.index') }}">
					<i class="fas fa-box-open"></i>
					<span class="text">Stock</span>
				</a>
			</li>
			<li>
				<a href="{{ route('bonsorties.index') }}">
					<i class="fas fa-clipboard"></i>
					<span class="text">Bon de sortie</span>
				</a>
			</li>
            @if(Auth::user()->type !== 'Magasiner')
			<li>
				<a href="{{ route('facturedevents.index') }}">
					<i class="fas fa-file-invoice"></i>
					<span class="text">Facture Devents</span>
				</a>
			</li>
            @endif
            @if(Auth::user()->type !== 'Magasiner')
            <li>
                <a href="{{ route('facturedachats.index') }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span class="text">Facture Dachats</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->type !== 'Magasiner')
              <li>
            <a href="{{ route('users.index') }}">
                <i class="fas fa-users-cog"></i>
                <span class="text">Gestion des Utilisateurs</span>
            </a>



            
        </li>
        @endif
        @auth
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    @endauth
    
      
			<!-- Add more links for other pages as needed -->
		</ul>
	<!-- Add more links for other pages as needed -->
  

	</section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

     

    
 </body>
 </html>