<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">{{ isset($admin)?'Admin': 'User'}} session</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">

          <li class="nav-item active">

          
          <a class="nav-link" href="{{ isset($admin) ? url('adminsession') : url('customersession/'.Session::get('id')) }}">Home <span class="sr-only">(current)</span></a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('logout') }}">Logout</a>
          </li>

          </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">  
 
        <span class="navbar-text">
            @if (isset($admin))
            ADMINISTRATION
            @else
            Mr. {{ Session::get('customer_name') }}
            @endif
        </span>

        </div>


      </nav>

