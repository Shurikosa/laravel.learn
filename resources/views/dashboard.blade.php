
<!DOCTYPE html>
<html lang="en" style="font-size: 16px;">
<head>
  <meta charset="UTF-8"/>
  <title>{{$title}}</title>
  <link rel="stylesheet" href="{{ asset('/css/dashboard_style.css') }}">
    <link rel="stylesheet" href="/css/dashboard_style.css">

    <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <div class="sidebar">
    <div class="logo"></div>
    <ul class="menu">
      <li class="active">
        <a href="#" class="active">
          <i class="fas fa-user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-question-circle"></i>
          <span>Swagger</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-cog"></i>
          <span>Settings</span>
        </a>
      </li>
       <li class="logout">
        <a href="@{/logout}" data-bs-toggle="tooltip" title="No No No don't do that!!!">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="content">
      <h1>{{$title}}</h1>
      <p>Name: {{$name}}</p>
      <p>Age: {{$age}}</p>

      <nav>
          <ul>
              <li><a href="{{route('admin.products.index')}}">Show</a></li>
              <li><a href="{{route('admin.products.store')}}">Store</a></li>
              <li><a href="{{route('admin.products.create')}}">Create</a></li>
          </ul>
      </nav>
  </div>

</body>
</html>

